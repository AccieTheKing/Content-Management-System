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
     * This function gives the admin view and checks if the user is an Admin otherwise the user will be redirected to
     * the page where he/she belongs
     */
    public function getAdminView()
    {
        if (isset($_SESSION["USERNAME"]) && $this->container["ID"] != 4)
            header("location:" . $_SESSION["GLOBAL_URL"] . 'visitor.home');

        $json = $this->getApiDecoded(); //The api with the data

        View::get(
            "homeView.php",
            [
                "pageHeader" => "Homepage",
                "pageTitle" => "Home",
                "pageInfoText" => "Welcome to my Content management system, below are some projects that i'm working on.",
                "projectPreview" => [
                    ($json["projects"])
                ]
            ]
        );
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
                "pageInfoText" => "Welcome to my Content management system, below are some projects that i'm working on.",
                "projectPreview" => [
                    ($json["projects"])
                ]
            ]
        );
    }

    public function changeWebsiteHeader()
    {
        if (!isset($_SESSION["USERNAME"]))
            header("location:" . $_SESSION["GLOBAL_URL"]);

        if (isset($_POST['website_banner_header'])) {
            $headerType = $_POST['website_banner_header'];
            $this->changeHeaderModus($headerType);

            header("Refresh: 2; Url=" . $_SESSION["GLOBAL_URL"] . "admin.home");
            View::get("loadingView.php", ["pageHeader" => "Loading"]);
        } else {
            View::get("errorView.php", ["pageHeader" => "Error"]);
        }
    }

    /**
     * This function will create a new project and store it in de database
     */
    public function createProject()
    {
        if (!isset($_SESSION["USERNAME"]))
            header("location:" . $_SESSION["GLOBAL_URL"]);

        if (!empty($_POST['project_id_right']) && !empty($_POST['project_id_left'])) {
            $this->insertBetweenProjects($_POST['project_id_left']);
        } else {
            $stmt = Database::getConn()->prepare("INSERT INTO page_structure (title, text_color,
            background_color, background_img, is_banner) VALUES (?, ?, ?, ?, ?)");

            $stmt->bind_param(
                "ssssi",
                $_POST['project_title'],
                $_POST['project_text_color'],
                $_POST['project_background_color'],
                $_POST['project_background_image'],
                $_POST['project_banner']
            );
            $stmt->execute();
        }

        header("Refresh: 2; Url=" . $_SESSION["GLOBAL_URL"] . "admin.home");
        View::get("loadingView.php", ["pageHeader" => "Loading"]);
    }

    /**
     * This function will delete a project from the database
     */
    public function deleteProject()
    {
        if (!isset($_SESSION["USERNAME"]))
            header("location:" . $_SESSION["GLOBAL_URL"]);

        $projectID = $_POST['delete_project_with_id'];
        $number_of_projects = $this->getTotalNumOfProjects();
        $rows = $this->getAllProjects()->fetch_all(MYSQLI_ASSOC);

        for ($i = $number_of_projects; $i > 0; $i--) { // look for right project
            if ($projectID == $rows[$i]["id"]) { // when project found
                for ($j = $i; $j < $number_of_projects; $j++) { // swap projects on the right with left till last one
                    if (isset($rows[$j + 1])) { // Check if item is the last in the list
                        $this->changeProjectOrder($rows[$j]["id"], $rows[$j + 1]["id"]);
                    } else {
                        $stmt = Database::getConn()->prepare("DELETE FROM page_structure WHERE id = ?");
                        $stmt->bind_param("i", $rows[$j]["id"]);
                        $stmt->execute();
                    }
                }
                break;
            }
        }

        View::get("loadingView.php", ["pageHeader" => "Loading"]);
        header("Refresh: 2; Url=" . $_SESSION["GLOBAL_URL"] . "admin.home");
    }

    public function swapProjectOrder()
    {
        $this->changeProjectOrder($_POST['project_swap_one'], $_POST['project_swap_two']);
    }

    /**
     * This function inserts a project inbetween two other projects in
     */
    private function insertBetweenProjects($projectLeftID)
    {
        // create empty project
        $stmt = Database::getConn()->prepare("INSERT INTO page_structure (title, text_color,
        background_color, background_img, is_banner) VALUES (?, ?, ?, ?, ?)");

        $stmt->bind_param(
            "ssssi",
            $_POST['project_title'],
            $_POST['project_text_color'],
            $_POST['project_background_color'],
            $_POST['project_background_image'],
            $_POST['project_banner']
        );
        $stmt->execute();

        $number_of_projects = $this->getTotalNumOfProjects();
        $rows = $this->getAllProjects()->fetch_all(MYSQLI_ASSOC);

        for ($i = $number_of_projects - 1; $i != 0; $i--) {
            if ($projectLeftID == $rows[$i - 1]["id"]) {
                break;
            } else {
                $this->changeProjectOrder($rows[$i - 1]["id"], $rows[$i]["id"]);
            }
        }
    }

    /**
     * This function is responsible for changing the order of the projects that are being displayd on
     * my website https://www.acdaling.nl
     *
     */
    private function changeProjectOrder($leftProjectID, $rightProjectID)
    {
        if (!isset($_SESSION["USERNAME"]))
            header("location:" . $_SESSION["GLOBAL_URL"]);

        $details_project_one = $this->getSingleProject($leftProjectID)->fetch_assoc(); //get details project one
        $details_project_two = $this->getSingleProject($rightProjectID)->fetch_assoc(); // get details project two

        // swap positions
        $stmt = Database::getConn()->prepare("UPDATE page_structure SET title = ?, text_color = ?, background_color = ?, 
                background_img = ?, positionX = ?, positionY = ?, is_banner = ?, sub_url = ?, sub_title = ?,
        sub_description = ? WHERE id = ?");

        // details table one to two
        $stmt->bind_param(
            "ssssssisssi",
            $details_project_one['title'],
            $details_project_one['text_color'],
            $details_project_one['background_color'],
            $details_project_one['background_img'],
            $details_project_one['positionX'],
            $details_project_one['positionY'],
            $details_project_one['is_banner'],
            $details_project_one['sub_url'],
            $details_project_one['sub_title'],
            $details_project_one['sub_description'],
            $details_project_two['id']
        );
        $stmt->execute();

        // details table two to one
        $stmt->bind_param(
            "ssssssisssi",
            $details_project_two['title'],
            $details_project_two['text_color'],
            $details_project_two['background_color'],
            $details_project_two['background_img'],
            $details_project_two['positionX'],
            $details_project_two['positionY'],
            $details_project_two['is_banner'],
            $details_project_two['sub_url'],
            $details_project_two['sub_title'],
            $details_project_two['sub_description'],
            $details_project_one['id']
        );
        $stmt->execute();
    }

    /** Updates */
    private function changeHeaderModus($modus)
    {
        $id = 1;
        $stmt = Database::getConn()->prepare("UPDATE page_header SET mode = ? WHERE id = ?");
        $stmt->bind_param("si", $modus, $id);
        $stmt->execute();
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

    private function getHeaderModus()
    {
        $stmt = Database::getConn()->prepare("SELECT * FROM page_header");
        $stmt->execute();
        $result = $stmt->get_result();

        return $result;
    }

    private function getTotalNumOfProjects()
    {
        $rows = $this->getAllProjects()->fetch_all(MYSQLI_ASSOC);
        return count($rows);
    }
}
