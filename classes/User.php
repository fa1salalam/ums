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
            $stmt->bindValue(':password', $password);
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

}
?>