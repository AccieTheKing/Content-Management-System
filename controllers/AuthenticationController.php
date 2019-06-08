<?php

namespace Cms\Controllers;

use Cms\Utils\Database;
use Cms\Views\View;

class AuthenticationController extends ViewController
{
    public static $ADMIN_NAME = "Accie";

    public function __construct()
    {
        $_SESSION["USERNAME"] = null;
        $_SESSION["GLOBAL_URL"] = "https://cms.acdaling.nl/";
    }


    public function getView()
    {
        View::get('loginView.php',
            [
                "pageHeader" => "Loginpage",
                "pageTitle" => "Login"
            ]);
    }

    public function validateLogin()
    {

        $username = isset($_POST["txtfieldUsername"]) ? $_POST["txtfieldUsername"] : "";
        $password = isset($_POST["txtfieldPassword"]) ? $_POST["txtfieldPassword"] : "";

        $stmt = Database::getConn()->prepare("SELECT username, password FROM admin WHERE username = ?");
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();

        $verify = password_verify($password, $row["password"]);

        if ($verify && $row["username"] === static::$ADMIN_NAME) {

            $_SESSION["USERNAME"] = htmlentities($row["username"]);
            header("location: " . $_SESSION["GLOBAL_URL"] . "admin.home");

        } else if ($verify) {
            $_SESSION["USERNAME"] = htmlentities($row["username"]);
            header("location: " . $_SESSION["GLOBAL_URL"] . "visitor.home");
        } else {
            $_SESSION["USERNAME"] = true;
            $this->getView();//The login screen
        }

    }

    public function registerUser()
    {
        $username = isset($_POST["txtfieldUsername"]) ? $_POST["txtfieldUsername"] : "";
        $password = isset($_POST["txtfieldPassword"]) ? $_POST["txtfieldPassword"] : "";

        $hashedPassword = password_hash($password, PASSWORD_BCRYPT);
        $stmt = Database::getConn()->prepare("INSERT INTO admin (username, password) VALUES (?,?)");
        $stmt->bind_param("ss", $username, $hashedPassword);
        $stmt->execute();
    }

    public function logoutUser()
    {
        session_destroy();
        header("location: " . $_SESSION["GLOBAL_URL"]);
    }

}
