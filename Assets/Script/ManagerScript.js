$(document).ready(function(){
    
    $opt = localStorage.getItem('option');
    $("#form_title").text($opt + " manage form");
    $(".selection_table").hide();
    $('label[for="remove_id"]').hide();
    $("#remove_id").hide();

    switch($opt)
    {
        case 'Car':
        $(".fillArea_opinion").remove();
        break;

        case 'Opinion':
        $(".fillArea_car").remove();
        break;
    }

    $opt = $opt.toLowerCase();

    $("#add").click(function(){
        $("#st_"+$opt).hide();
        $(".fillArea_"+$opt).show();
        $('label[for="remove_id"]').hide();
        $("#remove_id").hide();

        $("#remove_id").prop('required',false);
    });

    $("#remove").click(function(){
        $("#st_"+$opt).show();
        $(".fillArea_"+$opt).hide();
        $('label[for="remove_id"]').show();
        $("#remove_id").show();

        $("#remove_id").prop('required',true);
    });
});