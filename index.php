<?php
    include 'include/header.php';

    $msg = Session::get('msg');
    if (isset($msg)) {
        echo $msg;
    }
    Session::set("msg", NULL);
?>

    <div class="card ">
        <div class="card-header">
            <h3>
                <i class="fas fa-users mr-2"></i>
                    User list 
                <span class="float-right">
                    Welcome!
                <strong>
                <span class="badge badge-lg badge-secondary text-white">
                    #User Name#
                </strong>
                </span>
            </h3>
        </div>
        <div class="card-body pr-2 pl-2">
            <table id="example" class="table table-striped table-bordered" style="width:100%">
                <thead>
                    <tr>
                      <th  class="text-center">SL</th>
                      <th  class="text-center">Username</th>
                      <th  class="text-center">Email</th>
                      <th  width='25%' class="text-center">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php

                        $users = $user->selectAllUser();

                        if ($users) {
                            foreach ($users as  $key => $user) {

                    ?>
                    <tr class="text-center">
                        <td><?php echo $key+1 ?></td>
                        <td><?php echo $user->username ?></td>
                        <td><?php echo $user->email ?></td>
                        <td>
                            <a class="btn btn-info btn-sm " href="editUser.php?id=<?php echo $user->id ?>s">Edit</a>
                            <a onclick="return confirm('Are you sure To Delete ?')" 
                                class="btn btn-danger btn-sm" href="?remove=<?php echo $user->id ?>">Remove</a>
                        </td>
                    </tr>
                    <?php } } else { ?>
                        <tr class="text-center">
                            <td>No user availabe now!</td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>

<?php
  include 'include/footer.php';
?>