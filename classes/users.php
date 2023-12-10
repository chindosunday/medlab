<?php
session_start();
require_once("dbconnection.php");
class User extends Db
{

    public function registerUser($first_name, $last_name, $email, $password)
    {
        $sql = "SELECT * FROM users WHERE email=?";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$email]);
        $checkemail = $stmt->rowCount();
        if ($checkemail > 1) {
            return "Error:Email already exists";
        }
        $sql = "INSERT INTO users(first_name, last_name,email, password)
        VALUES(?,?,?,?)";
        $stmt = $this->connect()->prepare($sql);
        $user = $stmt->execute([$first_name, $last_name, $email, $password]);
        if ($user) {
            echo  "Account Created Successfully";
        } else {
            return "Unable to create an account, please try again";
        }
    }



    public function loginUser($email, $password)
    {
        $sql = "SELECT * FROM users WHERE email=?";
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute([$email]);
        $numusers = $stmt->rowCount();
        if ($numusers < 1) {
            echo "Account does not exist";
        }
        $users = $stmt->fetch(PDO::FETCH_ASSOC);
        if (password_verify($password, $users["password"])) {

            $_SESSION["user_id"] = $users["user_id"];
            $_SESSION["email"] = $users["email"];
            header("location:../userprofile.php");
        } else if ($password != $users['password']) {
            echo "Email or password is incorrect";
            exit();
        } else {
            session_destroy();
            header("location:../useregisteration.php");
            exit();
        }
    }
}
