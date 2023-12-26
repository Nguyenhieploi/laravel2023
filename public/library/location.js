// Xử lý sự kiện click vào tỉnh thành thì hiện quận huyện
(function($){
    "use strict";
    var HT = {};
    var $document = $(document);

    HT.getLocation =  ()=>{
        $(document).on('change','.location',function(){
            let _this = $(this)
            let option = {
                'data' : {
                    'location_id': _this.val()
                },
                'target' : _this.attr('data-target')
            }
            HT.sendDataTogetLocation(option)
        
        })
    }
    
    

    
    HT.sendDataTogetLocation =  (option)=>{
            $.ajax({
                url: 'ajax/location/getLocation', // URL xử lý dữ liệu
                type: 'GET',
                data: option,
                dataType: 'json', // Kiểu dữ liệu trả về trên máy chủ 
                success: function(res) {
                   $('.'+option.target).html(res.html);
                   if(district_id != '' &&  option.target == 'districts'){
                    $(".districts").val(district_id).trigger('change')
                    
                }
                if(ward_id != '' &&  option.target == 'wards'){
                    $(".wards").val(ward_id).trigger('change')
                    
                }
                },
                error: function(error) {
                    // Xử lý lỗi ở đây
                    console.log(error);
                }
            });
        
    }

    HT.loadCity = () =>{
        if(province_id != ''){
            $(".province").val(province_id).trigger('change');
        }
    }

    $document.ready(function(){
        HT.getLocation();
        HT.loadCity();
    });
})(jQuery);