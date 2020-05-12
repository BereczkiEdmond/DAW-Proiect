$(document).ready(function(){
    
    $opt = localStorage.getItem('option');
    $("#form_title").text($opt + " manage form");

    switch($opt)
    {
        case 'Car':
        $(".fillArea_opinion").remove();
        break;

        case 'Opinion':
        $(".fillArea_car").remove();
        break;
    }

});