<?php
        $rowid=$_COOKIE["chkid"];
        $query1=$mysqli->query("SELECT max(checkitem_id) as m from checkitems_master WHERE checklist_id=$rowid");
        $num_rows = mysqli_fetch_row($query1)[0];
       
        $sql= $mysqli->query("SELECT * FROM checkitems_master WHERE checklist_id = $rowid AND delete_flag=0");
        $sql2= $mysqli->query("SELECT checklist_name FROM checklist_master WHERE checklist_id=$rowid");
        $title= mysqli_fetch_row($sql2)[0];
        echo"<a class='goback' href='./Checklists.php'><i class='fas fa-chevron-circle-left'></i> Back to Checklists</a>
             <h3 class=''>Checkitems</h3> 
             <div class='div-h6'>
                <div  class='title-h6'><h6>Checklist Name : </h3><span> $title</span></div>
                <div  class='title-h6'><h6 class='right-h6'>Checklist ID : </h3><span> $rowid</span></div>
             </div>";
        
         $num_rows+=1;
?>

<script> 
   var chk_id=parseInt("<?php echo $rowid ?>");
   var num_row = parseInt("<?php echo $num_rows ?>");
</script>
  
<span onclick="newElement()" class="create-new">Create New</span>
<table id='checkitems' class='table table-hover shadow container'>
    <thead> 
        <tr>
           <th class='input-col'>Checkitem ID</th>
           <th>Checkitem</th>
           <th class="action-col">Action</th>
        </tr>
    </thead>   
    <tbody>
        <?php
         while ($row= $sql->fetch_assoc()) {
         echo"
            <tr> 
               <td class='input-col'>".$row['checkitem_id']."</td>
               <td>".$row['checkitem']."</td>
               <td class='action-col'>
               <button type='button' onclick=checkitemEdit(this) class='btn btn-default'>
                <i class='fa fa-pen-square fa-lg'></i>
               </button>
               <button type='button' onclick=checkitemDelete(this) class='btn btn-default'>
                <i class='fa fa-times-circle fa-lg'></i>
               </button>
               </td>
             </tr>";
         };            
        ?> 
    </tbody> 
</table> 
 