var gkey;
switch(gkey){
    case 1: $(".dashboard-banner").addClass("morning-bg");
            break;
    case 2: $(".dashboard-banner").addClass("afternoon-bg");
            console.log("afternoon");
            break;
    case 3: $(".dashboard-banner").addClass("evening-bg");
            break;
}

function adminFunction(){
    $(".nav").removeClass("admin-section");
}

function userFunction(){
    $(".nav").removeClass("user-section");
}

function approverFunction(){
    $(".nav").removeClass("approver-section");
}

function userapproverFunction(){
    $(".nav").removeClass("user-section");
    $(".nav").removeClass("approver-section");
}

var activeSection = $("title").html();
if(activeSection=="Checklist-Creation" || activeSection=="Checkitems"){
    activeSection = "Checklists";
}

if(activeSection=="Create-User"){
    activeSection = "Users";
}

if(activeSection=="Assignment-Creation"){
    activeSection = "Assign-Checklists";
}

$("#"+activeSection).addClass("active-section");
