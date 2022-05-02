<?php
    $rowid=$_COOKIE["taskid"];

    $sql1= $mysqli->query("SELECT cm.checklist_id,cm.checklist_name,cim.checkitem,cim.checkitem_id,cat.task_id,ca.assignment_id,cat.assigned_on,cd.remarks,cevm.value_name 
    FROM checklist_master cm,checkitems_master cim,checklist_assignment ca,checklist_assignment_task cat,checklist_data cd, checklist_execution_value_master cevm 
    where cm.checklist_id=cim.checklist_id AND ca.checklist_id=cm.checklist_id AND cevm.value_id=cd.value_id AND cim.checkitem_id=cd.checkitem_id AND ca.assignment_id=cat.assignment_id AND cd.task_id=cat.task_id 
    AND cd.task_id=$rowid AND cm.delete_flag=0 AND cat.delete_flag=0 AND cim.delete_flag=0 AND ca.delete_flag=0 AND cd.delete_flag=0 AND cevm.delete_flag=0 ");

        $title=mysqli_fetch_row($sql1)[1];
        mysqli_data_seek($sql1, 0);
        $task_id=mysqli_fetch_row($sql1)[4];
        mysqli_data_seek($sql1, 0);
        $assigned_on=mysqli_fetch_row($sql1)[6];
        mysqli_data_seek($sql1, 0);
        $assigned_on = explode(" ", $assigned_on);
        ?>
            
        <a class="goback" href="./Checklist-Approval.php"><i class="fas fa-chevron-circle-left"></i> Back to Checklist Approval</a>
        <h3 class="title"><?php echo $title;?></h3>
        <script> 
        var task_id=parseInt("<?php echo $task_id ?>");
        var session_name="<?php echo $_SESSION['employee_id']; ?>";
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
                <th>Checkitem id</th>
                <th>Checkitem</th>
                <th>status </th>
                <th>Remarks </th>
              </tr>
            </thead>      
            <tbody>
                <?php
                    while ($row= $sql1->fetch_assoc()) {
                    echo"
                    <tr> 
                        <td>".$row['checkitem_id']."</td>
                        <td>".$row['checkitem']."</td>
                        <td>".$row['value_name']."</td>
                        <td>".$row['remarks']."</td>
                    </tr>";
                    };            
                ?> 
            </tbody> 
        </table> 

        <!-- comment table -->
        <div class="form-group">
            <label class="form-label"><i>Comment </i>:</label>
            <textarea class="form-control" id='comment' rows="2" cols=""></textarea>  
        </div>
        <button onclick="approvetask()" class="approved-btn ">Approve</button>   
        <button onclick="rejecttask()" class="rejected-btn">Reject</button>  


