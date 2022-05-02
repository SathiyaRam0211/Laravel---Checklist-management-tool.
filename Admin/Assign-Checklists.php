<?php 
  session_start();
  require_once "../User_Login/User-Config.php";
  
  // Check if the user is logged in, otherwise redirect to login page
  if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: ../User_Login/User-Login.php");
    exit;
  }
  
  function printInitials($name) 
  { 
    if (strlen($name) == 0) 
        return; 
  
    echo strtoupper($name[0]); 
  
    // Traverse rest of the string and print the 
    // characters after spaces. 
    for ($i = 1; $i < strlen($name) - 1; $i++){
        if ($name[$i] == ' ') 
            echo strtoupper($name[$i + 1]);
        else if($name[$i] == '_')
              echo strtoupper($name[$i + 1]);
    }
  } 

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="../Asset/dashboard.css">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
    <title>Assign-Checklists</title>
</head>
<body>
<nav class="navbar navbar-dark shadow-lg">
    <img src="../Asset/NTT-white.png" width="100" height="50" alt="">
    <a class="navbar-brand app-name mx-auto" href="#">Checklist Manager</a>
    <a type="button" class="btn-custom rounded-circle dropdown-toggle ml-auto" data-toggle="dropdown">
      <?php printInitials($_SESSION["username"]);?>
      <div class='status-circle'></div>
    </a>
    <div class="dropdown-menu">
        <span class="dropdown-item"><?php  echo $_SESSION["username"];?></span>
        <div class="dropdown-divider"></div>
        <a class="dropdown-item" href="../User_Login/Reset-Password.php">Change Password</a>
        <a class="dropdown-item" href="../User_Login/Logout.php">Log Out</a>
    </div>
</nav>
<div class="side-bar">
          <div class="sidebar-sticky">
            <ul class="nav flex-column">
              <li class="nav-item">
                <a class="nav-link" id="Dashboard" href="../Asset/Dashboard.php">Dashboard</a>
              </li>
            </ul>
            <ul class="nav flex-column admin-section">
              <li class="nav-item">
                <a class="nav-link" id="Checklists" href="../Admin/Checklists.php">Checklists</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" id="Assign-Checklists" href="../Admin/Assign-Checklists.php">Assign Checklists</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" id="Assignment-History" href="../Admin/Assignment-History.php">Assignment History</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" id="Users" href="../Admin/Users.php">Users</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" id="Audit-Log" href="../Admin/Audit-Log.php">Audit Log</a>
              </li>
            </ul>
            <ul class="nav flex-column user-section">
              <li class="nav-item">
                <a class="nav-link" id="Checklist-Execution" href="../User/Checklist-Execution.php">Checklist Execution</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" id="User-Checklists" href="../User/User-Checklists/All.php" onClick="userChecklists()">User Checklists</a>
              </li>
            </ul>
            <ul class="nav flex-column approver-section">
              <li class="nav-item">
                <a class="nav-link" id="Checklist-Approval" href="../Approver/Checklist-Approval.php">Checklist Approval</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" id="Approver-Checklists" href="../Approver/Approver-Checklists/All.php" onClick="approverChecklists()">Approver Checklists</a>
              </li>
            </ul> 
          </div>
</div>
<div class="main-section">
  <?php require_once "./assign-checklists-content.php"; ?>
</div>
<script src="https://code.jquery.com/jquery-3.5.1.js" integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc=" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
<script src="../Asset/dashboard.js"></script>
<script src="./assign-checklists.js"></script>
</body>
</html>

<?php

if($_SESSION["role_id"]=="1"){
  echo "<script>adminFunction();</script>";
}
if($_SESSION["role_id"]=="2"){
  echo "<script>userFunction();</script>";
}
if($_SESSION["role_id"]=="3"){
  echo "<script>approverFunction();</script>";
}
if($_SESSION["role_id"]=="4"){
  echo "<script>userapproverFunction();</script>";
}
?>
