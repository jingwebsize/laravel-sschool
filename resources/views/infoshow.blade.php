@extends('layouts.tabcontent')

@section('content')
<div class="container">
<br/>
    <div class="row justify-content-center">
        <div class="col-md-12">
            @if(Auth::user()->zan()->exists())
            <h6>已完成投票。</h6>
            @else
            <form method="POST" action="profileshow">
            @csrf
            <div class="row row-cols-1 row-cols-sm-2 row-cols-md-4">
            @if($posters->isEmpty())
                <p>请等待开放。</P>
            @else
                @foreach($posters as $poster)           
                @if($poster->file)                       
                <div class="col">
                    <div class="card">
                        <div class="card-body">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="{{$poster->id}}" name="zans[]" id="{{'defaultCheck'.$poster->id}}">
                                <label class="form-check-label" for="{{'defaultCheck'.$poster->id}}">
                                    <h5 class="card-title">{{$poster->user->profile->addr}} {{$poster->user->name}}</h5>
                                </label>
                            </div>
                            <a href="{{url('userfile/'.$poster->file)}}" target="_blank" class="btn btn-primary">打开预览</a>
                        </div>
                    </div>
                </div>
                @endif
                @endforeach
                </div>
                <br/>
                <br/>
                <div>
                    <button type="submit" class="btn btn-primary" onclick="javascript:return confirm('提交后不可更改，确定提交吗?');">确认提交</button>（最多选择两个）
                </div>
                </form>
            @endif
            @endif
        </div>
    </div>
</div>
<script>
    $(document).ready(function (){
        $('input[type=checkbox]').click(function(){
            if ($("input[name='zans[]']:checked").length > 2) {
                alert('最多选2个');
                $(this).prop('checked',false);
                // console.log(this)
            }
        });
    });
</script>
@endsection