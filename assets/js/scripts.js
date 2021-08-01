$(".dialog").dialog({
    autoOpen: false,
    resizable: true,
    autoResize: true,
    width: "auto",
    classes: {
        "ui-dialog": "ui-corner-none",
        "ui-dialog-titlebar": "ui-corner-none"
    },
    position: { 
        my: "center",
        at: "center",
        of: "body"
    }
});

$(".dialog_launcher").on("click", function() {
	data_id = $(this).attr("data-id");
	data_name = $(this).attr("data-name");
    $(".dialog[data-id='"+ data_id +"']").dialog("open").dialog('option', 'title', '' + data_name +'');
    if($("#openedModals").find(".taskbarbtn[data-id='"+ data_id +"']").length == 0){
        $('#openedModals').append('<button type="button" data-id="' + data_id + '" class="btn btn-secondary taskbarbtn">' + data_name + '</button>')
    };
});

$(".ui-dialog-titlebar-close").click(function(){
	parent = $(this).parent().parent();
	data_id = parent.find(".ui-dialog-content").attr("data-id");
	$("#openedModals").find(".taskbarbtn[data-id='"+ data_id +"']").remove();
	parent.find(".ui-dialog-content").empty();
});

$(document).on('click', '.taskbarbtn', function () {
	data_id = $(this).attr("data-id");
    $( ".dialog[data-id='"+ data_id +"']" ).dialog( "moveToTop" );
});

function showTime(){
    var date = new Date();
    var day = date.getDate();
    var month = date.getUTCMonth() + 1;
    var year = date.getFullYear();
    var h = date.getHours();
    var m = date.getMinutes();
    var s = date.getSeconds();
    var session = "AM";
    
    if(h == 0){
        h = 12;
    }
    
    if(h > 12){
        h = h - 12;
        session = "PM";
    }
    
    h = (h < 10) ? "0" + h : h;
    m = (m < 10) ? "0" + m : m;
    s = (s < 10) ? "0" + s : s;
    
    var date = day + "/" + month + "/" + year
    var time = h + ":" + m + ":" + s + " " + session;
    document.getElementById("MyClockDisplay").innerText = time;
    document.getElementById("MyDateDisplay").innerText = date;
    setTimeout(showTime, 1000);
}
showTime();

$("#hp_profile_btn").click(function(){
    $("#profile_con").load("profile.php", function(responseTxt, statusTxt, xhr){});	
});

$("#profile_btn").click(function(){
    $("#profile_con").load("profile.php", function(responseTxt, statusTxt, xhr){});	
});

$("#hp_admin_btn").click(function(){
    $("#admin_con").load("admin.php", function(responseTxt, statusTxt, xhr){});	
});

$("#admin_btn").click(function(){
    $("#admin_con").load("admin.php", function(responseTxt, statusTxt, xhr){});	
});

$("#hp_financefolder_btn").click(function(){
    $("#financefolder_con").load("finance_folder.php", function(responseTxt, statusTxt, xhr){});	
});

$("#financefolder_btn").click(function(){
    $("#financefolder_con").load("finance_folder.php", function(responseTxt, statusTxt, xhr){});	
});

$(document).bind('keydown', function(e) {
    if(e.which === 116) {
       r = confirm("Are you sure you want to refresh?")
       if(r == true) {
        location.reload();
       }
       return false;
    }
    if(e.which === 82 && e.ctrlKey) {
        confirm("Are you sure you want to refresh?")
        if(r == true) {
            location.reload();
        }
       return false;
    }
});