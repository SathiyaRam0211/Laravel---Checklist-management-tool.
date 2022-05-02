<?php
    session_start();
    require_once "./User-Config.php";
    
    // Checking if the user is already logged in
    if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
        header("location: ../Asset/Dashboard.php");
        exit;
    }
 
    $employee_id = $password = "";
    $err = "";
 

    if($_SERVER["REQUEST_METHOD"] == "POST"){
        $employee_id = trim($_POST["employee_id"]);
        $password = trim($_POST["password"]);
    // Validate credentials
    if(empty($err)){
        // Prepare a select statement
        $sql = "SELECT employee_id, username, password, delete_flag FROM users WHERE employee_id = ?";
        
        if($stmt = $mysqli->prepare($sql)){
            // Bind variables to the prepared statement as parameters
            $stmt->bind_param("s", $param_employee_id);
            
            // Set parameters
            $param_employee_id = $employee_id;
            
            // Attempt to execute the prepared statement
            if($stmt->execute()){
                // Store result
                $stmt->store_result();
                
                // Check if username exists, if yes then verify password
                if($stmt->num_rows == 1){                    
                    // Bind result variables
                    $stmt->bind_result($employee_id, $username_stored, $hashed_password, $delete_flag);
                    if($stmt->fetch()){
                    if(!($delete_flag)){
                        
                        if(password_verify($password, $hashed_password)){
                            
                            
                            // Updating Access Log
                            $mysqli->query("UPDATE access_log_audit SET last_login = CURRENT_TIMESTAMP WHERE employee_id = '$employee_id'");
                            
                            // Getting Role ID
                            $getroleid = "SELECT role_id FROM user_authority WHERE employee_id = ?";
                            $stmt = $mysqli->prepare($getroleid);
                            $stmt->bind_param("s", $param_employee_id);
                            $param_employee_id = $employee_id;
                            $stmt->execute();
                            $stmt->store_result();
                            $stmt->bind_result($role_id);
                            $stmt->fetch();

                            // Store data in session variables
                            $_SESSION["loggedin"] = true;
                            $_SESSION["employee_id"] = $employee_id;
                            $_SESSION["username"] = $username_stored;
                            $_SESSION["role_id"] = $role_id;  
                             
                            // Redirect to Dashboard
                            header("location: ../Asset/Dashboard.php");
                         
                        } else{
                            // Display an error message if password is not valid
                            $err = "The Password you entered is incorrect.";
                        }
                    } else{
                        $err = "The User no longer exists.";
                    }
                    }
                } else{
                    // Display an error message if username doesn't exist
                    $err = "The Employee ID you entered is incorrect.";
                }
            } else{
                $err = "Server Connection Error. Please Try Again!";
            }

            // Close statement
            $stmt->close();
        }
    }
    
    // Close connection
    $mysqli->close();
    }
?>
 
 <!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>User Login</title>
	<link rel="stylesheet" href="./login.css">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
</head>
<body>
	<div class="container shadow">
	<img class="logo" data-bind="attr: { src: bannerLogoUrl }" src="https://aadcdn.msftauthimages.net/dbd5a2dd-s7qfevvwq6wm3d0-gkz4k8r0vbfojmjmew-zkzsxqcu/logintenantbranding/0/bannerlogo?ts=637054733106188602">
	<hr>
        <?php if(!empty($err)){ ?>
        <div class="alert alert-danger" role="alert">
            <?php echo $err ?>
        </div>
        <?php } ?>
        <h4>Login</h4>
		<form class="" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" autoComplete="off">
            <div class="form-group">
                <label>Employee ID</label>
                <input class="form-control" name="employee_id" minlength="8" maxlength="8" type="text" value="<?php echo $employee_id; ?>" required>
            </div>
            <div class="form-group">
                <label>Password</label>
			    <input class="form-control" name="password" maxlength="16" type="password" required>
            </div>
            <button class="btn btn-primary btn-block" type="submit">Login</button>
        </form>
	</div>
</body>
</html>