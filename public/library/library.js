(function($){
    "use strict";
    var HT = {};
    var _token = $('meta[name="csrf-token"]').attr('content')

    HT.swichery = () =>{
        $('.js-switch').each(function(){ 
            var switchery = new Switchery(this, { color: '#1AB394'});
        })
    }
     
    // Sử dụng select2
    HT.select2 =() =>{
        if($('.setupSelect2').length){
            $('.setupSelect2').select2(); 
        }
       
    }

    HT.changeStatus = () =>{
        $(document).on('change','.status',function(e){
            var _this = $(this)
            var option = {
                'value': _this.val(),
                'modelId':_this.attr('data-modelId'),
                'model': _this.attr('data-model'),
                'field':_this.attr('data-field'),
                '_token': _token
            }

            $.ajax({
                url: 'ajax/dashboard/changeStatus', // URL xử lý dữ liệu
                type: 'POST',
                data: option,
                dataType: 'json', // Kiểu dữ liệu trả về trên máy chủ 
                success: function(res) {
                 console.log(res);
                },
                error: function(error) {
                    // Xử lý lỗi ở đây
                    console.log(error);
                }
            });
        
        
            e.preventDefault();
        })
    }


    HT.checkAll = () =>{
        if($('#checkAll').length){
            $(document).on('click','#checkAll', function(){
                let checkAllState = $(this).prop('checked')
                $('.checkBoxItem').prop('checked', checkAllState);
                e.preventDefault();
            })
        }
    }

    HT.changeStatusAll = () =>{
        if($('.changeStatusAll').length){
           $(document).on('click','.changeStatusAll',function(e){
            var _this = $(this)
            var id = [];
            $('.checkBoxItem').each(function(){
                let checkBox = $(this);
                if(checkBox.prop('checked')){
                    id.push(checkBox.val())
                }
            })
            var option = {
                'value': _this.attr('data-value'),
                'model': _this.attr('data-model'),
                'field':_this.attr('data-field'),
                'id': id,
                '_token': _token
            }
            
            $.ajax({
                url: 'ajax/dashboard/changeStatusAll', // URL xử lý dữ liệu
                type: 'POST',
                data: option,
                dataType: 'json', // Kiểu dữ liệu trả về trên máy chủ 
                success: function(res) {
                 if(res.flag == true){
                    
                    var cssActive1 = 'background-color: rgb(26, 179, 148); border-color: rgb(26, 179, 148); box-shadow: rgb(26, 179, 148) 0px 0px 0px 16px inset; transition: border 0.4s ease 0s, box-shadow 0.4s ease 0s, background-color 1.2s ease 0s;'
                    var cssActive2 = 'left: 20px; background-color: rgb(255, 255, 255); transition: background-color 0.4s ease 0s, left 0.2s ease 0s;'
                    let cssUnActive = 'background-color: rgb(255, 255, 255); border-color: rgb(223, 223, 223); box-shadow: rgb(223, 223, 223) 0px 0px 0px 0px inset; transition: border 0.4s ease 0s, box-shadow 0.4s ease 0s;'
                    var cssUnActive2 = 'left: 0px; transition: background-color 0.4s ease 0s, left 0.2s ease 0s;'

                    for(let i = 0; i< id.length;i++){
                        if(option.value == 1){
                            $('.js-switch-'+id[i]).find('span.switchery').attr('style',cssActive1).find('small').attr('style',cssActive2)
                        }else if(option.value == 0)
                        $('.js-switch-'+id[i]).find('span.switchery').attr('style',cssUnActive).find('small').attr('style',cssUnActive2)
                    }
                 }
                },
                error: function(error) {
                    // Xử lý lỗi ở đây
                    console.log(error);
                }
            });
        
            e.preventDefault();
           })
        }
    }


    $(document).ready(function(){
       HT.swichery();
       HT.select2();
       HT.changeStatus();
       HT.checkAll();
       HT.changeStatusAll()
    });
})(jQuery);