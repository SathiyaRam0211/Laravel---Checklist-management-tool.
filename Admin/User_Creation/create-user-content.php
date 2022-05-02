<?php

        $employee_id = "";
        $err = "";
    
        if($_SERVER["REQUEST_METHOD"] == "POST"){
            // Prepare a select statement
            $sql = "SELECT username FROM users WHERE employee_id = ? AND delete_flag IS NULL";
        
            if($stmt = $mysqli->prepare($sql)){
                // Bind variables to the prepared statement as parameters
                $stmt->bind_param("s", $param_id);
            
                // Set parameters
                $param_id = trim($_POST["employee_id"]);
            
                // Attempt to execute the prepared statement
                if($stmt->execute()){
                    // store result
                    $stmt->store_result();
                
                    if($stmt->num_rows == 1){
                        $err = "An User already exists under the same Employee ID.";
                    } else{
                        $employee_id = trim($_POST["employee_id"]);
                        $username = trim($_POST["username"]);
                        $password = trim($_POST["password"]);
                        $role_id = trim($_POST["role-id"]);
                    } 
                }else{
                    $err = "Server Connection Error. Please Try Again!";
                }

                // Close statement
                $stmt->close();
            }
    
        // Check input errors before inserting in database
        if(empty($err)){
        
            // Prepare an insert statement
            $sql = "INSERT INTO users (employee_id, username, password, created_by) VALUES (?, ?, ?, ?)";
         
            if($stmt = $mysqli->prepare($sql)){
                // Bind variables to the prepared statement as parameters
                $stmt->bind_param("ssss", $param_empid, $param_username, $param_password, $param_creator);
            
            // Set parameters
            $param_empid = $employee_id;
            $param_username = $username;
            $param_password = password_hash($password, PASSWORD_DEFAULT);
            $param_creator = $_SESSION["username"];
            // Attempt to execute the prepared statement
            if($stmt->execute()){
                // Update User Authority
                $mysqli->query("INSERT INTO user_authority (employee_id, role_id) VALUES ('$employee_id', '$role_id')");
                $mysqli->query("INSERT INTO access_log_audit (employee_id, last_login, last_logout) VALUES ('$employee_id', 0, 0)");
                // Redirect to Dashboard
                echo '<script>alert("User Created Successfully.")</script>'; 
                header("location: ../Users.php");
            } else{
                $err = "User already exists or Something went wrong. Unable to Create User!"; 
            }

            // Close statement
            $stmt->close();
        }
    }
    
    // Close connection
    $mysqli->close();
}

?>
<a class='goback' href='../Users.php'><i class='fas fa-chevron-circle-left'></i> Back to Users</a>
<h3 class="title">Create User</h3>
<div class="create-box shadow">
            <?php if(!empty($err)){ ?>
                <div class="alert alert-danger" role="alert">
                    <?php echo $err ?>
                </div>
            <?php } ?>
		    <form class="" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" autoComplete="off">
                <div class="row">
                <div class="form-group col-md-6">
                    <label>Employee ID</label>
                    <input class="form-control" name="employee_id" minlength="8" maxlength="8" type="text" value="<?php echo $employee_id; ?>" required>
                </div>  
                </div>
                <div class="row">
                <div class="form-group col">
                    <label>Username</label>
			        <input class="form-control" name="username" maxlength="50" type="text" required>
                </div>
                <div class="form-group col">
                    <label>Password</label>
			        <input class="form-control" name="password" minlength="8" maxlength="16" type="password" required>
                </div>
                </div>
                <div class="row">
                <div class="form-group col-md-6">
                    <label>Role</label>
			        <select class="custom-select" name ="role-id" id="role-dropdown" required> 
                        <option value="1">Admin</option>
                        <option value="2">User</option>
                        <option value="3">Approver</option>
                        <option value="4">User and Approver</option>
                    </select>
                </div>
            </div>
                <button class=" col-md-2 btn btn-primary btn-block" type="submit">Create</button>
            </form>
</div>    