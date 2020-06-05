@extends('layouts.app')
@section('content')
<div class="container">
    <ul class="nav nav-tabs">
        <li class="nav-item">
            <a class="nav-link active" href="{{route('home')}}">Home</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{route('profile')}}">Profile</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{route('courses')}}">Courses</a>
        </li>
    </ul>
<br/>
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Information</div>
                <div class="card-body">
                    <!-- @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    You are logged in! -->
                    <form method="POST" action="home/{{$profile->id}}">
                    @csrf
                        <div class="form-group row">
                            <label for="name" class="col-sm-2 col-form-label">Name</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="name" id="name" value="{{ $profile->name}}" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="school" class="col-sm-2 col-form-label">Anstitute</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="school" id="school" value="{{ $profile->school}}" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="sex" class="col-sm-2 col-form-label">Gender</label>
                            <div class="col-sm-10">
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="sex" id="inlineRadio1" value="1">
                                    <label class="form-check-label" for="inlineRadio1">Male</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="radio" name="sex" id="inlineRadio2" value="2">
                                    <label class="form-check-label" for="inlineRadio2">Female</label>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="birth" class="col-sm-2 col-form-label">Birthday</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="birth" id="birth" value="{{ $profile->birth}}" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="tel" class="col-sm-2 col-form-label">Telephone</label>
                            <div class="col-sm-10">
                            <input type="text" class="form-control" name="tel" id="tel" value="{{ $profile->tel}}" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="email" class="col-sm-2 col-form-label">Email</label>
                            <div class="col-sm-10">
                            <input type="text" class="form-control" name="email" id="email" value="{{ $profile->email}}" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="tutor" class="col-sm-2 col-form-label">Supervisor</label>
                            <div class="col-sm-10">
                            <input type="text" class="form-control" name="tutor" id="tutor" value="{{ $profile->tutor}}" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="major" class="col-sm-2 col-form-label">Major</label>
                            <div class="col-sm-10">
                            <input type="text" class="form-control" name="major" id="major" value="{{ $profile->major}}" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="grade" class="col-sm-2 col-form-label">Grade</label>
                            <div class="col-sm-10">
                                <select class="custom-select d-block w-100" id="grade" name="grade" required>
                                    <option value="0">Choose...</option>
                                    <option value="1">First</option>
                                    <option value="2">Second</option>
                                    <option value="3">Third</option>
                                    <option value="4">Forth and above</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="type" class="col-sm-2 col-form-label">Identity</label>
                            <div class="col-sm-10">
                                <select class="custom-select d-block w-100" id="type" name="type" required>
                                    <option value="0">Choose...</option>
                                    <option value="1">Master</option>
                                    <option value="2">Master-Doctor</option>
                                    <option value="3">Doctor</option>
                                    <option value="4">Post-doctor</option>
                                    <option value="5">Researcher</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="reason" class="col-form-label">Why do you join this summer shcool? (500 words limited)</label>
                            <textarea name="reason" id="reason" class="form-control" rows="3">{{$profile->reason}}</textarea>
                        </div>
                        <div class="form-group">
                            <label for="file">Recommendation</label>
                            <input id="refile" type="file" class="form-control" name="refile">
                            <input id="reurl" type="text" name="file" value="{{$profile->file}}" hidden>    
                        </div> 
                        <br/>
                        <div class="form-group row">
                            <div class="col-md-5">
                            <button type="submit" class="btn btn-primary btn-block">{{$profile->button}}</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        
    </div>
</div>

<script src="{{asset('bootstrap-datetimepicker-master/js/bootstrap-datetimepicker.min.js')}}"></script>
<script>
    $('#grade').val("{{$profile->grade}}");
    $('#type').val("{{$profile->type}}");
    $(function(){
        var sexval = "{{$profile->sex}}";
        if (sexval ==1) $('#inlineRadio1').prop("checked",true);
        else if (sexval ==2) $('#inlineRadio2').prop("checked",true);
    })
    $('#birth').datetimepicker({
        forceParse: 0,//设置为0，时间不会跳转1899，会显示当前时间。
        // language: 'zh-CN',//显示中文
        format: 'yyyy-mm-dd',//显示格式
        minView: "month",//设置只显示到月份
        initialDate: new Date(),//初始化当前日期
        autoclose: true,//选中自动关闭
        todayBtn: true//显示今日按钮
    });
    var reurl = "{{ $profile->file? asset('userletter/'.$profile->file):null }}";
    $("#refile").fileinput({
        initialPreview: reurl,
        initialPreviewAsData: true,
        // language:'zh',                                          // 多语言设置，需要引入local中相应的js，例如locales/zh.js
        // theme: "explorer-fa",                                // 主题
        uploadUrl: "profile/upload",         // 上传地址
        uploadAsync: false, //默认异步上传
        maxFileCount: 1,                                        // 最大上传数量
        autoOrientImage:false,
        allowedFileExtensions : ['jpg', 'png','gif','jpeg','pdf','doc','docx'],//允许的文件类型
        enctype:'multipart/form-data',
        // showPreview: true,                                   //是否显示预览
        showRemove: true,                                       // 显示移除按钮
        showCancel: false,
        showUpload: false,
        previewClass:"uploadfilePreview",
        dropZoneEnabled: false,
        uploadExtraData: {'filename':'refile','filetype':'userletter','_token':"{{ csrf_token() }}"},   // 上传数据
        layoutTemplates:{
            actionDelete:'', 
            actionUpload:'',
            actionZoom:''   
        },
    }).on("filecleared", function() {
        $("#reurl").val('');
    }).on("change", function() {               
        // 清除掉上次上传的图片
        $(".uploadfilePreview").find(".file-preview-frame:first").remove();
		$(".uploadfilePreview").find(".kv-zoom-cache:first").remove();
    }).on("filebatchselected", function(e, files) {        
        $(this).fileinput("upload");             // 文件选择完直接调用上传方法。
    }).on("filebatchuploadsuccess", function(event, data) { // 上传成功回调
        // alert("Upload Success!");
        // console.log(data);
        // console.log(event);
        $("#reurl").val(data.response.filename);
    }).on('fileerror', function(event, data, msg) {
        alert("Upload Error "+msg);
    });
</script>
@endsection