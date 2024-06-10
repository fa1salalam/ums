<?php
    include 'include/header.php';
    Session::CheckSession();

    if (isset($_GET['id'])) {
        $user_id = preg_replace('/[^a-zA-Z0-9-]/', '', (int)$_GET['id']);  
    }
      
      
      if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['update'])) {
        $update_user = $user->updateUser($user_id, $_POST);
      
      }
      if (isset($update_user)) {
        echo $update_user;
      }
?>

    <div class="card ">
        <div class="card-header">
          <h3>Edit User<span class="float-right"> <a href="index.php" class="btn btn-primary">Back</a> </h3>
    </div>
    <?php
        $get_user = $user->getUserInfoById($user_id);
    ?>
        <div class="card-body">
            <div style="width:600px; margin:0px auto">
                <form class="" action="" method="POST">
                    <div class="form-group">
                        <label for="username">Username</label>
                        <input type="text" name="username" value="<?php echo $get_user->username; ?>" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" id="email" name="email" value="<?php echo $get_user->email; ?>" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" name="password" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="sel1">Role</label>
                        <select class="form-control" name="role_id" id="role_id">
                            <?php if($get_user->role_id == 1) { ?>
                                    <option value="1" selected='selected'>Admin</option>
                                    <option value="2">User</option>
                            <?php } elseif(Session::get("role_id") == $get_user->role_id) { ?>
                                    <option value="2" selected='selected'>User</option>
                                    <?php } else { ?>
                                    <option value="1" >Admin</option>
                                    <option value="2" selected='selected'>User</option>
                                <?php } ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <button type="submit" name="update" class="btn btn-success">Update</button>
                    </div>           
            </form>
        </div>
<?php
    include 'include/footer.php';
?>
