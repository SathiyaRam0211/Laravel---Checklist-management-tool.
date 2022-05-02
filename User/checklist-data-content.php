<?php
        $rowid=$_COOKIE["taskid"];

        $sql1= $mysqli->query("SELECT cm.checklist_id,cm.checklist_name,cim.checkitem,cim.checkitem_id,cat.task_id,ca.assignment_id,cat.assigned_on
        FROM checklist_master cm,checkitems_master cim,checklist_assignment ca,checklist_assignment_task cat,checklist_data cd
        where cm.checklist_id=cim.checklist_id AND ca.checklist_id=cm.checklist_id AND cim.checkitem_id=cd.checkitem_id 
        AND ca.assignment_id=cat.assignment_id AND cd.task_id=cat.task_id AND cd.task_id=$rowid
        AND cm.delete_flag=0 AND cd.delete_flag=0 AND ca.delete_flag=0 AND cat.delete_flag=0 AND cd.delete_flag=0
        ORDER BY cim.checkitem_id ASC");

        $title=mysqli_fetch_row($sql1)[1];
        mysqli_data_seek($sql1, 0);
        $task_id=mysqli_fetch_row($sql1)[4];
        mysqli_data_seek($sql1, 0);
        $assigned_on=mysqli_fetch_row($sql1)[6];
        mysqli_data_seek($sql1, 0);
        $assigned_on = explode(" ", $assigned_on);
?>      

        <a class="goback" href="./Checklist-Execution.php"><i class="fas fa-chevron-circle-left"></i> Back to Checklist Execution</a>
        <h3 class="title"><?php echo $title;?></h3>
        <script> 
        var task_id=parseInt("<?php echo $task_id ?>");
        </script>
        <div>
          <span><i>Task ID </i></span>
          <h6><?php echo ": ".$task_id; ?></h6>
        </div>
          <span><i>Assigned On </i></span>
          <h6><?php echo ": ".$assigned_on[0]; ?></h6>

        <table id='checkitemtable' class='table table-hover shadow'>
         <thead>
              <tr>
                <th>Checkitem ID</th>
                <th class="input-col">Checkitem</th>
                <th>Status</th>
                <th class="action-col">Action</th>
                <th>Remarks</th>
              </tr>
        </thead>     
        <tbody>
     
<?php
         while ($row= $sql1->fetch_assoc()) {
         echo"
               <tr class='.incomplete'> 
               
               <td>".$row['checkitem_id']."</td>
               <td class='inpput-col'>".$row['checkitem']."</td>
               <td>Incomplete</td>
               <td class='action-col'>
               <button type='button' onclick=checkitemFinish(this) class='btn btn-default'>
               <i class='fad fa-check fa-lg'></i>
               </button>
               <button type='button' onclick=checkitemExclude(this) class='btn btn-default'>
               <i class='fad fa-times fa-lg'></i>
               </button>
               </td>    
               <td><input class='form-control-sm' type='text'></input>
             </tr>";
       
         };            
     ?> 
     </tbody> 
    </table> 
<span onclick="submitbtn()" class="assign-btn">Submit</span>    