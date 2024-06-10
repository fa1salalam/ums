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

    public function getUserInfoById($user_id)
    {
        $sql = "SELECT * FROM users WHERE id = :id LIMIT 1";
        $stmt = $this->db->pdo->prepare($sql);
        $stmt->bindValue(':id', $user_id);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_OBJ);
        if ($result) {
          return $result;
        }else{
          return false;
        }
  
    }

    public function updateUser($user_id, $data)
    {
        $username = $data['username'];
        $email = $data['email'];
        $password = $data['password'];
        $role_id = $data['role_id'];
  
        if ($username == ""|| $email == "" || $password == "" || $role_id == "") {
          $msg = '<div class="alert alert-danger alert-dismissible mt-3" id="flash-msg">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                <strong>Error !</strong> Input Fields must not be Empty !</div>';
            return $msg;
          } elseif (filter_var($email, FILTER_VALIDATE_EMAIL === FALSE)) {
          $msg = '<div class="alert alert-danger alert-dismissible mt-3" id="flash-msg">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                <strong>Error !</strong> Invalid email address !</div>';
            return $msg;
        }else{
  
          $sql = "UPDATE users SET
            username = :username,
            email = :email,
            password = :password,
            role_id = :role_id
            WHERE id = :id";
            $stmt= $this->db->pdo->prepare($sql);
            $stmt->bindValue(':username', $username);
            $stmt->bindValue(':email', $email);
            $stmt->bindValue(':password', SHA1($password));
            $stmt->bindValue(':role_id', $role_id);
            $stmt->bindValue(':id', $user_id);
            $result = $stmt->execute();
  
            if ($result) {
                echo "<script>location.href='index.php';</script>";
                Session::set('msg', '<div class="alert alert-success alert-dismissible mt-3" id="flash-msg">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    <strong>Success !</strong> Wow, Your Information updated Successfully !</div>');
            }else{
                echo "<script>location.href='index.php';</script>";
                Session::set('msg', '<div class="alert alert-danger alert-dismissible mt-3" id="flash-msg">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    <strong>Error !</strong> Data not inserted !</div>');
            }
        }
    }

    public function selectAllUser()
    {
        $sql = "SELECT * FROM users ORDER BY id DESC";
        $stmt = $this->db->pdo->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }

    public function deleteUserById($remove)
    {
        $sql = "DELETE FROM users WHERE id = :id";
        $stmt = $this->db->pdo->prepare($sql);
        $stmt->bindValue(':id', $remove);
        $result = $stmt->execute();
        if ($result) {
            $msg = '<div class="alert alert-success alert-dismissible mt-3" id="flash-msg">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                <strong>Success !</strong> User account Deleted Successfully !</div>';
              return $msg;
        }else{
            $msg = '<div class="alert alert-danger alert-dismissible mt-3" id="flash-msg">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                <strong>Error !</strong> Data not Deleted !</div>';
            return $msg;
          }
    }

    public function userLoginAuthorization($email, $password){
        $password = SHA1($password);
        $sql = "SELECT * FROM users WHERE email = :email and password = :password LIMIT 1";
        $stmt = $this->db->pdo->prepare($sql);
        $stmt->bindValue(':email', $email);
        $stmt->bindValue(':password', $password);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_OBJ);
      }

    public function userLogin($data)
    {
        $email = $data['email'];
        $password = $data['password'];
  
  
        $checkEmail = $this->checkExistEmail($email);
  
        if ($email == "" || $password == "" ) {
          $msg = '<div class="alert alert-danger alert-dismissible mt-3" id="flash-msg">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                <strong>Error !</strong> Email or Password not be Empty !</div>';
            return $msg;
  
        } elseif (filter_var($email, FILTER_VALIDATE_EMAIL === FALSE)) {
          $msg = '<div class="alert alert-danger alert-dismissible mt-3" id="flash-msg">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                <strong>Error !</strong> Invalid email address !</div>';
            return $msg;
        } elseif ($checkEmail == FALSE) {
          $msg = '<div class="alert alert-danger alert-dismissible mt-3" id="flash-msg">
            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
            <strong>Error !</strong> Email did not Found, use Register email or password please !</div>';
            return $msg;
        } else {
          $log_result = $this->userLoginAuthorization($email, $password);

        }
        if($log_result) {
            Session::init();
            Session::set('login', TRUE);
            Session::set('id', $log_result->id);
            Session::set('role_id', $log_result->role_id);
            Session::set('username', $log_result->username);
            Session::set('email', $log_result->email);
            Session::set('log_msg', '<div class="alert alert-success alert-dismissible mt-3" id="flash-msg">
                    <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                    <strong>Success !</strong> You are Logged In Successfully !</div>');
            echo "<script>location.href='index.php';</script>";
  
        }else{
            $msg = '<div class="alert alert-danger alert-dismissible mt-3" id="flash-msg">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                <strong>Error !</strong> Email or Password did not Matched !</div>';
            return $msg;
        }
    }

}
?>