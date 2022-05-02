<?php
  $employee_id = $_SESSION['employee_id'];
  $sql= $mysqli->query("SELECT cat.task_id, cat.status_id, cat.assignment_id, cat.assigned_on, u.username, cm.checklist_name, cm.checklist_id, com.comment 
  FROM checklist_assignment_task cat, checklist_assignment ca, checklist_master cm, users u, comments com 
  WHERE cat.assignment_id = ca.assignment_id AND ca.checklist_id = cm.checklist_id AND cat.task_id = com.task_id 
  AND ca.approver = '$employee_id' AND u.employee_id = ca.assigned_to
  AND cat.delete_flag = 0 AND cm.delete_flag = 0 AND ca.delete_flag = 0 AND u.delete_flag = 0
  ORDER BY cat.assigned_on DESC");
?>

<h3 class='title'>Approver Checklists</h3>

<div class="radio-form">
<div class="form-check form-check-inline">
        <input class="form-check-input" type="radio" id="all-radio" name="sort-radios" checked><label class="form-check-label">All</label>
</div>
<div class="form-check form-check-inline">
        <input class="form-check-input" type="radio" id="inprogress-radio" name="sort-radios"><label class="form-check-label">In Progress</label>
</div>
<div class="form-check form-check-inline">
        <input class="form-check-input" type="radio" id="approved-radio" name="sort-radios"><label class="form-check-label">Approved</label>
</div>
<div class="form-check form-check-inline">
        <input class="form-check-input" type="radio" id="rejected-radio" name="sort-radios"><label class="form-check-label">Rejected</label>
</div>
</div>

<table id="checklists" class="table table-hover shadow">
        <thead>
            <tr>
                <th scope="col">Status</th>
                <th scope="col">Task ID</th>
                <th scope="col">Assign. ID</th>
                <th scope="col">Checklist ID</th>
                <th class="input-col" scope="col">Checklist Name</th>
                <th scope="col">Performer</th>
                <th scope="col">My Comment</th>
                <th scope="col">Assigned On</th>
            </tr>
        </thead>
        <tbody>
            <?php while($row = $sql->fetch_assoc()){
                switch ($row['status_id']) {
                    case 1:
                            $status = "Incomplete";
                            break;
                    case 2:
                            $status = "Submitted";
                            break;
                    case 3:
                            $status = "Approved";
                            break;
                    case 4:
                            $status = "Rejected";
                            break;
                    }  
            ?>
            <tr>
              <td><?php echo $status; ?></td>
              <td><?php echo $row['task_id']; ?></td>
              <td><?php echo $row['assignment_id']; ?></td>   
              <td><?php echo $row['checklist_id']; ?></td>
              <td class="input-col"><?php echo $row['checklist_name']; ?></td>
              <td><?php echo $row['username']; ?></td>
              <td><?php echo $row['comment']; ?></td>
              <td><?php echo $row['assigned_on']; ?></td>
            </tr>
            <?php } ?>
        </tbody>
</table>
 