<?php

  $servername="localhost";
  $username="root";
  $password="";
  $database="checklist_manager";
  $con= new mysqli($servername, $username, $password, $database);

  $sql ="INSERT into checklist_assignment(assignment_id,checklist_id,assigned_to,approver) values ('$_POST[id]','$_POST[checklist_id]','$_POST[assigned_to]','$_POST[approver]')";
  if ($con->query($sql) === TRUE) {
    echo "New record created successfully";
  } else {
    echo "Error: " . $sql . "<br>" . $con->error;
  }

  header('Location: ../Assign-Checklists.php');
?>
