<?php
        $servername="localhost";
        $username="root";
        $password="";
        $database="checklist_manager";
        $conn = new mysqli($servername, $username, $password, $database);

        if ($conn->connect_error) {
          die("Connection failed: " . $conn->connect_error);
        }


        $data=$_POST['item'];

         $sql1 = "UPDATE checklist_master SET delete_flag=1  where checklist_id='$data'";
         $sql2 = "UPDATE checkitems_master SET delete_flag=1  where checklist_id='$data'";

        if ($conn->query($sql1) === TRUE && $conn->query($sql2) === TRUE) {
          echo "Soft Deleted";
          } 
          else {
            echo "Error: " . $sql . "<br>" . $conn->error;
          }
        $conn->close(); 
 
?>