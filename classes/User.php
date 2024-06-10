<?php

include 'lib/Database.php';

class User {

    private $db;

    public function __construct()
    {
      $this->db = new Database();
    }

    public function checkExistEmail($email)
    {
        $sql = "SELECT email from users WHERE email = :email";
        $stmt = $this->db->pdo->prepare($sql);
        $stmt->bindValue(':email', $email);
         $stmt->execute();
        if ($stmt->rowCount()> 0) {
          return true;
        }else{
          return false;
        }

    }

    public function addNewUser($data)
    {
        $username = $data['username'];
        $email = $data['email'];
        $password = $data['password'];
        $role_id = $data['role_id'];
    
        $checkEmail = $this->checkExistEmail($email);
    
        if($username == "" || $email == "" || $password == "") {
          $msg = '<div class="alert alert-danger alert-dismissible mt-3" id="flash-msg">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                <strong>Error !</strong> Input fields must not be Empty !</div>';
            return $msg;
        } elseif (filter_var($email, FILTER_VALIDATE_EMAIL === FALSE)) {
          $msg = '<div class="alert alert-danger alert-dismissible mt-3" id="flash-msg">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                <strong>Error !</strong> Invalid email address !</div>';
            return $msg;
        } elseif ($checkEmail == TRUE) {
          $msg = '<div class="alert alert-danger alert-dismissible mt-3" id="flash-msg">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                <strong>Error !</strong> Email already Exists, please try another Email... !</div>';
            return $msg;
        } else{
          $sql = "INSERT INTO users(username, email, password, role_id) VALUES(:username, :email, :password, :role_id)";
          $stmt = $this->db->pdo->prepare($sql);
          $stmt->bindValue(':username', $username);
          $stmt->bindValue(':email', $email);
          $stmt->bindValue(':password', SHA1($password));
          $stmt->bindValue(':role_id', $role_id);
          $result = $stmt->execute();
          if ($result) {
            $msg = '<div class="alert alert-success alert-dismissible mt-3" id="flash-msg">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                <strong>Success !</strong> Wow, you have Registered Successfully !</div>';
              return $msg;
          } else {
            $msg = '<div class="alert alert-danger alert-dismissible mt-3" id="flash-msg">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                <strong>Error !</strong> Something went Wrong !</div>';
              return $msg;
          }
        }
    }

}
?>