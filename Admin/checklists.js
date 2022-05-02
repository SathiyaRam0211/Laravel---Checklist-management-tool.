function checklistDelete(ctl) {
   $(ctl).parents("tr").remove();

 }
 
 
 function checklistEdit(ctl){
   event.stopPropagation()
   var row=$(ctl).closest('tr').addClass("editing");
   var value1=$(ctl).closest('tr').find('td:eq(1)').html();
   var value2=$(ctl).closest('tr').find('td:eq(2)').html();
   value1="'"+value1+"'";
   value2="'"+value2+"'";
   $(ctl).closest('tr').find('td:eq(1)').html("<input type='text' class='form-control form-control-sm' value="+value1+">");
   $(ctl).closest('tr').find('td:eq(2)').html("<input type='text' class='form-control form-control-sm' value="+value2+">");
   $(ctl).closest('tr').find('td:eq(7)').html(
   "<button type='button' onclick='checklistSave(this);' class='btn btn-default'>" +
   "<i class='fas fa-save'></i>" +
   "</button>" +
   "<button type='button' onclick='checklistDelete(this);' class='btn btn-default'>" +
   "<i class='fa fa-times-circle'></i>" +
   "</button>" );
 
 }
 
 function checklistSave(ctl){
   event.stopPropagation();
   var row=$(ctl).closest('tr').removeClass("editing");
   var id=$(ctl).closest('tr').find('td:eq(0)').html();
   var value1=$(ctl).closest('tr').find('td:eq(1)>input').val();
   var value2=$(ctl).closest('tr').find('td:eq(2)>input').val();

   if($.trim(value1) && $.trim(value2)){
   $(ctl).closest('tr').find('td:eq(1)').html(value1);
   $(ctl).closest('tr').find('td:eq(2)').html(value2);



      var checklist={};
      var username=session_name;
      checklist["id"]=id;
      checklist["checklist_name"]=value1;
      checklist["purpose"]=value2;
      checklist["updated_by"]=username;

      console.log(checklist);

         $.ajax({
            async:false,
            type: "POST",
            url: "db_checklistupdate.php",
            data:{item:checklist},
            success: function(res){  
               time=res;   
        } 
      });
      console.log(time);
      $(ctl).closest('tr').find('td:eq(6)').html(time);
      $(ctl).closest('tr').find('td:eq(7)').html(
         "<button type='button'  onclick='checklistEdit(this);' class='btn btn-default'>" +
         "<i class='fa fa-pen-square'></i>"+
         "</button>" +
         "<button type='button' onclick='checklistDelete(this);' class='btn btn-default'>" +
         "<i class='fa fa-times-circle'></i>" +
         "</button>" );
   }
   else{
      alert("Enter Some Data!");
   }
   }

   function checklistDelete(ctl){
      var id=$(ctl).closest('tr').find('td:eq(0)').html();
      $(ctl).closest('tr').remove();
      $.ajax({
          type: "POST",
          url: "db_checklistdelete.php",
          data:{item:id},
          success: function(res){  
              console.log(res);   
      } 
     });
   }


$('tbody').find('tr').click( function(){
   var a=$(this).find("td:eq(0)").html();
   $('input:hidden').val(a);  
   console.log( $('input:hidden').val());
   document.cookie = "chkid="+a+";path=/";  
   if($(this).hasClass("editing"))
   {console.log("editing");
 }
   else{                                                                          
   $("#myform" ).submit();
   }
   });

   

    
      