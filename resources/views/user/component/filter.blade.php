<div class="filter">
    <div class="uk-flex uk-flex-middle uk-flex-space-between">
      <div class="perpage">
          <div class="uk-flex uk-flex-middle uk-flex-space-between">
           <select name="perpagfe" class="form-control input-sm mr10">
               @for($i=20;$i<=200;$i+=20)
               <option value="{{$i}}">{{$i}} bản ghi</option>
              @endfor
           </select>
         
           
          </div>
       </div>
       <div class="action uk-flex ">
           <div class="uk-flex uk-flex-middle">
               <select name="" class="form-control">
                   <option selected="selected" value="0">Chọn nhóm thành viên</option>
                   <option value="1">Quản trị viên</option>
               </select>
           </div>
           <div class="uk-search uk-flex-middle uk-flex">
               <div class="input-group">
                   <input type="text" name="keyword" id="" placeholder="Nhập từ khóa" class="form-control">
                   <span class="input-group-btn">
                       <button class="btn btn-primary mb0 btn-sm">
                           Tìm kiếm
                       </button>
                   </span>
               </div>
           </div>
           <a href="{{route('user.create')}}" class="btn btn-danger"><i class="fa fa-plus"></i>Thêm mới thành viên</a>
       </div>
    </div>
  </div>