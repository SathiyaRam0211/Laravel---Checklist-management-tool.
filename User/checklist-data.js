var item={};

function checkitemFinish(ctl){
    $(ctl).closest('tr').removeClass('.incomplete');
    var checkitem_id=$(ctl).closest('tr').find('td:eq(0)').html();  
    item[checkitem_id]=2;  
     $(ctl).closest('tr').find('td:eq(2)').html("Completed"); 
}

function checkitemExclude(ctl){
    $(ctl).closest('tr').removeClass('.incomplete');
    var checkitem_id=$(ctl).closest('tr').find('td:eq(0)').html();  
    item[checkitem_id]=3;
     $(ctl).closest('tr').find('td:eq(2)').html("Excluded"); 
    }


function submitbtn(){
if(!$('tr').hasClass('.incomplete')){
    console.log(item); 
    console.log(task_id);

    var remarks={}
    $( "tbody tr" ).each(function(i) {
        i=i+1;
        remarks[i]=$(this).find('td').find('input').val(); 
      });
      console.log(remarks);

    $.ajax({
        type: "POST",
        url: "db_checklistdata.php",
        data:{item:item,task_id:task_id,remarks:remarks},
        success: function(res){  
            console.log(res);
            location.replace("./Checklist-Execution.php");
        } 
       });
}   
else{

alert('complete all task');
}
}