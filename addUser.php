<?php
    include 'include/header.php';
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
                    <select class="form-control" name="roleid" id="roleid">
                      <option value="1">Admin</option>
                      <option value="2">User</option>
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
