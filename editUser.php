<?php
    include 'include/header.php';
?>

    <div class="card ">
        <div class="card-header">
          <h3>Edit User<span class="float-right"> <a href="index.php" class="btn btn-primary">Back</a> </h3>
    </div>
        <div class="card-body">
            <div style="width:600px; margin:0px auto">
                <form class="" action="" method="POST">
                    <div class="form-group">
                        <label for="username">Username</label>
                        <input type="text" name="username" value="" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" id="email" name="email" value="" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" name="password" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="sel1">Role</label>
                        <select class="form-control" name="roleid" id="roleid">
                            <option value="1" selected='selected'>Admin</option>
                            <option value="3">User</option>
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
