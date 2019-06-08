<?php

namespace Cms\Views;

/**
 * Class View
 *
 * This class is the base class for all Views. It takes the php file with
 * the optional parameters given to use in the view.
 *
 * @package Cms\Views
 */
class View
{
    public static function get($name, $variables = [])
    {

        // Paths
        $basePath = __DIR__;
        $searchView = realpath($basePath . '/' . $name);

        // Check for traversal attack.
        if ($searchView === false || strpos($searchView, $basePath) !== 0)
            return null;

        // Set variables.
        foreach ($variables as $key => $value)
            ${$key} = $value;

        // Get content.
        $content = include $name;

        // Return content.
        return substr($content, 0, -1);

    }
}