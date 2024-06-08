<?php
    include 'include/header.php';
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
                    <tr class="text-center">
                        <td>1</td>
                        <td>Faisal</td>
                        <td>admin@admin.com</td>
                        <td>
                            <a class="btn btn-info btn-sm " href="editUser.php?id=#">Edit</a>
                            <a onclick="return confirm('Are you sure To Delete ?')" 
                                class="btn btn-danger btn-sm" href="?remove=#">Remove</a>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    
<?php
  include 'include/footer.php';
?>