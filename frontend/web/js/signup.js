$(document).ready(function(){
    $(".second_el").mouseenter(function(){
        $(".first_el").css("background-color", "#fff");
        $(".second_el").css("background-color", "#AA615C");
    }).mouseleave(function(){
        $(".first_el").css("background-color", "#AA615C");
        $(".second_el").css("background-color", "#fff");
    });
});
