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

    /**
     * This function will create a new project and store it in de database
     */
    public function createProject()
    {
        if (!isset($_SESSION["USERNAME"]))
            header("location:" . $_SESSION["GLOBAL_URL"]);

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

        header("Refresh: 2; Url=" . $_SESSION["GLOBAL_URL"] . "admin.home");
        View::get("loadingView.php", ["pageHeader" => "Loading"]);
        getAdminView();
    }

    /**
     * This function will delete a project from the database
     */
    public function deleteProject()
    {
        if (!isset($_SESSION["USERNAME"]))
            header("location:" . $_SESSION["GLOBAL_URL"]);

        $stmt = Database::getConn()->prepare("DELETE FROM page_structure WHERE id = ?");
        $stmt->bind_param("i", $_POST['delete_project_with_id']);
        $stmt->execute();

        header("Refresh: 2; Url=" . $_SESSION["GLOBAL_URL"] . "admin.home");
        View::get("loadingView.php", ["pageHeader" => "Loading"]);
        getAdminView();
    }


    /**
     * This function is responsible for changing the order of the projects that are being displayd on 
     * my website https://www.acdaling.nl
     */
    public function changeProjectOrder()
    {
        if (!isset($_SESSION["USERNAME"]))
            header("location:" . $_SESSION["GLOBAL_URL"]);

        //get details project one
        $stmt = Database::getConn()->prepare("SELECT * FROM page_structure WHERE id = ?");
        $stmt->bind_param("i", $_POST['project_swap_one']);
        $stmt->execute();
        $details_project_one = $stmt->get_result()->fetch_assoc();

        // get details project two
        $stmt = Database::getConn()->prepare("SELECT * FROM page_structure WHERE id = ?");
        $stmt->bind_param("i", $_POST['project_swap_two']);
        $stmt->execute();
        $details_project_two = $stmt->get_result()->fetch_assoc();

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

        header("Refresh: 2; Url=" . $_SESSION["GLOBAL_URL"] . "admin.home");
        View::get("loadingView.php", ["pageHeader" => "Loading"]);
        getAdminView();
    }

    /**
     * This function will return a PHP array of information out of the database using the online API.
     * The method is used for testing intern methods
     *
     */
    public static function test()
    {
        $data = file_get_contents($_SESSION["GLOBAL_URL"] . "api");
        $m = str_replace('},]', "}]", $data);
        $json = json_decode($m, true);

        echo "<pre>";
        print_r($json["projecten"]);
        echo "</pre>";
    }
}
