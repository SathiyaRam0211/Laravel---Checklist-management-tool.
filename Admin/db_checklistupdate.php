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

         $sql = "UPDATE checklist_master SET checklist_name='$data[checklist_name]' ,purpose='$data[purpose]' ,updated_by='$data[updated_by]',updated_on=current_timestamp where checklist_id='$data[id]'";

        if ($conn->query($sql) === TRUE) {
          $date=$conn->query("SELECT updated_on from checklist_master where checklist_id='$data[id]'");
          echo(mysqli_fetch_row($date)[0]);
          } 
          else {
            echo "Error: " . $sql . "<br>" . $conn->error;
          }
        $conn->close(); 
 
?>