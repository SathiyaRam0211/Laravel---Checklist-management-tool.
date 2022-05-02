$("#all-radio").click(function(){
    $("tbody tr").show();
});

$("#inprogress-radio").click(function(){
   $("tbody tr").show();
   $('tbody tr').each(function(){
    if ($(this).find('td:eq(0)').html() == "Submitted") {  
   }
    else{
        $(this).hide();
   }
   });
});

$("#approved-radio").click(function(){
    $("tbody tr").show();
    $('tbody tr').each(function(){
        if ($(this).find('td:eq(0)').html() == "Approved") {  
       }
        else{
            $(this).hide();
       }
       });
});

$("#rejected-radio").click(function(){
    $("tbody tr").show();
    $('tbody tr').each(function(){
        if ($(this).find('td:eq(0)').html() == "Rejected") {  
       }
        else{
            $(this).hide();
       }
       });
});