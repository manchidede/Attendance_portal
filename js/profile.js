$(document).ready(function(){
    //timer
    var monthNames = [ "January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December" ]; 
var dayNames= ["Sunday","Monday","Tuesday","Wednesday","Thursday","Friday","Saturday"]
var newDate = new Date();
// make current time
newDate.setDate(newDate.getDate());
$('#Date').html(dayNames[newDate.getDay()] + " " + newDate.getDate() + ' ' + monthNames[newDate.getMonth()] + ' ' + newDate.getFullYear() + '.');

//Timer proper
setInterval( function() {
    // Create a newDate() object and extract the seconds of the current time on the visitor's
    var seconds = new Date().getSeconds();
    // Add a leading zero to seconds value
    $("#sec").html(( seconds < 10 ? "0" : "" ) + seconds);
    },1000);
    
    setInterval( function() {
    // Create a newDate() object and extract the minutes of the current time on the visitor's
    var minutes = new Date().getMinutes();
    // Add a leading zero to the minutes value
    $("#min").html(( minutes < 10 ? "0" : "" ) + minutes);
    },1000);
    
    setInterval( function() {
    // Create a newDate() object and extract the hours of the current time on the visitor's
    var hours = new Date().getHours();
    hours = hours % 12;
    // Add a leading zero to the hours value
    $("#hrs").html(( hours < 10 ? "0" : "" ) + hours);
    //AM and PM SET
    var ampm = hours >= 12 ? 'PM' : 'AM';
    $("#ampm").html(ampm);
    }, 1000); 


//     var now = new Date(Date.now());
// var formatted = now.getHours() + ":" + now.getMinutes() + ":" + now.getSeconds();
//     alert(formatted);
    //for history
    $(".history, .historyclose").click(function () {
        $(".popup").toggle();
        $(".popuphistory").show();
        $(".popupprofile").hide();

        $.ajax({
            method:"post",
            dataType: "json",
            url:"attendacefetch.php",
            success: function(data){
                var datalen = Object.keys(data).length;
                for(var i=0;i<datalen;i++){
                    $('.appendtable').html($('<tr>'));
                $('<th scope="row">'+(i+1)+'</th>').appendTo(".appendtable");
                $('<td>'+data[i]["date"]+'</td>').appendTo(".appendtable");
                $('<td>'+data[i]["timein"]+'</td>').appendTo(".appendtable");
                $('<td>'+data[i]["timeout"]+'</td>').appendTo(".appendtable");
                }
                //append with attribute
                // $('<th scope="row">1</th>').attr({
                //     name: 'test'
                // }).appendTo(".appendtable");

                
        
            },
            error: function(e){
                console.log(e);
            }
        });

    });

    //for profile
    $(".profile, .profileclose").click(function () {
        $(".popup").toggle();
        $(".popupprofile").show();
        $(".popuphistory").hide();
    });


    //logout
    $('.logout').click(function() {
    $.ajax({
        method:"post",
        url:"logout.php",
        success: function(response){
            window.location.replace("index.php");
        }
    }); 
       
           });

    //Checkin
    $('#customCheck1').change(function () {
        if($("#customCheck1").prop('checked') == true){
            $("#customCheck1").attr("disabled", true);
            $("#customCheckDisabled").removeAttr("disabled");
            var datavar = {checkin: "checked"};
            $.ajax({
                method:"POST",
                data: datavar,
                url:"checkbox.php",
                success: function(response){
                    // window.location.replace("index.php");
                    // alert(response);
                },
                error: function(e){
                    // alert(e);
                }
            }); 
        }
     });

     //Checkout
    $('#customCheckDisabled').change(function () {
        if($("#customCheckDisabled").prop('checked') == true){
            $("#customCheckDisabled").attr("disabled", true);
            var checkout = {checkout: "checked"}
            $.ajax({
                method:"POST",
                data: checkout,
                url:"checkbox.php",
                success: function(response){
                    // window.location.replace("index.php");
                    // alert(response);
                },
                error: function(e){
                    console.log(e);
                }
            }); 
        }
     });

});