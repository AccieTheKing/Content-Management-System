<?php


namespace Cms\Controllers;

use Cms\Views\View;

/**
 * Abstract ViewController for the methods that are needed for a
 *  controller for the views
 *
 * @package Cms\Controllers
 * @author Acdaling Edusei
 */
abstract class ViewController
{
    /**
     * Method that is used for delivering a view for a specific page, this is standard the
     * @param $pageName
     * @param array $params
     */
    public function getView($pageName, $params = [])
    {
        View::get($pageName, $params);
    }

    /**
     * This function receives data from the database and
     * decodes it to an readable JSON aray for the user
     *
     * @param $data array from the database;
     */
    public function jsonResponse($data)
    {
        $jsonEncode = json_encode($data);

        header('Access-Control-Allow-Origin: *');
        header('Content-Type: application/json');

        die($jsonEncode);
    }

    /**
     * Get a decoded version of the api out of the database, this is used internaly by the website self
     *
     * @return mixed version of the api
     */
    public function getApiDecoded()
    {
        $data = file_get_contents($_SESSION["GLOBAL_URL"] . 'api');
        $m = str_replace('},]', "}]", $data);
        return $json = json_decode($m, true);
        // return json_decode($data);
    }
}
