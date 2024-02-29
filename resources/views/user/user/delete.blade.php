@include('user.user.component.breadcrumb',['title' => $config['seo']['create']['title']])

<form action="{{route('user.destroy',$user->id)}}" class="box" method="post">
    @csrf
    @method('DELETE')
    <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">
            <div class="col-lg-5">
                <div class="panel-head">
                    <div class="panel-title">Thông tin chung</div>
                    <div class="panel-description">
                        <p>Bạn muốn xóa thành viên bằng email là: {{ $user->email }}</p>
                        <p>Lưu ý: Sau khi xóa không thể khôi phục</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-7">
                <div class="ibox">
                    <div class="ibox-title"><h5>Thông tin chung</h5></div>
                    <div class="ibox-content">
                        <div class="row mb15">
                            <div class="col-lg-6">
                                <div class="form-row">
                                    <label for="" class="control-label text-right">Email<span class="text-danger">(*)</span></label>
                                    <input readonly type="text" name="email" value="{{old('email',($user->email) ?? '' ) }}" placeholder="Nhập email" autocomplete="off">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-row">
                                    <label for="" class="control-label text-right">Họ tên<span class="text-danger">(*)</span></label>
                                    <input  readonly type="text" name="name" value="{{old('name',($user->name) ?? '')}}" placeholder="Nhập họ tên" autocomplete="off">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <hr>
     
        <div class="text-right mb15">
            <button class="btn btn-danger" type="submit" name="send" value="send">
                Xóa dữ liệu
            </button>
        </div>
    </div>
</form>
