

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

         $sql = "UPDATE checklist_assignment SET checklist_id='$data[checklist_id]' ,assigned_to='$data[assigned_to]' , approver='$data[approver]'  where assignment_id='$data[id]'";

        if ($conn->query($sql) === TRUE) {
            echo("Finally");
          } 
          else {
            echo "Error: " . $sql . "<br>" . $conn->error;
          }
        $conn->close(); 
 
?>