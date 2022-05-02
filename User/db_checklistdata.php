<?php
        $servername="localhost";
        $username="root";
        $password="";
        $database="checklist_manager";
        $conn = new mysqli($servername, $username, $password, $database);

        if ($conn->connect_error) {
          die("Connection failed: " . $conn->connect_error);
        }


        $data1=$_POST['item'];
        $data2=$_POST['task_id'];
        $data3=$_POST['remarks'];
        $key=array_keys($data3);

        $key_value=array_combine(range(1, count($key)), $key);
        
        for($i=1;$i<=count($data1);$i++)
        {
         $sql = "UPDATE checklist_data SET value_id='$data1[$i]', remarks='$data3[$i]' WHERE task_id='$data2' AND checkitem_id='$key_value[$i]'";
         if ($conn->query($sql) === TRUE) {
          echo('over over');
        } 
        else {
          echo "Error: " . $sql . "<br>" . $conn->error;
        }
        }
        
        $sql2 = "UPDATE checklist_assignment_task SET status_id='2' WHERE task_id=$data2";
         if ($conn->query($sql2) === TRUE) {
          echo('over over');
        } 
        else {
          echo "Error: " . $sql . "<br>" . $conn->error;
        }
    
        $conn->close(); 
 
?>