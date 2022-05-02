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

         $sql = "UPDATE checklist_assignment_task SET delete_flag=1 where task_id=$data";

        if ($conn->query($sql) === TRUE){
          echo "Soft Deleted";
          } 
          else {
            echo "Error: " . $sql . "<br>" . $conn->error;
          }
        $conn->close(); 
 
?>