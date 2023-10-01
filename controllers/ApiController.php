<?php


namespace Cms\Controllers;

use Cms\Utils\Database;

/**
 * Class ApiController
 *
 * Controller for the API, handles the methods that the API should deliver
 *
 * @package Cms\Controllers
 */
class ApiController extends ViewController
{

    /**
     * This function receives data from the database and
     * decodes it to an readable JSON aray for the user
     *
     * @param $data array from the database;
     */
    public function viewApi()
    {
        $stmt = Database::getConn()->prepare("SELECT * FROM page_structure");
        $stmt->execute();
        $result = $stmt->get_result();
        $rows = $result->fetch_all(MYSQLI_ASSOC);
        $data = [];

        foreach ($rows as $row) {

            //Only show these details when project is not a banner
           if($row["is_banner"] == 0){
            $row["content"] = [
                "url" => $row["sub_url"],
                "title" => $row["sub_title"],
                "description" => $row["sub_description"],
            ];
           }

            // remove these keys when they're on parent level
            unset($row["sub_url"]);
            unset($row["sub_title"]);
            unset($row["sub_description"]);

            $data[] = $row;
        }

        $headerData = $this->headerDetails();

        ViewController::jsonResponse([ "projects" => $data, "pageHeader" => $headerData]);
    }

    private function headerDetails(){
        $stmt = Database::getConn()->prepare("SELECT * FROM page_header");
        $stmt->execute();
        $result = $stmt->get_result();
        $rows = $result->fetch_all(MYSQLI_ASSOC);

        return $rows;
    }
}
