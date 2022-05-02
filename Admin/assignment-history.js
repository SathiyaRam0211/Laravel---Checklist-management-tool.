function deleteassignment(ctl){
    var id=$(ctl).closest('tr').find('td:eq(0)').html();
    $(ctl).closest('tr').remove();
    $.ajax({
        type: "POST",
        url: "db_assignmenthistory.php",
        data:{item:id},
        success: function(res){  
        console.log(res);   
        } 
       });
     }
  