<script>
  var session_name = "<?php echo $_SESSION['username']; ?>";
</script>

<?php
  $employee_id = $_SESSION['employee_id'];
  
  $count= $mysqli->query("SELECT COUNT(cat.task_id)
        FROM checklist_assignment_task cat,checklist_assignment ca
        where cat.assignment_id=ca.assignment_id AND ca.assigned_to= '$employee_id'
        AND cat.delete_flag=0 AND ca.delete_flag=0 AND (cat.status_id=1 OR cat.status_id=4)");
  $count1  = mysqli_fetch_row($count)[0];

  if($count1){
  $sql= $mysqli->query("SELECT cat.task_id, cat.assignment_id, cat.assigned_on, u.username, cm.checklist_name, cm.checklist_id, cm.purpose 
  FROM checklist_assignment_task cat, checklist_assignment ca, checklist_master cm, users u 
  WHERE cat.assignment_id = ca.assignment_id AND ca.checklist_id = cm.checklist_id 
  AND ca.assigned_to = '$employee_id' AND cat.status_id = '1' AND u.employee_id = ca.approver
  AND cat.delete_flag = 0 AND cm.delete_flag = 0 AND ca.delete_flag = 0
  ORDER BY cat.task_id DESC");
?>

<h3 class='title'>Checklist Execution</h3>
<h4 class='section-title'>Pending</h5>
    <div class="container">
    <?php
        while ($row= $sql->fetch_assoc()) { ?>
        <div  class="checklist-card row">
            <div  onclick=checklistdata(this); class="checklist-icon-area col-md-3">
                <i class="fad fa-folder-open fa-3x"></i>
                <input type="hidden" value=<?php echo $row['task_id'];?>>
            </div>
            <div class="col-md-9">
                <div class="row first">
                    <div class="col-md-3">
                            <div class="row"><span><i>Task ID</i></span></div>
                            <div class="row task_id"><h6><?php echo $row['task_id']; ?></h6></div>
                    </div>
                    <div class="col-md-3">
                            <div class="row"><span><i>Assignment ID</i></span></div>
                            <div class="row"><h6><?php echo $row['assignment_id']; ?></h6></div>   
                    </div>
                    <div class="col-md-3">
                            <div class="row"><i><span>Checklist ID</i></span></div>
                            <div class="row"><h6><?php echo $row['checklist_id']; ?></h6></div>
                    </div>
                    <div class="col-md-3">
                            <div class="row"><i><span>Approver</span></i></div>
                            <div class="row"><h6><?php echo $row['username']; ?></h6></div>
                    </div>
                </div>
                <div class="row second">
                    <div class="col-md-4">
                            <div class="row"><i><span>Checklist Name</span></i></div>
                            <div class="row"><h6><?php echo $row['checklist_name']; ?></h6></div>
                    </div>
                    <div class="col-md-5">
                            <div class="row"><i><span>Purpose</span></i></div>
                            <div class="row"><h6><?php echo $row['purpose']; ?></h6></div>
                    </div>
                    <div class="col-md-3">
                            <div class="row"><i><span>Assigned On</span></i></div>
                            <div class="row"><h6><?php echo $row['assigned_on']; ?></h6></div>
                    </div>
                </div>
            </div>
        </div>
    <?php } ?>
    </div>  
    <?php }else{ ?>
            <h3 class='title'>Checklist Execution</h3>
            <div class="congrats-bg jumbotron">
                <span class="dashboard-username">
                        It's Empty Here.
                </span>
                <p class="dashboard-subtitle">
                        Great! You have no pending Checklists to be Executed.
                </p>
            </div>
    <?php } ?>

    <?php

  $count= $mysqli->query("SELECT COUNT(cat.task_id)
        FROM checklist_assignment_task cat,checklist_assignment ca
        where cat.assignment_id=ca.assignment_id AND ca.assigned_to= '$employee_id'
        AND cat.delete_flag=0 AND ca.delete_flag=0 AND cat.status_id=4");
  $count2  = mysqli_fetch_row($count)[0];

  if($count2){
  $sql= $mysqli->query("SELECT cat.task_id, cat.assignment_id, cat.assigned_on, u.username, cm.checklist_name, cm.checklist_id, cm.purpose, com.comment 
  FROM checklist_assignment_task cat, checklist_assignment ca, checklist_master cm, users u, comments com 
  WHERE cat.assignment_id = ca.assignment_id AND ca.checklist_id = cm.checklist_id AND cat.task_id = com.task_id
  AND ca.assigned_to = '$employee_id' AND cat.status_id = '4' AND u.employee_id = ca.approver
  AND cat.delete_flag = 0 AND cm.delete_flag = 0 AND ca.delete_flag = 0
  ORDER BY cat.task_id DESC");
?>
    <h4 class='section-title'>Rejected</h5>
    <div class="container">
    <?php
        while ($row= $sql->fetch_assoc()) { ?>
        <div  class="checklist-card row">
            <div  onclick=checklistdata(this); class="checklist-icon-area col-md-3">
                <i class="i-reject fad fa-folder-open fa-3x"></i>
                <input type="hidden" value=<?php echo $row['task_id'];?>>
            </div>
            <div class="col-md-9">
                <div class="row first">
                    <div class="col-md-3">
                            <div class="row"><span><i class="i-reject">Task ID</i></span></div>
                            <div class="row task_id"><h6><?php echo $row['task_id']; ?></h6></div>
                    </div>
                    <div class="col-md-3">
                            <div class="row"><span><i class="i-reject">Assignment ID</i></span></div>
                            <div class="row"><h6><?php echo $row['assignment_id']; ?></h6></div>   
                    </div>
                    <div class="col-md-3">
                            <div class="row"><i class="i-reject"><span>Checklist ID</i></span></div>
                            <div class="row"><h6><?php echo $row['checklist_id']; ?></h6></div>
                    </div>
                    <div class="col-md-3">
                            <div class="row"><i class="i-reject"><span>Approver</span></i></div>
                            <div class="row"><h6><?php echo $row['username']; ?></h6></div>
                    </div>
                </div>
                <div class="row second">
                    <div class="col-md-3">
                            <div class="row"><i class="i-reject"><span>Checklist Name</span></i></div>
                            <div class="row"><h6><?php echo $row['checklist_name']; ?></h6></div>
                    </div>
                    <div class="col-md-3">
                            <div class="row"><i class="i-reject"><span>Purpose</span></i></div>
                            <div class="row"><h6><?php echo $row['purpose']; ?></h6></div>
                    </div>
                    <div class="col-md-3">
                            <div class="row"><i class="i-reject"><span>Comment</span></i></div>
                            <div class="row"><h6><?php echo $row['comment']; ?></h6></div>
                    </div>
                    <div class="col-md-3">
                            <div class="row"><i class="i-reject"><span>Assigned On</span></i></div>
                            <div class="row"><h6><?php echo $row['assigned_on']; ?></h6></div>
                    </div>
                </div>
            </div>
        </div>
    <?php } ?>
    </div>  
<?php } ?>