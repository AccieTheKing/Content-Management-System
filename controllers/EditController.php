<?php


namespace Cms\Controllers;


use Cms\Utils\Database;
use Cms\Views\View;

class EditController extends ViewController
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

    public function getAdminView()
    {

        if (isset($_SESSION["USERNAME"]) && $this->container["ID"] != 4)
            header("location:" . $_SESSION["GLOBAL_URL"] . 'visitor.edit?project=' . $_GET["project"]);

        $json = $this->getApiDecoded();

        View::get("editView.php",
            [
                "pageHeader" => "Edit",
                "pageContent" => [
                    "contentTitle" => ($json["projecten"])
                ]
            ]
        );
    }


    public function getVisitorView()
    {

        if (isset($_SESSION["USERNAME"]) && $this->container["ID"] == 4)
            header("location:" . $_SESSION["GLOBAL_URL"] . 'admin.edit?project=' . $_GET["project"]);

        $json = $this->getApiDecoded();

        View::get("editVisitorView.php",
            [
                "pageHeader" => "Edit",
                "pageContent" => [
                    "contentTitle" => ($json["projecten"])
                ]
            ]
        );
    }

    /**
     * Updates the changes in the fields and saves it in the database
     */
    public function saveContent()
    {
        $project_id = isset($_POST["project_id"]) ? $_POST["project_id"] : "";
        $project_title = isset($_POST["project_title"]) ? $_POST["project_title"] : "";
        $project_color = isset($_POST["project_color"]) ? $_POST["project_color"] : "";
        $project_backgroundColor = isset($_POST["project_backgroundColor"]) ? $_POST["project_backgroundColor"] : "";
        $project_backgroundImage = isset($_POST["project_BackgroundImg"]) ? $_POST["project_BackgroundImg"] : "";
        $project_positionX = isset($_POST["project_positionX"]) ? $_POST["project_positionX"] : "";
        $project_positionY = isset($_POST["project_positionY"]) ? $_POST["project_positionY"] : "";
        $project_isBanner = isset($_POST["project_is_banner"]) ? $_POST["project_is_banner"] : "";
        $project_subUrl = isset($_POST["project_content_url"]) ? $_POST["project_content_url"] : "";
        $project_subTitle = isset($_POST["project_content_title"]) ? $_POST["project_content_title"] : "";
        $project_subDescription = isset($_POST["project_content_description"]) ? $_POST["project_content_description"] : "";


        $stmt = Database::getConn()->prepare("UPDATE page_structure SET title = ?, text_color = ?, background_color = ?, 
                          background_img = ?, positionX = ?, positionY = ?, is_banner = ?, sub_url = ?, sub_title = ?,
        sub_description = ? WHERE id = ?");


        $stmt->bind_param("ssssssisssi", $project_title, $project_color, $project_backgroundColor,
            $project_backgroundImage, $project_positionX, $project_positionY, $project_isBanner, $project_subUrl,
            $project_subTitle, $project_subDescription, $project_id);
        $stmt->execute();

        header("Refresh: 2; Url=" . $_SESSION["GLOBAL_URL"] . "admin.edit?project=" . $project_id);
        View::get("loadingView.php", ["pageHeader" => "Loading"]);
    }

}