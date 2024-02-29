<form action="{{route('user.index')}}">
<div class="filter">
    <div class="uk-flex uk-flex-middle uk-flex-space-between">
        <div class="perpage">
            @php
                $perpage = request('perpage') ?: old('perpage');
            @endphp

            <div class="uk-flex uk-flex-middle uk-flex-space-between">
                <select name="perpage" class="form-control input-sm mr10">
                    @for ($i = 20; $i <= 200; $i += 20)
                        <option {{ ($perpage == $i) ? 'selected' : '' }} value="{{ $i }}">{{ $i }} bản ghi</option>
                    @endfor
                </select>
            </div>
        </div>
       <div class="action uk-flex ">
           <div class="uk-flex uk-flex-middle">
            @php 
                $publishArray = ['Unpublish','publish'];
                $publish = request('publish') ?: old('publish');
            @endphp

           <select name="publish" class="form-control setupSelect2">
                   <option selected="selected" value="-1">Chọn tình trạng</option>
                    @foreach($publishArray as $key => $val)
                    <option {{ ($publish == $key) ? 'selected' : '' }} value="{{$key}}">{{$val}}</option>
                    @endforeach
               </select>
               <select name="user_catalogue_id" class="form-control setupSelect2">
                   <option selected="selected" value="0">Chọn nhóm thành viên</option>
                   <option value="1">Quản trị viên</option>
               </select>
           </div>
           <div class="uk-search uk-flex-middle uk-flex">
               <div class="input-group">
                   <input type="text" name="keyword" id="" value="{{request('keyword') ?: old('keyword')}}" placeholder="Nhập từ khóa" class="form-control">
                   <span class="input-group-btn">
                       <button class="btn btn-primary mb0 btn-sm"  type="submit" name="search" value="search">
                           Tìm kiếm
                       </button>
                   </span>
               </div>
           </div>
           <a href="{{route('user.create')}}" class="btn btn-danger"><i class="fa fa-plus"></i>Thêm mới thành viên</a>
       </div>
    </div>
  </div>
</form>