$(document).ready(function(){
    // switch du logo pour faire apparaitre l'icone home quand on hover
    $(".logo_hide").hide();

    $(".logo").mouseenter(function() {
        $(".logo").hide();
        $(".logo_hide").show();
    });

    $(".logo_hide").mouseleave(function () {
        $(".logo").show();
        $(".logo_hide").hide();
    });
    // switch du logo pour faire apparaitre l'icone home quand on hover

    // Apparition du menu navbar en small screen en cliquant sur le menu burger
    $(".sidebar").hide();
    $(".filter").hide();
    $(".sidebarClick").click(function(){
        $(".sidebar").animate({width:'toggle'},350);
        $(".filter").toggle();
    });

    $('.filter').click(function(){
        $('.filter').hide();
        $(".sidebar").animate({width:'toggle'},350);
    });
    // Apparition du menu navbar en small screen en cliquant sur le menu burger

    // Apparition des notifications en cliquant sur la cloche

    $(".notificationDiv2").hide();

    $(document).mouseup(function (e) {

        $(".dropdownNotifications2").click(function(){
            $(".notificationDiv2").toggle();
        });

        if (!$('.notificationDiv2').is(e.target) // if the target of the click isn't the container...
            && $('.notificationDiv2').has(e.target).length === 0) // ... nor a descendant of the container
        {
            $('.notificationDiv2').hide();
        }
    });

    $(".notificationDiv").hide();
    $(document).mouseup(function (e) {
        $(".dropdownNotifications").click(function(){
            $(".notificationDiv").toggle();
        });
        if (!$('.notificationDiv').is(e.target) // if the target of the click isn't the container...
            && $('.notificationDiv').has(e.target).length === 0) // ... nor a descendant of the container
        {
            $('.notificationDiv').hide();
        }
    });



    // Apparition des notifications en cliquant sur la cloche


    // Autocompletion de la recherche des villes

    // function keyCode() {
    //     
    //     var element = document.getElementById("results"); 
    //     
      
    // }; 


   


    // Autocompletion de la recherche des villes
});
