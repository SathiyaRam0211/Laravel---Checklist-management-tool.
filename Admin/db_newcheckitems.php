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

        $sql = "INSERT INTO checkitems_master (checklist_id,checkitem_id,checkitem) VALUES('$data[chk_id]','$data[checkitem_id]','$data[checkitem]')";

        if ($conn->query($sql) === TRUE) {
            echo("Finally");
          } 
          else {
            echo "Error: " . $sql . "<br>" . $conn->error;
          }
        $conn->close(); 
 
?>