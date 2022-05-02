<?php
    $sql = $mysqli->query("SELECT users.username, access_log_audit.employee_id, access_log_audit.last_login,access_log_audit.last_logout FROM users 
                        INNER JOIN access_log_audit ON users.employee_id = access_log_audit.employee_id WHERE users.delete_flag = 0 
                        ORDER BY access_log_audit.last_login DESC;");
?>

    <h3 class="title">Audit Log</h3>
    <table class="table table-hover shadow">
        <thead>
            <tr>
                <th scope="col">Username</th>
                <th scope="col">Employee ID</th>
                <th scope="col">Last Login</th>
                <th scope="col">Last Logout</th>
            </tr>
        </thead>
        <tbody>
            <?php while($row = $sql->fetch_assoc()){
            ?>
            <tr>
              <td><?php echo $row['username']; ?></td>
              <td><?php echo $row['employee_id']; ?></td>   
              <td><?php echo $row['last_login']; ?></td>
              <td><?php echo $row['last_logout']; ?></td>
            </tr>
            <?php } ?>
        </tbody>
    </table>
 