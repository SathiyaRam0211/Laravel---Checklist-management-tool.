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
        $data2=$_POST['chk_id'];
        $data3=$_POST['task_id'];

         $sql1 = "INSERT INTO checklist_assignment_task (task_id,assignment_id) VALUES ($data3,$data1)";
         if ($conn->query($sql1) === TRUE) {
          echo "Inserted new row";
          } 
          else {
            echo "Error: " . $sql1 . "<br>" . $conn->error;
          }
 
         $query1=$conn->query("SELECT max(task_id) from checklist_assignment_task where delete_flag=0");
         $task_id = mysqli_fetch_row($query1)[0];
        
 
         $query2=$conn->query("SELECT checkitem_id from checkitems_master where checklist_id=$data2 AND delete_flag=0");
 
         while ($row= $query2->fetch_assoc()){
          $sql2=("INSERT INTO checklist_data (task_id,checkitem_id) VALUES ($task_id,$row[checkitem_id])");
 
          if ($conn->query($sql2) === TRUE) {
            echo "Inserted checkitem";
            } 
            else {
              echo "Error: " . $sql2 . "<br>" . $conn->error;
            }
         }
         
         $sql3 = "INSERT INTO comments (task_id) VALUES ($data3)";
         if ($conn->query($sql3) === TRUE) {
          echo "Inserted new row";
          } 
          else {
            echo "Error: " . $sql1 . "<br>" . $conn->error;
          }
    
        $conn->close(); 
 
?>