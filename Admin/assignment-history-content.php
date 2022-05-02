<?php
$sql = $mysqli->query("SELECT cat.task_id, cat.assignment_id, cat.status_id, cat.assigned_on, u1.username as perf, u2.username as appr, cm.checklist_name, cm.checklist_id, ca.assigned_to, ca.approver 
        FROM checklist_assignment_task cat, checklist_assignment ca, checklist_master cm, users u1, users u2 
        WHERE cat.assignment_id = ca.assignment_id AND ca.checklist_id = cm.checklist_id AND u2.employee_id = ca.approver AND u1.employee_id = ca.assigned_to 
        AND cat.delete_flag = 0 AND cm.delete_flag = 0 AND ca.delete_flag = 0 AND u1.delete_flag = 0 AND u2.delete_flag = 0
        ORDER BY assigned_on DESC");
?>

    <h3 class="title">Assignment History</h3>
    <table id="checklists" class="table table-hover shadow">
        <thead>
            <tr>
                <th scope="col">Task ID</th>
                <th scope="col">Assign. ID</th>
                <th scope="col">Checklist ID</th>
                <th class="input-col" scope="col">Checklist Name</th>
                <th scope="col" class="action-col">Performer</th>
                <th scope="col" class="action-col">Approver</th>
                <th scope="col">Assigned On</th>
                <th scope="col">Status</th>
                <th scope="col">Action</th>
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
                            $status = "Completed";
                            break;
                    case 4:
                            $status = "Rejected";
                            break;
                    }  
            ?>
            <tr>
              <td><?php echo $row['task_id']; ?></td>
              <td><?php echo $row['assignment_id']; ?></td>   
              <td><?php echo $row['checklist_id']; ?></td>
              <td class="input-col"><?php echo $row['checklist_name']; ?></td>
              <td class="action-col"><?php echo $row['perf']; ?></td>
              <td class="action-col"><?php echo $row['appr']; ?></td>
              <td><?php echo $row['assigned_on']; ?></td>
              <td><?php echo $status; ?></td>
              <td><button type='button' onclick='deleteassignment(this);' class='btn btn-default'><i class='fa fa-trash-alt'></i></button></td>
            </tr>
            <?php } ?>
        </tbody>
    </table>
 