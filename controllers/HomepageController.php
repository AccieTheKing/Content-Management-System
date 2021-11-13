<?php

namespace Cms\Controllers;

use Cms\Utils\Database;
use Cms\Views\View;

class HomepageController extends ViewController
{
    private $container;

    public function __construct()
    {
        if (!isset($_SESSION["USERNAME"]))
            header("location:" . $_SESSION["GLOBAL_URL"]);

        $stmt = Database::getConn()->prepare("SELECT ID FROM admin WHERE username = ?");
        $stmt->bind_param("s", $_SESSION["USERNAME"]);
        $stmt->execute();
        $this->container = $stmt->get_result()->fetch_assoc();
    }

    /**
     * This function gives the view for a Visitor and checks if the user is attempting to access the page as an Admin,
     * is happens he/she will be redirected
     */
    public function getVisitorView()
    {
        if (isset($_SESSION["USERNAME"]) && $this->container["ID"] === 4)
            header("location:" . $_SESSION["GLOBAL_URL"] . 'admin.home');

        $json = $this->getApiDecoded(); //The api with the data

        View::get(
            "homeVisitorView.php",
            [
                "pageHeader" => "Homepage",
                "pageTitle" => "Home",
                "pageInfoText" => "Welcome to my simple Content Management System, below are some projects that I have worked on.",
                "projectPreview" => [
                    ($json["projects"])
                ]
            ]
        );
    }

    /** Getters */
    private function getSingleProject($id)
    {
        $stmt = Database::getConn()->prepare("SELECT * FROM page_structure WHERE id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();

        return $stmt->get_result();
    }

    private function getAllProjects()
    {
        $stmt = Database::getConn()->prepare("SELECT * FROM page_structure"); // fetch all projects
        $stmt->execute();
        $result = $stmt->get_result();

        return $result;
    }
}
