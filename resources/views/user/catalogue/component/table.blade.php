<table class="table table-striped">
    <thead>
    <tr>
        <th>
            <input type="checkbox" value="" id="checkAll" class="input-checkbox">
        </th>
        
        <th class="text-center">Tên nhóm</th>
        <th class="text-center">Số thành viên</th>
        <th class="text-center">Mô tả</th>
        <th class="text-center">Tình trạng</th>
        <th class="text-center">Thao tác</th>
    </tr>
    </thead>
    <tbody>
        @if(isset($userCatalogues) && is_object($userCatalogues) )
            @foreach($userCatalogues as $userCatalogue)
    <tr>
        <td> 
            <input type="checkbox" value="{{$userCatalogue->id}}" class="input-checkbox checkBoxItem">
        </td>
     
        <td>
            <div class="user-item name">{{$userCatalogue->name}}</div>
        </td>
        <td>
            <div class="user-item name">{{ $userCatalogue->users_count }} Người</div>
        </td>
        <td>
            <div class="user-item name">{{$userCatalogue->description}}</div>
        </td>
        <td class="text-center js-switch-{{$userCatalogue->id}}">
            <input  type="checkbox" value="{{$userCatalogue->publish}}" class="js-switch status "  data-field="publish" data-model="UserCatalogue" 
            {{($userCatalogue->publish == 1) ? 'checked' : ''}} data-modelId="{{ $userCatalogue->id }}"/>
        </td>
        <td  class="text-center"> 
            <a href="{{ route ('user.catalogue.edit',$userCatalogue->id) }}" class="btn-success"><i class="fa fa-edit"></i></a>
            <a href="{{route('user.catalogue.delete', $userCatalogue->id) }}" class="btn-danger"><i class="fa fa-trash"></i></a>
        </td>
       
    </tr>
     @endforeach
    @endif
    
    </tbody>
</table>
{{ $userCatalogues->links('pagination::bootstrap-4') }}