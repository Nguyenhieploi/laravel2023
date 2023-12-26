(function($){
    "use strict";
    var HT = {};
    var $document = $(document);

    HT.swichery = () =>{
        $('.js-switch').each(function(){ 
            var switchery = new Switchery(this, { color: '#1AB394'});
        })
    }
     
    // Sử dụng select2
    HT.select2 =() =>{
        $('.setupSelect2').select2();
    }


    $document.ready(function(){
       HT.swichery();
       HT.select2();
    });
})(jQuery);