function checklistdata(ctl){
    var task_id=$(ctl).find('input').val();
    console.log(task_id);
    document.cookie = "taskid="+task_id+";path=/";  
    $(location).attr('href',"./Checklist-Data.php");
}
