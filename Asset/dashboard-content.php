 <?php
        date_default_timezone_set("Asia/Calcutta");
        if(date("H") < 12){
                $gkey = 1;
                $greeting = "Good Morning";
                }else if(date("H") > 11 && date("H") < 18){
                        $gkey = 2;
                        $greeting = "Good Afternoon";
                        }else if(date("H") > 17){
                                $gkey=3;
                                $greeting="Good Evening";
                                        }  
        
        $employee_id = $_SESSION["employee_id"];
        $role_id = $_SESSION["role_id"];
        $username = $_SESSION["username"];

        switch($role_id){
        case 1: 
                $link1 = "../Admin/Checklist_Creation/Checklist-Creation.php"; 
                $link2 = "../Admin/Assignment_Creation/Assignment-Creation.php"; 
                $link3 = "../Admin/User_Creation/Create-User.php"; 
                $subtitle = "Welcome to Checklist Manager. Here are few shortcuts,
                <div class='row'>
                <div class='col'><a class='dashboard-btn ckl' href=".$link1.">Checklist +</a></div>
                <div class='col'><a class='dashboard-btn assi' href=".$link2.">Assignment +</a></div>
                <div class='col'><a class='dashboard-btn usr' href=".$link3.">User +</a></div>
                </div>";
                break;

        case 2:
                $count= $mysqli->query("SELECT COUNT(cat.task_id)
                FROM checklist_assignment_task cat,checklist_assignment ca
                where cat.assignment_id=ca.assignment_id AND ca.assigned_to= '$employee_id'
                AND cat.delete_flag=0 AND ca.delete_flag=0 AND (cat.status_id=1 OR cat.status_id=4)");
                $count1  = mysqli_fetch_row($count)[0];
                $link = "../User/Checklist-Execution.php";
                $subtitle = "Welcome to Checklist Manager. You have <strong><a href=".$link.">".$count1." checklist(s)</a></strong> , pending to be executed.";
                break;
        
        case 3:
                $count=$mysqli->query("SELECT COUNT(cat.task_id)
                FROM checklist_assignment_task cat,checklist_assignment ca
                where cat.assignment_id=ca.assignment_id AND ca.approver='$employee_id'
                AND cat.delete_flag=0 AND ca.delete_flag=0 AND cat.status_id=2");
                $count2  = mysqli_fetch_row($count)[0];
                $link = "../Approver/Checklist-Approval.php";
                $subtitle = "Welcome to Checklist Manager. You have <strong><a href=".$link.">".$count2." checklist(s)</a></strong> , pending to be approved.";
                break;
        
        case 4:
                $count= $mysqli->query("SELECT COUNT(cat.task_id)
                FROM checklist_assignment_task cat,checklist_assignment ca
                where cat.assignment_id=ca.assignment_id AND ca.assigned_to= '$employee_id'
                AND cat.delete_flag=0 AND ca.delete_flag=0 AND (cat.status_id=1 OR cat.status_id=4)");
                $count1  = mysqli_fetch_row($count)[0];
                $link1 = "../User/Checklist-Execution.php";
                
                
                $count=$mysqli->query("SELECT COUNT(cat.task_id)
                FROM checklist_assignment_task cat,checklist_assignment ca
                where cat.assignment_id=ca.assignment_id AND ca.approver='$employee_id'
                AND cat.delete_flag=0 AND ca.delete_flag=0 AND cat.status_id=2");
                $count2  = mysqli_fetch_row($count)[0];
                $link2 = "../Approver/Checklist-Approval.php";

                $subtitle = "Welcome to Checklist Manager. You have <strong><a href=".$link1.">".$count1." checklist(s)</a></strong> , pending to be executed 
                and <strong><a href=".$link2.">".$count2." checklist(s)</a></strong> , pending to be approved.";
                break;
        }
        

?>
<script> var gkey = <?php echo $gkey;?> ;</script>

<div class="sub-section">
        <div class="dashboard-banner jumbotron">
                <span class="dashboard-title">
                        <?php echo $greeting; ?>   
                </span>
                <span class="dashboard-username">
                        <?php echo $username; ?>
                </span>
                <p class="dashboard-subtitle">
                        <?php echo $subtitle; ?>
                </p>
        </div>
</div>