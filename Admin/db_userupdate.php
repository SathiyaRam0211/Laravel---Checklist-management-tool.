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

         $sql1 = "UPDATE users SET username='$data[username]' WHERE employee_id='$data[emp_id]'";
         $sql2 = "UPDATE user_authority SET role_id='$data[role]' WHERE employee_id='$data[emp_id]'";

        if ($conn->query($sql1) === TRUE && $conn->query($sql2) === TRUE) {
          echo "name and role updated";
          } 
          else {
            echo "Error: " . $sql . "<br>" . $conn->error;
          }
        $conn->close(); 
 
?>