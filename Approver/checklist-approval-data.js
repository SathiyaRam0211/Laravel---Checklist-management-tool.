function approvetask(){
    var action=3;
    var comment=$('#comment').val();
    $.ajax({
        type: "POST",
        url: "db_approvaldata.php",
        data:{task_id:task_id,comment:comment,action:action,emp_id:session_name},
        success: function(res){  
            console.log(res);
            alert("Success: Checklist Approved!");
            location.replace("./Checklist-Approval.php");
        } 
       });
}


function rejecttask(){
    var action=4;
    var comment=$('#comment').val();
    $.ajax({
        type: "POST",
        url: "db_approvaldata.php",
        data:{task_id:task_id,comment:comment,action:action,emp_id:session_name},
        success: function(res){  
            console.log(res);
            alert("Success: Checklist Rejected!");
            location.replace("./Checklist-Approval.php");
        } 
       });
}