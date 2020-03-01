<?php

/**
 * All the routes that the application is using
 */
return [
    [
        "url" => "/",
        "method" => "GET",
        "controller" => "AuthenticationController@getView"
    ],
    [
        "url" => "/",
        "method" => "POST",
        "controller" => "AuthenticationController@validateLogin"
    ],
    [
        "url" => "/register",
        "method" => "POST",
        "controller" => "AuthenticationController@registerUser"
    ],
    [
        "url" => "/logout",
        "method" => "POST",
        "controller" => "AuthenticationController@logoutUser"
    ],
    [
        "url" => "/admin.home",
        "method" => "GET",
        "controller" => "HomepageController@getAdminView"
    ],
    [
        "url" => "/admin.edit",
        "method" => "GET",
        "controller" => "EditController@getAdminView"
    ],
    [
        "url" => "/admin.edit",
        "method" => "POST",
        "controller" => "EditController@saveContent"
    ],
    [
        "url" => "/visitor.home",
        "method" => "GET",
        "controller" => "HomepageController@getVisitorView"
    ],
    [
        "url" => "/visitor.edit",
        "method" => "GET",
        "controller" => "EditController@getVisitorView"
    ],
    [
        "url" => "/api",
        "method" => "GET",
        "controller" => "ApiController@viewApi"
    ]
];