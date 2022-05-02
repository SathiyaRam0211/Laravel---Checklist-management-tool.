function displayTable(){ 
  var rowCount = $('table tr').length;
  if(rowCount < 2){
    $("#checks").css("display", "none");
  }else{
    $("#checks").css("display", "");
  }
}

displayTable();

var checkitem=[];
$(function(){
        $("#create").click(function() {
          if($("tr").hasClass("editing")){
            event.preventDefault();
            alert("Save changes");
          }
          else{
          
        rowCount = $('table tr').length;
        var id=$("#id").val();
        var checklist_name=$("#checklist_name").val();
        var purpose=$("#purpose").val();
        var username=session_name;
        if(checklist_name=="" || purpose=="" ){
          alert("Missing items");
           event.preventDefault();
       }
       else{
        if(rowCount<2){
            alert("Enter Check Items");
             $("#myInput1").focus();    
        }
        else{
            var checklistJson={};
            checklistJson['checklist_name']=checklist_name;
            checklistJson['purpose']=purpose;
            checklistJson['created_by']=username;
            console.log(checklistJson);
          
            checkitemJson=[]
            console.log()
      
            $( "tbody tr" ).each(function(i) {
              i=i+1;
              var items={}
              items['checklist_id']=id;
              items['checkitem_id']=$('tr:eq('+i+') td:eq(0)').html();
              items['checkitem']=$('tr:eq('+i+') td:eq(1)').html();

              checkitemJson.push(items);
            });
               
            console.log((checkitemJson));
            $.ajax({
                    type: "POST",
                    url: "Checklist-Insert.php",
                    data:{item:checklistJson},
                    success: function(res){  
                
                } 
              });
              $.ajax({
                type: "POST",
                url: "Checkitem-Insert.php",
                data:{checkitem:checkitemJson},
                success: function(res){  
                  alert("Success: Checklist Created!");
                  window.location.replace("../Checklists.php");
                } 
               });
        }
      }
      }
    });
  });

  $('#myInput1').keypress(function (e) {
    var key = e.which;
    if(key == 13)  // the enter key code
     {
       newElement();
     }
   });   

function newElement() {
  if($.trim($("#myInput1").val())){
  if ($("#checks").length == 0) {
      $("#checks").append("<tbody></tbody>");
  }
  var i = $('#checks tr').length;
  $("#checks tbody").append("<tr>" +
  "<td>"+(i)+"</td>" +
  "<td>" + $("#myInput1").val() + "</td>" +
  "<td>" +
        "<button type='button'  onclick='checkitemEdit(this);' class='btn btn-default'>" +
        "<i class='fa fa-pen-square fa-lg' aria-hidden='true'></i>"+
        "</button>" +
        "<button type='button' onclick='checkitemDelete(this);' class='btn btn-default'>" +
        "<i class='fa fa-times-circle fa-lg' aria-hidden='true'></i>" +
        "</button>" +
        "</td>" +
  "</tr>");
  $("#myInput1").val("");
  displayTable();
}
else{
  alert("Enter Some Data!")
}
}

function checkitemDelete(ctl) {
  $(ctl).parents("tr").remove();
  var row = $('#checks tr').length;
  if(row>1){
    var i
    $( "tbody tr" ).each(function(i) {
      var rowid=i+1;
      $(this).find("td:first").text(rowid);
    });
  }
  displayTable();
}

function checkitemEdit(ctl){
  var row=$(ctl).closest('tr').addClass("editing");
  var value=$(ctl).closest('tr').find('td:eq(1)').html();
  value="'"+value+"'";
  $(ctl).closest('tr').find('td:eq(1)').html("<input type='text' class='form-control' value="+value+">");
  $(ctl).closest('tr').find('td:eq(2)').html(
  "<button type='button' onclick='checkitemSave(this);' class='btn btn-default'>" +
  "<i class='fad fa-save fa-lg' aria-hidden='true'></i>" +
  "</button>" +
  "<button type='button' onclick='checkitemDelete(this);' class='btn btn-default'>" +
  "<i class='fa fa-times-circle fa-lg' aria-hidden='true'></i>" +
  "</button>");

}


function checkitemSave(ctl){
  var row=$(ctl).closest('tr').removeClass("editing");
  var value=$(ctl).closest('tr').find('td:eq(1)>input').val();
  $(ctl).closest('tr').find('td:eq(1)').html(value);
  $(ctl).closest('tr').find('td:eq(2)').html(
        "<button type='button'  onclick='checkitemEdit(this);' class='btn btn-default'>" +
        "<i class='fa fa-pencil-square fa-lg' aria-hidden='true'></i>"+
        "</button>" +
        "<button type='button' onclick='checkitemDelete(this);' class='btn btn-default'>" +
        "<i class='fa fa-times-circle fa-lg' aria-hidden='true'></i>" +
        "</button>"
        );
}