 function checklistEdit(ctl){
   var row=$(ctl).closest('tr').addClass("editing");
   var value1=$(ctl).closest('tr').find('#chk_id').val();
   var val1=$(ctl).closest('tr').find('td:eq(1)').html();
 
   var value2=$(ctl).closest('tr').find('#u1_id').val();
   var val2=$(ctl).closest('tr').find('td:eq(2)').html();

   var value3=$(ctl).closest('tr').find('#u2_id').val();
   var val3=$(ctl).closest('tr').find('td:eq(3)').html();

   console.log(value1,value2,value3);

   $(ctl).closest('tr').find('td:eq(1)').html(
      "<select class='form-control-sm' id='sel1'>"+
      "<option id='opt1' value="+value1+">"+val1+"</option>"
      +"</select>"
   );
   checklist.forEach(element => {  
      if(element.checklist_id!=value1){
      $("<option id='opt1' value="+element.checklist_id+">"+element.checklist_name+"</option>").appendTo('#sel1');
      }
    })


   $(ctl).closest('tr').find('td:eq(2)').html(
      "<select class='form-control-sm' id ='sel2'>"+
      "<option id='opt2' value="+value2+">"+val2+"</option>"
      +"</select>"
   );
   assigned_to.forEach(element => {  
      if(element.u1_id!=value2){
      $("<option id='opt2' value="+element.u1_id+">"+element.user1+"</option>").appendTo('#sel2');
      }
   })


   
   $(ctl).closest('tr').find('td:eq(3)').html(
      "<select class='form-control-sm' id='sel3'>"+
      "<option id='opt3' value="+value3+">"+val3+"</option>"
      +"</select>"
      );
      approver.forEach(element => {  
         if(element.u2_id!=value3){
         $("<option id='opt3' value="+element.u2_id+">"+element.user2+"</option>").appendTo('#sel3') ;
         }
      })
  
   $(ctl).closest('tr').find('td:eq(4)').html(
   "<button type='button' onclick='checklistSave(this);' class='btn btn-default'>" +
   "<i class='fad fa-save fa-lg' aria-hidden='true'></i>" +
   "</button>" +
   "<button type='button' onclick='checklistDelete(this);' class='btn btn-default'>" +
   "<i class='fa fa-times-circle fa-lg' aria-hidden='true'></i>" +
   "</button>" );
}

 
 function checklistSave(ctl){

   var row=$(ctl).closest('tr').removeClass("editing");
   var id=$(ctl).closest('tr').find('#assignment_id').val();
   var value1=$(ctl).closest('tr').find('#sel1 option:selected').val();
   var val1=$(ctl).closest('tr').find('#sel1 option:selected').text();
   var value2=$(ctl).closest('tr').find('#sel2 option:selected').val();
   var val2=$(ctl).closest('tr').find('#sel2 option:selected').text(); 
   var value3=$(ctl).closest('tr').find('#sel3 option:selected').val();
   var val3=$(ctl).closest('tr').find('#sel3 option:selected').text();

   if(value2 !=value3){
   $('#chk_id').val(value1);
   $('#u1_id').val(value2);
   $('#u2_id').val(value3);


   console.log(val1,value1,val2,value2,val3,value3);
   
   $(ctl).closest('tr').find('td:eq(1)').html(val1);
   $(ctl).closest('tr').find('td:eq(2)').html(val2);
   $(ctl).closest('tr').find('td:eq(3)').html(val3);
      

      var assignment={};
      assignment["id"]=id;
      assignment["checklist_id"]=value1;
      assignment["assigned_to"]=value2;
      assignment["approver"]=value3;

      console.log(assignment);

         $.ajax({
            async:false,
            type: "POST",
            url: "db_assignmentupdate.php",
            data:{item:assignment},
            success: function(res){  
        } 
      });
      $(ctl).closest('tr').find('td:eq(4)').html(
         "<button type='button'  onclick='checklistEdit(this);' class='btn btn-default'>" +
         "<i class='fa fa-pen-square fa-lg'></i>"+
         "</button>" +
         "<button type='button' onclick='checklistDelete(this);' class='btn btn-default'>" +
         "<i class='fa fa-times-circle fa-lg'></i>" +
         "</button>" );
      }
      else{
         alert("User and Approver cannot be same.");
      }
   }



   function checklistDelete(ctl){
      var id=$(ctl).closest('tr').find('#assignment_id').val();
      $(ctl).closest('tr').remove();
      $.ajax({
          type: "POST",
          url: "db_assignmentdelete.php",
          data:{item:id},
          success: function(res){  
              console.log(res);   
      } 
     });
   }

   function taskAssign(ctl){
      var assignment_id=$(ctl).closest('tr').find('#assignment_id').val();
      var checklist_id=$(ctl).closest('tr').find('#chk_id').val();
      $.ajax({
         type: "POST",
         url: "db_taskassign.php",
         data:{item:assignment_id,chk_id:checklist_id,task_id:task_id},
         success: function(res){  
             console.log(res);
             var current = new Date();
             alert("Success: Checklist Assigned on "+current.getDate()+"-"+
             (current.getMonth()+1)+"-"+
             current.getFullYear()+" "+
             current.getHours()+":"+
             current.getMinutes()+":"+
             current.getSeconds());   
     } 
    });
 
   }