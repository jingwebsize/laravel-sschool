@extends('layouts.tabcontent')

@section('content')
<div class="container">
<br/>
    <div class="row justify-content-center">
        <div class="col-md-12">
            @if($flag)
            
                <a href="{{url($fileurl)}}" target="_blank" class="btn btn-primary">结业证书下载</a>
            @else
                <h6>结业证书不存在</h6>
            @endif
        </div>
    </div>
</div>
@endsection