<?php

    require_once "../User_Login/User-Config.php";
    session_start();
 
    // Check if the user is logged in, otherwise redirect to login page
    if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
        header("location: ../User_Login/User-Login.php");
        exit;
    }
 
    $new_password = $confirm_password = "";
    $err = "";
 
    if($_SERVER["REQUEST_METHOD"] == "POST"){
        $new_password = trim($_POST["new_password"]);
        $confirm_password = trim($_POST["confirm_password"]);
    
        if($new_password != $confirm_password){
            $err = "Password did not match.";
        }
        
        if(empty($err)){
            // Prepare an update statement
            $sql = "UPDATE users SET password = ? WHERE employee_id = ?";
        
            if($stmt = $mysqli->prepare($sql)){
                // Bind variables to the prepared statement as parameters
                $stmt->bind_param("ss", $param_password, $param_employee_id);
            
                // Set parameters
                $param_password = password_hash($new_password, PASSWORD_DEFAULT);
                $param_employee_id = $_SESSION["employee_id"];
            
                // Attempt to execute the prepared statement
                if($stmt->execute()){
                // Password updated successfully. Destroy the session, and redirect to login page
                session_destroy();
                echo '<script type="text/javascript">';
                echo 'alert("Password Changed Successfully");';
                echo '</script>';
                header("location: ./User-Login.php");
                exit();
                } else{
                $err = "Unable to change password. Please try again later.";
                }
            }
            // Close statement
            $stmt->close();
        }
    }
    
    // Close connection
    $mysqli->close();

?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Reset Password</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="./reset-password.css">
</head>
<body>
    <div class="container shadow">
        <hr>
            <?php if(!empty($err)){ ?>
                <div class="alert alert-danger" role="alert">
                    <?php echo $err ?>
                </div>
            <?php } ?>
            <h4>Change Password</h4>
		    <form class="" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" autoComplete="off">
                <div class="form-group <?php echo (!empty($new_password_err)) ? 'has-error' : ''; ?>">
                    <label>New Password</label>
                    <input class="form-control" name="new_password" maxlength="16" type="password" value="<?php echo $new_password; ?>" required>
                </div>
                <div class="form-group <?php echo (!empty($password_err)) ? 'has-error' : ''; ?>">
                    <label>Re-enter New Password</label>
			        <input class="form-control" name="confirm_password" maxlength="16" type="password" required>
                </div>
                <button class="btn btn-primary btn-block" type="submit">Update</button>
                <a class="" href="../Asset/Dashboard.php">Cancel</a>
            </form>
    </div>    
</body>
</html>