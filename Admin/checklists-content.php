<script>
  var session_name = "<?php echo $_SESSION['username']; ?>";
</script>
  
<?php

  $sql= $mysqli->query("SELECT * FROM checklist_master WHERE delete_flag = 0 ORDER BY checklist_id ASC");
  
  echo "<h3 class='title'>Checklists</h3>
        <a class='create-new' href='./Checklist_Creation/Checklist-Creation.php'>+ Create</a>
        <table id='checklists' class='table table-hover shadow'>
         <thead>
            <tr>
              <th class='id-col'>ID</th>
              <th class='input-col'>Checklist Name</th>
              <th class='input-col'>Purpose</th>
              <th>Created By</th>
              <th class='date-col'>Created On</th>
              <th>Updated By</th>
              <th class='date-col'>Updated On</th>
              <th class='action-col'>Action</th>
            </tr>
        </thead>";

        while ($row= $sql->fetch_assoc()) {
        echo"<form id='myform' action='./Checkitems.php' method='POST'>
            <tr class='checklist-row'>
              <td class='id-col'>".$row['checklist_id']."</td>   
              <td class='input-col'>".$row['checklist_name']."</td>
              <td class='input-col'>".$row['purpose']."</td>
              <td>".$row['created_by']."</td>
              <td class='date-col'>".$row['created_on']."</td>
              <td>".$row['updated_by']."</td>
              <td class='date-col'>".$row['updated_on']."</td>
              <td class='action-col'><button type='button' onclick='checklistEdit(this);' class='btn btn-default'>
              <i class='fa fa-pen-square'></i>
              </button>
              <button type='button' onclick='checklistDelete(this);' class='btn btn-default'>
              <i class='fa fa-times-circle'></i>
              </button>
              </td>
              <input type='hidden' name='idinput' value=".$row['checklist_id']."> 
            </tr> 
            </form>";
        };            
?> 