<?php

namespace Cms\Utils;

use Cms\Views\View;

class Router
{

    protected $routes;

    public function __construct($routes)
    {
        $this->routes = $routes;

    }

    public function run($url, $method = "GET")
    {

        foreach ($this->routes as $route) {

            $splitQueryString = explode("?", $url);//used for splitting the query string with the actual link

            if ($route["url"] === $splitQueryString[0] && $route["method"] === $method) {
                $explode = explode('@', $route['controller']);//split the page name from the controller name

                $controllerName = "Cms\Controllers\\" . $explode[0];//initialize a new controller
                require "controllers/" . $explode[0] . ".php";//require the document that contains the controller

                $controller = new $controllerName;
                $controller->{$explode[1]}();//will mount the specific function from the controller

                return;
            }
        }

        // return view 404 not found ...
        View::get("errorView.php", ["pageHeader" => "Oh noes!"]);
    }

}