<script>
  var session_name = "<?php echo $_SESSION['username']; ?>";
</script>
  
<?php

        $sql= $mysqli->query("SELECT ca.assignment_id,cm.checklist_name, cm.checklist_id as chk_id ,u1.username as user1,u2.username as user2,
        u1.employee_id as u1_id ,u2.employee_id as u2_id
        FROM checklist_assignment ca,users u1,users u2,checklist_master cm 
        where ca.assigned_to=u1.employee_id and ca.approver=u2.employee_id and ca.checklist_id=cm.checklist_id 
        and ca.delete_flag=0 and cm.delete_flag=0 and u1.delete_flag=0 and u2.delete_flag=0
        ORDER BY assignment_id DESC"); 
        ?>

        <h3 class='title'>Assignment History</h3>
        <a class='create-new' href='./Assignment_Creation/Assignment-Creation.php'>+ Create</a>
        <table class='table table-hover shadow''>
         <thead>
            <tr>
              <th>Assignment ID</th>
              <th>Checklist Name</th>
              <th>Assigned To</th>
              <th>Approver</th>
              <th class='action-col'>Action</th>
              <th></th>
            </tr>
        </thead>
<?php
        $records1 =$mysqli->query("SELECT checklist_id,checklist_name From checklist_master order by checklist_name ASC");
        $records2 =$mysqli->query("SELECT users.employee_id as u1_id,users.username as user1 From users INNER JOIN user_authority as ua where users.employee_id=ua.employee_id AND (ua.role_id=2 OR ua.role_id=4) AND ua.delete_flag=0 AND users.delete_flag=0");   
        $records3 =$mysqli->query("SELECT  users.employee_id as u2_id,users.username as user2 From users INNER JOIN user_authority as ua where users.employee_id=ua.employee_id AND (ua.role_id=3 OR ua.role_id=4) AND ua.delete_flag=0 AND users.delete_flag=0");   
        $records4 =$mysqli->query("SELECT  max(task_id) from checklist_assignment_task;");
        
      

        while($data = mysqli_fetch_assoc($records1)) {
            $arr1[]=$data;  
        }	
        $arr1=json_encode($arr1);

        while($data = mysqli_fetch_assoc($records2)) {
          $arr2[]=$data;
        }
        $arr2=json_encode($arr2);
        while($data = mysqli_fetch_assoc($records3)) {
          $arr3[]=$data;  
        }	
        $arr3=json_encode($arr3);

        $num_rows = mysqli_fetch_row($records4)[0];
        $num_rows += 1;
       
        while ($row= $sql->fetch_assoc()) {
        echo" 
        <form id='myform' action='../checkitems/checkitems.php' method='POST'>
             <tr>
             <input type='hidden' id='assignment_id' value=".$row['assignment_id'].">
              <td>".$row['assignment_id']."</td>
              
              <input type='hidden' id='chk_id' value=".$row['chk_id']."> 
              <td id='checklist_name'>".$row['checklist_name']."</td>

              <input type='hidden'id='u1_id' value=".$row['u1_id']."> 
              <td id='assign_to'>".$row['user1']."</td>

              <input type='hidden' id='u2_id' value=".$row['u2_id']."> 
              <td id='approver'>".$row['user2']."</td>

              <td class='action-col'><button type='button' onclick='checklistEdit(this);' class='btn btn-default'>
              <i class='fa fa-pen-square fa-lg'></i>
              </button>
              <button type='button' onclick='checklistDelete(this);' class='btn btn-default'>
              <i class='fa fa-times-circle fa-lg'></i>
              </button>
              </td>
              <td>
              <button type='button' class='assign-btn' onclick='taskAssign(this);'>
              Assign</button>
              </td>
            </tr> 
            </form>";
          }           
  
    ?> 
    <script>
      var checklist =<?php echo $arr1 ?>;

      var assigned_to=<?php echo $arr2 ?>;

      var approver=<?php echo $arr3 ?>;

      var task_id=<?php echo $num_rows ?>;
    </script>
