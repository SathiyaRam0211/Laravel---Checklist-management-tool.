function checkitemEdit(ctl){
    var row=$(ctl).closest('tr').addClass("editing");
    var value=$(ctl).closest('tr').find('td:eq(1)').html();
    value="'"+value+"'";
    $(ctl).closest('tr').find('td:eq(1)').html("<input type='text' value="+value+">");
    $(ctl).closest('tr').find('td:eq(2)').html(
    "<button type='button' onclick='checkitemSave(this);' class='btn btn-default'>" +
    "<i class='fa fa-save fa-lg'></i>" +
    "</button>" +
    "<button type='button' onclick='checkitemDelete(this);' class='btn btn-default'>" +
    "<i class='fa fa-times-circle fa-lg'></i>" +
    "</button>");
  
  }
  
function checkitemSave(ctl){
    var row=$(ctl).closest('tr').removeClass("editing");
    var checkitem_id=$(ctl).closest('tr').find('td:eq(0)').html();  
    var value=$(ctl).closest('tr').find('td:eq(1)>input').val();
    if($.trim(value)){
  
    $(ctl).closest('tr').find('td:eq(1)').html(value);

    $(ctl).closest('tr').find('td:eq(2)').html(
          "<button type='button'  onclick='checkitemEdit(this);' class='btn btn-default'>" +
          "<i class='fa fa-pen-square fa-lg' aria-hidden='true'></i>"+
          "</button>" +
          "<button type='button' onclick='checkitemDelete(this);' class='btn btn-default'>" +
          "<i class='fa fa-times-circle fa-lg' aria-hidden='true'></i>" +
          "</button>"
          );
          var checkitemJson={};
          checkitemJson['chk_id']=chk_id;
          checkitemJson['checkitem_id']=checkitem_id;
          checkitemJson['checkitem']=value;
          console.log(checkitemJson);

          $.ajax({
            type: "POST",
            url: "db_checkitemsupdate.php",
            data:{item:checkitemJson},
            success: function(res){  
            } 
           });
  }
  else{
    alert("Enter Some Data!");
  }
}


  function newElement() {
    $('tbody').append(
   "<tr  class='rowidchange'><td>"+num_row+"</td>"+
    "<td><input type='text' id='text' value=''></td>"+
    "<td>" +
    "<button type='button'  onclick='checkitemNew(this);' class='btn btn-default'>" +
    "<i class='fa fa-plus-square fa-lg'></i>"+
    "</button>" +
    "<button type='button' onclick='checkitemDelete(this);' class='btn btn-default'>" +
    "<i class='fa fa-times-circle fa-lg'></i>" +
    "</button>" +
    "</td>"+ 
    "</tr>");
  }




  function checkitemDelete(ctl) {
      var checkitem_id=$(ctl).closest('tr').find('td:eq(0)').html();
      var checkitemJson={};
      checkitemJson['chk_id']=chk_id;
      checkitemJson['checkitem_id']=checkitem_id;
      $(ctl).closest('tr').remove();

      $.ajax({
          type: "POST",
          url: "db_checkitemsdelete.php",
          data:{item:checkitemJson},
          success: function(res){  
              console.log(res);   
      } 
     });
   }

   function checkitemNew(ctl){
    var value=$.trim($("#text").val());
    if(value){
    console.log(value);
    $(ctl).closest('tr').find('td:eq(1)').html(value);
    $(ctl).closest('tr').find('td:eq(2)').html(
          "<button type='button'  onclick='checkitemEdit(this);' class='btn btn-default'>"+
          "<i class='fa fa-pen-square fa-lg'></i>"+
          "</button>"+
          "<button type='button' onclick='checkitemDelete(this);' class='btn btn-default'>"+
          "<i class='fa fa-times-circle fa-lg'></i>" +
          "</button>" 
          );
    var checkitemJson={};
    checkitemJson['chk_id']=chk_id;
    checkitemJson['checkitem_id']=num_row;
    checkitemJson['checkitem']=value;
    $.ajax({
      type: "POST",
      url: "db_newcheckitems.php",
      data:{item:checkitemJson},
      success: function(res){  
          console.log(res);   
        }  
    });
    num_row+=1;
      }
     
  else{
    alert("Enter Some Data!");
  }
  }


  


  
