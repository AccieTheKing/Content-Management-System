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

        $json = $this->getApiDecoded();//The api with the data

        View::get("homeView.php",
            [
                "pageHeader" => "Homepage",
                "pageTitle" => "Home",
                "pageInfoText" => "Welcome to my Content management system, below are some projects that i'm working on.",
                "projectPreview" => [
                    ($json["projects"])
                ]
            ]);

    }

    /**
     * This function gives the view for a Visitor and checks if the user is attempting to access the page as an Admin,
     * is happens he/she will be redirected
     */
    public function getVisitorView()
    {
        if (isset($_SESSION["USERNAME"]) && $this->container["ID"] === 4)
            header("location:" . $_SESSION["GLOBAL_URL"] . 'admin.home');

        $json = $this->getApiDecoded();//The api with the data

        View::get("homeVisitorView.php",
            [
                "pageHeader" => "Homepage",
                "pageTitle" => "Home",
                "pageInfoText" => "Welcome to my Content management system, below are some projects that i'm working on.",
                "projectPreview" => [
                    ($json["projects"])
                ]
            ]);

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