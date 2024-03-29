
@include('user.catalogue.component.breadcrumb',['title' => $config['seo']['index']['title']])
<div class="row">
<div class="col-lg-12">
    <div class="ibox float-e-margins">
        <div class="ibox-title">
            <h5>{{$config['seo']['index']['table'];}}</h5>
            @include('user.catalogue.component.toolbox')
        </div>
        <div class="ibox-content">
            @include('user.catalogue.component.filter')
            @include('user.catalogue.component.table')
        </div>
    </div>
</div>
</div>
