<?php
  $employee_id = $_SESSION['employee_id'];
  $sql= $mysqli->query("SELECT cat.task_id, cat.status_id, cat.assignment_id, cat.assigned_on, comments.comment, checklist_approval.changed_on, u.username, cm.checklist_name, cm.checklist_id 
  FROM checklist_assignment_task cat, checklist_assignment ca, checklist_master cm, users u, comments, checklist_approval
  WHERE cat.assignment_id = ca.assignment_id AND ca.checklist_id = cm.checklist_id AND cat.task_id = comments.task_id AND cat.task_id = checklist_approval.task_id
  AND ca.assigned_to = '$employee_id' AND u.employee_id = ca.approver AND cat.status_id = '4'
  AND cat.delete_flag = 0 AND cm.delete_flag = 0 AND ca.delete_flag = 0 AND u.delete_flag = 0
  ORDER BY cat.assigned_on DESC");
?>

<h3 class='title'>Rejected Checklists</h3>
<table id="checklists" class="table table-hover shadow">
        <thead>
            <tr>
                <th scope="col">Task ID</th>
                <th scope="col">Assign. ID</th>
                <th scope="col">Checklist ID</th>
                <th class="input-col" scope="col">Checklist Name</th>
                <th scope="col">Approver</th>
                <th scope="col">Assigned On</th>
                <th scope="col">Rejected On</th>
                <th scope="col">Comments</th>
            </tr>
        </thead>
        <tbody>
            <?php while($row = $sql->fetch_assoc()){
            ?>
            <tr>
              <td><?php echo $row['task_id']; ?></td>
              <td><?php echo $row['assignment_id']; ?></td>   
              <td><?php echo $row['checklist_id']; ?></td>
              <td class="input-col"><?php echo $row['checklist_name']; ?></td>
              <td><?php echo $row['username']; ?></td>
              <td><?php echo $row['assigned_on']; ?></td>
              <td><?php echo $row['changed_on']; ?></td>
              <td><?php echo $row['comment']; ?></td>
            </tr>
            <?php } ?>
        </tbody>
</table>
 