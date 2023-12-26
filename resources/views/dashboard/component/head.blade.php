<base href="{{ config('app.url') }}">
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>INSPINIA | Dashboard v.2</title>

<link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
<link href="{{ asset('font-awesome/css/font-awesome.css') }}" rel="stylesheet">
@if(isset($config['css']) && is_array($config['css']))
@foreach($config['css'] as $key =>$val)
<link href="{{ asset($val) }}" rel="stylesheet" >
@endforeach
@endif
<link href="{{ asset('css/animate.css') }}" rel="stylesheet">
<link href="{{ asset('css/style.css') }}" rel="stylesheet">
<link href="{{ asset('css/custom.css') }}" rel="stylesheet">
<script src="{{ asset('js/jquery-3.1.1.min.js') }}"></script>