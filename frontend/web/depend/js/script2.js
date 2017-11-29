$(document).ready(function() {
        //  $('[id^="details"]').click(function() {
        $(".pjax").on("click",".buttonDetails",function() {
            var ico = $(this).find('i')
            if (ico.hasClass("fa fa-angle-up")) {
                $(ico).removeClass().addClass("fa fa-angle-down")
            } else {
                $(ico).removeClass().addClass("fa fa-angle-up")
            }
        }) ;

    $(".pjax").on("click",".page-link",function() {
         var url=location.href;
         var reg=/(.+)\d+&/;
         var  str=reg.exec(url);
        location.href=str[1]+$(this).text();
        })
    });


$(document).ready(function() {
    $(document).on('click', 'a.btn-primary', function () {
        if ($(this).data('type') == 'action') {
            window.open("goto/" +  $(this).data('id'));
        }
        if ($(this).data('type') == 'promocode') {
           var url = location.href;
            if (url.indexOf("page")==-1){
                url=url+'?page=1';
                 window.open(url +'&idc='+$(this).data('id'));

             }
            var reg=/.+&/ig;
            var  url_reg=reg.exec(url);
             if(url_reg!=null){
                 window.open(url_reg +'idc='+$(this).data('id'));
             }else{
                 var reg=/#$/ig;
                 var  url_reg=url.replace(reg,"");
                 window.open(url_reg +'&idc='+$(this).data('id'));

             }
            window.location.href = "goto/" + $(this).data('id');
        }
    });

});

function copy(element) {
 /* var $temp = $("<input>");
    $("body").append($temp);
    console.log(  $temp.val($(element).attr('value')));
    document.execCommand("copy");
    $temp.remove();*/

 $('#promocode').attr('value');
    document.execCommand("copy");
}
