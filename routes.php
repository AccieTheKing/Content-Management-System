<?php

/**
 * All the routes that the application is using
 */
return [
    [
        "url" => "/",
        "method" => "GET",
        "controller" => "AuthenticationController@getAuthView"
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
        "url" => "/admin.home",
        "method" => "GET",
        "controller" => "HomepageAdminController@getAdminView"
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
        "url" => "/create.project",
        "method" => "POST",
        "controller" => "HomepageController@createProject"
    ],
    [
        "url" => "/delete.project",
        "method" => "POST",
        "controller" => "HomepageController@deleteProject"
    ],
    [
        "url" => "/change.project",
        "method" => "POST",
        "controller" => "HomepageController@swapProjectOrder"
    ],
    [
        "url" => "/change.header",
        "method" => "POST",
            "controller" => "HomepageController@changeWebsiteHeader"
    ],
    [
        "url" => "/api",
        "method" => "GET",
        "controller" => "ApiController@viewApi"
    ]
];
