function userEdit(ctl){
    var row=$(ctl).closest('tr').addClass("editing");
    var value1=$(ctl).closest('tr').find('td:eq(0)').html();
    var value2=$(ctl).closest('tr').find('td:eq(2)').html();
    value1="'"+value1+"'";
    switch(value2){
        case "Admin": var value3 = "1";
                      break;
        case "User": var value3 = "2";
                      break;
        case "Approver": var value3 = "3";
                      break;
        case "User and Approver": var value3 = "4";
                      break;
    }
    $(ctl).closest('tr').find('td:eq(0)').html("<input class='form-control form-control-sm' type='text' value="+value1+">");
    $(ctl).closest('tr').find('td:eq(2)').html(
    "<select class='custom-select custom-select-sm' id='role-dropdown'>"+ 
    "<option value='1'>Admin</option>"+
    "<option value='2'>User</option>"+
    "<option value='3'>Approver</option>"+
    "<option value='4'>User and Approver</option>"+
    "</select>");

    $("select option[value="+value3+"]").attr("selected","selected");

    $(ctl).closest('tr').find('td:eq(5)').html(
        "<button type='button' class='btn btn-default' onClick='userSave(this);'>"+
        "<i class='fas fa-save fa-lg'></i>"+
        "</button>"+
        " <button type='button' class='btn btn-default' onClick='userDelete(this)'>"+
        "<i class='fa fa-times-circle fa-lg'></i>"+
        "</button>"
         );
}

function userSave(ctl){
    var row=$(ctl).closest('tr').removeClass("editing");
    var id=$(ctl).closest('tr').find('td:eq(1)').html();
    var value1=$(ctl).closest('tr').find('td:eq(0)>input').val();
    if($.trim(value1))
    {
    var value2=$(ctl).closest('tr').find('td:eq(2)>select').val();
    var htmlvalue;
    switch (value2) { 
        case "1": 
            htmlvalue="Admin";
            break;
        case "2": 
            htmlvalue="User";
            break;
        case "3": 
            htmlvalue="Approver";
            break;		
        case "4": 
            htmlvalue="User and Approver";
            break;
    }
    $(ctl).closest('tr').find('td:eq(0)').html(value1);
    $(ctl).closest('tr').find('td:eq(2)').html(htmlvalue);


        var user={};
        user["emp_id"]=id;
        user["username"]=value1;
        user["role"]=value2;
 
        console.log(user);
 
        $.ajax({
             type: "POST",
             url: "db_userupdate.php",
             data:{item:user},
             success: function(res){  
                 console.log(res);   
         } 
        });
        $(ctl).closest('tr').find('td:eq(5)').html(
            "<button type='button' class='btn btn-default' onClick='userEdit(this);'>"+
            "<i class='fa fa-pen-square fa-lg'></i>"+
            "</button>"+
            " <button type='button' class='btn btn-default' onClick='userDelete(this)'>"+
            "<i class='fa fa-times-circle fa-lg'></i>"+
            "</button>"
             );
        }
        else{
            alert("Enter Username!");
        }
    }

function userDelete(ctl){
    var id=$(ctl).closest('tr').find('td:eq(1)').html();
    $(ctl).closest('tr').remove();
    $.ajax({
        type: "POST",
        url: "db_userdelete.php",
        data:{item:id},
        success: function(res){  
            console.log(res);   
    } 
   });
}