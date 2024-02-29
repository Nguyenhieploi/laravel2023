<table class="table table-striped">
    <thead>
    <tr>
        <th>
            <input type="checkbox" value="" id="checkAll" class="input-checkbox">
        </th>
        
        <th class="text-center">Họ tên</th>
        <th class="text-center">Email</th>
        <th class="text-center">Phone</th>
        <th class="text-center">Địa chỉ</th>
        <th class="text-center">Nhóm thành viên</th>
        <th class="text-center">Tình trạng</th>
        <th class="text-center">Thao tác</th>
    </tr>
    </thead>
    <tbody>
        @if(isset($users) && is_object($users) )
            @foreach($users as $user)
    <tr>
        <td> 
            <input type="checkbox" value="{{$user->id}}" class="input-checkbox checkBoxItem">
        </td>
     
        <td>
            <div class="user-item name">{{$user->name}}</div>
        </td>
        <td>
            <div class="user-item email"> {{$user->email}}</div>
        </td>
        <td> 
           <div class="user-item phone">{{$user->phone}}</div>
        </td>
        <td>
            {{$user->address}}
        </td>
        <td>
            {{ $user->user_catalogues->name }}
        </td>
        <td class="text-center js-switch-{{$user->id}}">
            <input  type="checkbox" value="{{$user->publish}}" class="js-switch status "  data-field="publish" data-model="User" 
            {{($user->publish == 1) ? 'checked' : ''}} data-modelId="{{ $user->id }}"/>
        </td>
        <td  class="text-center"> 
            <a href="{{ route ('user.edit',$user->id) }}" class="btn-success"><i class="fa fa-edit"></i></a>
            <a href="{{route('user.delete', $user->id) }}" class="btn-danger"><i class="fa fa-trash"></i></a>
        </td>
       
    </tr>
     @endforeach
    @endif
    
    </tbody>
</table>
{{ $users->links('pagination::bootstrap-4') }}