<?php

  $servername="localhost";
  $username="root";
  $password="";
  $database="checklist_manager";
  $con= new mysqli($servername, $username, $password, $database);

$data=$_POST['checkitem'];

foreach ($data as $value) {

  $sql ="INSERT into checkitems_master(checklist_id,checkitem_id,checkitem) values ('$value[checklist_id]','$value[checkitem_id]','$value[checkitem]')";
  if ($con->query($sql) === TRUE) {
    echo "New record created successfully";
  } else {
    echo "Error: " . $sql . "<br>" . $con_db->error;
  }
}

?>
