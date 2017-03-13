
$(".drop-header").click(function(){
    var id=$(this).data("target");
    $("#"+id).toggle();
});

$(".error-msg-close").click(function(){
    $(this).parent().hide();
});
