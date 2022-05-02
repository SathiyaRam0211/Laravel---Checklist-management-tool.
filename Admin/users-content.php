<?php
    $sql = $mysqli->query("SELECT users.username, users.employee_id, users.created_by, users.created_on, user_authority.role_id 
                          FROM users INNER JOIN user_authority ON users.employee_id = user_authority.employee_id WHERE users.delete_flag = 0 
                          ORDER BY users.created_on DESC, users.username ASC;");
?>

<h3 class="title fixed">Users</h3>
<a class="create-new" href="./User_Creation/Create-User.php">+ Create</a>
<table class="table table-hover shadow">
        <thead>
            <tr>
                <th class="input-col" scope="col">Username</th>
                <th scope="col">Employee ID</th>
                <th class="input-col" scope="col">Role</th>
                <th scope="col">Created By</th>
                <th class="date-col" scope="col">Created On</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
            <?php while($row = $sql->fetch_assoc()){
              switch ($row['role_id']) {
                case 1:
                  $role = "Admin";
                  break;
                case 2:
                  $role = "User";
                  break;
                case 3:
                  $role = "Approver";
                  break;
                case 4:
                  $role = "User and Approver";
                  break;
              }  
            ?>
            <tr>
              <td><?php echo $row['username']; ?></td>
              <td><?php echo $row['employee_id']; ?></td>
              <td><?php echo $role; ?></td>  
              <td><?php echo $row['created_by']; ?></td>
              <td class="date-col"><?php echo $row['created_on']; ?></td>
              <td>
              <button type='button' class='btn btn-default' onClick="userEdit(this)">
              <i class='fa fa-pen-square fa-lg'></i>
              </button>
              <button type='button' class='btn btn-default' onClick="userDelete(this)">
              <i class='fa fa-times-circle fa-lg'></i>
              </button>
              </td>
            </tr>
            <?php } ?>
        </tbody>
</table>  
