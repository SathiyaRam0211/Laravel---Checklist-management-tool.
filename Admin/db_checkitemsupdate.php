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

         $sql = "UPDATE checkitems_master SET checkitem='$data[checkitem]' where checklist_id='$data[chk_id]' AND checkitem_id='$data[checkitem_id]'";

        if ($conn->query($sql) === TRUE) {
            echo("Finally");
          } 
          else {
            echo "Error: " . $sql . "<br>" . $conn->error;
          }
        $conn->close(); 
 
?>