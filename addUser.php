<?php
    include 'include/header.php';
    Session::CheckSession();

    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['addUser'])) {
        $user_add = $user->addNewUser($_POST);
    }
      
    if (isset($user_add)) {
        echo $user_add;
    }
?>

 <div class="card ">
   <div class="card-header">
          <h3 class='text-center'>Add New User</h3>
        </div>
        <div class="cad-body">
            <div style="width:600px; margin:0px auto">

            <form class="" action="" method="post">
                <div class="form-group">
                  <label for="username">Username</label>
                  <input type="text" name="username"  class="form-control">
                </div>
                <div class="form-group">
                  <label for="email">Email</label>
                  <input type="email" name="email"  class="form-control">
                </div>
                <div class="form-group">
                  <label for="password">Password</label>
                  <input type="password" name="password" class="form-control">
                </div>
                <div class="form-group">
                  <div class="form-group">
                    <label for="sel1">Role</label>
                    <select class="form-control" name="role_id" id="role_id">
                      <!-- Check Role id to get admin and user type options -->
                      <?php if(Session::get("role_id") == 1) { ?>
                        <option value="1">Admin</option>
                        <option value="2">User</option>
                      <?php } else { ?>
                        <option value="2">User</option>
                      <?php } ?>
                    </select>
                  </div>
                </div>
                <div class="form-group">
                  <button type="submit" name="addUser" class="btn btn-success">Register</button>
                </div>
            </form>
          </div>
        </div>
      </div>

<?php
  include 'include/footer.php';
?>
