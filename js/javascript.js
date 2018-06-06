// var header = document.getElementById("myDIV");
// var btns = header.getElementsByClassName("btn");
// for (var i = 0; i < btns.length; i++) {
//   btns[i].addEventListener("click", function() {
//     var current = document.getElementsByClassName("active");
//     current[0].className = current[0].className.replace(" active", "");
//     this.className += " active";
//   });
// }

$(document).ready(function(){
    // var header = document.getElementById("navlogreg");
    // var btns = header.getElementsByClassName("navlog");
    // for (var i = 0; i < btns.length; i++) {
    //   btns[i].addEventListener("click", function() {
    //     var current = document.getElementsByClassName("active");
    //     current[0].className = current[0].className.replace(" active", "");
    //     this.className += " active";
    //     // if(this.hasClass("login")==true){
    //     //     console.log("Login clicked");
    //     // }
    //     if (this.classList.contains('login')) {
    //         console.log("Login clicked");
    //     }
    //   });
    // }  
    $(".navlog").click(function () {
        $(this).addClass("active");
        // $(this).css('display', 'block');
        $(".navlog").not(this).removeClass("active");
        // $(".navlog").not(this).css('display', 'none');
        if($(this).hasClass("reg")){
            $(".register").css('display', 'block');
            $(".login").css('display', 'none');
                }else{
                    $(".register").css('display', 'none');
                    $(".login").css('display', 'block');
                }
    });

});