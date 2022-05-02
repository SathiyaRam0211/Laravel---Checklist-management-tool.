<?php
        $servername="localhost";
        $username="root";
        $password="";
        $database="checklist_manager";
        $conn = new mysqli($servername, $username, $password, $database);

        if ($conn->connect_error) {
          die("Connection failed: " . $conn->connect_error);
        }

        $data1=$_POST['task_id'];
        $data2=$_POST['action'];
        $data3=$_POST['comment'];
        $data4=$_POST['emp_id'];

         $sql1 = "UPDATE checklist_assignment_task SET status_id='$data2' WHERE task_id='$data1'";

         $sql2="INSERT INTO checklist_approval (task_id,changed_by) VALUES ($data1,'$data4')";

         $sql3="UPDATE comments SET comment = '$data3', created_by = '$data4' WHERE task_id='$data1'";

         if ($conn->query($sql1) === TRUE && $conn->query($sql2) === TRUE && $conn->query($sql3)) {
          echo('over over');
        } 
        else {
          echo "Error: " . $sql3 . "<br>" . $conn->error;
        }
        $conn->close(); 
 
?>