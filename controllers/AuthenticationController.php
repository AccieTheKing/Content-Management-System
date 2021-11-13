<?php

namespace Cms\Controllers;

use Cms\Utils\Database;

class AuthenticationController extends ViewController
{
    private $admin_name;

    public function __construct()
    {
        $this->admin_name = $_ENV['APP_ADMIN_USERNAME'];
        $_SESSION["USERNAME"] = null;
        $_SESSION["GLOBAL_URL"] = $_ENV['GLOBAL_URL'];
    }


    public function getAuthView()
    {
        parent::getView("loginView.php", [
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

        if ($verify && $row["username"] === $this->admin_name) {
            $_SESSION["USERNAME"] = htmlentities($row["username"]);
            header("location: " . $_SESSION["GLOBAL_URL"] . "admin.home");
        } else if ($verify) {
            $_SESSION["USERNAME"] = htmlentities($row["username"]);
            header("location: " . $_SESSION["GLOBAL_URL"] . "visitor.home");
        } else {
            $this->getAuthView();
        }
    }

    /**
     * This function registers new users with using the loginform
     */
    public function registerUser()
    {
        $username = isset($_POST["txtfieldUsername"]) ? $_POST["txtfieldUsername"] : "";
        $password = isset($_POST["txtfieldPassword"]) ? $_POST["txtfieldPassword"] : "";

        $hashedPassword = password_hash($password, PASSWORD_BCRYPT);
        // $stmt = Database::getConn()->prepare("INSERT INTO admin (username, password) VALUES (?,?)");
        // $stmt->bind_param("ss", $username, $hashedPassword);
        // $stmt->execute();
        $this->getAuthView();
        echo $hashedPassword;
    }

    public function logoutUser()
    {
        session_destroy();
        header("location: " . $_SESSION["GLOBAL_URL"]);
    }
}
