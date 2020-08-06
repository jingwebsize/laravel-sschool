@extends('layouts.tabcontent')

@section('content')
<div class="container">
<br/>
    @if($poster->flag==1) 
    <h6>完成提交，请等待审核。</h6>
    @elseif ($poster->flag==2) 
    <h6>审核通过。</h6>
    @else
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <!-- <div class="card-header">Supplementary Information</div> -->
                <div class="card-header">提交信息</div>
                <form method="POST" action="postersubmit">
                    @csrf
                <div class="col-md-10">
                    <br/>
                    <div class="form-group">
                        <label for="title">墙报题目</label>
                        <input id="title" class="form-control" type="text" name="title" value="{{$poster->title}}">    
                    </div> 
                </div>
                <br/>
                <div class="col-md-10">
                    <div class="form-group">
                        <label for="file">墙报图（<10M jpg/png/gif/jpeg)</label>
                        <input id="imgfile" type="file" class="form-control" name="imgfile">
                        <input id="imgurl" type="text" name="imgurl" value="{{$poster->imgurl}}" hidden>    
                    </div> 
                </div>
                <br/>
                <div class="col-md-4 btn-group" data-toggle="buttons" id="option">
                    <label class="btn btn-secondary active">
                        <input type="radio" name="isvideo" id="option1" autocomplete="off" value="0" {{$poster->isvideo? '':'checked'}} /> 音频
                    </label>
                    <label class="btn btn-secondary">
                        <input type="radio" name="isvideo" id="option2" autocomplete="off" value="1" {{$poster->isvideo? 'checked':''}} /> 视频
                    </label>
                </div>
                <br/>
                <br/>
                <div class="col-md-10" id="audio" hidden = "hidden">
                    <div class="form-group">
                        <label for="file">音频解说文件（<7M mp3/m4a)</label>
                        <input id="aufile" type="file" class="form-control" name="aufile">
                        <input id="audiourl" type="text" name="audiourl" value="{{$poster->audiourl}}" hidden>    
                    </div> 
                </div>
                
                <div class="col-md-10" id="video" hidden = "hidden">
                    <div class="form-group">
                        <label for="videourl">视频链接代码 (<a href="{{url('userimg/video_upload.png')}}" target="_blank">视频链接说明</a>)</label>
                        <textarea id="videourl" class="form-control" name="videourl" rows="3">{{$poster->videourl}}</textarea>
                        
                        
                        <!-- <input id="videourl" class="form-control" type="text" name="videourl" value="{{$poster->videourl}}">  -->
                    </div>               
                </div>
                <br/> 
                <br/> 
                <!-- <div class="row justify-content-md-center"> -->
                    <div class="col-md-5">
                        <button type="submit" class="btn btn-primary btn-block" onclick="javascript:return confirm('提交后不可修改，确定提交吗?');">提交</button>
                    </div>
                <!-- </div> -->
                <br/>        
                </form>
            </div>
        </div>
    </div>
</div>
<!-- <script src="https://kit.fontawesome.com/be20376ea9.js" crossorigin="anonymous"></script> -->
<script>
// $(function(){
    $(function(){
        if($("#option1").is(':checked'))
            $("#audio").removeAttr("hidden");
        if ($("#option2").is(':checked'))
            $("#video").removeAttr("hidden");
    });
    $("#option").click(function(){
        if($("#option1").is(':checked')){
            $("#audio").removeAttr("hidden");
            $("#video").attr("hidden","hidden");
        }
        if ($("#option2").is(':checked')){
            $("#video").removeAttr("hidden");
            $("#audio").attr("hidden","hidden");
        }
    });
    // 上传附件
    var imgurl = "{{ $poster->imgurl? asset('userimg/'.$poster->imgurl):null }}";
    var audiourl = "{{ $poster->audiourl? asset('userimg/'.$poster->audiourl):null }}";
    $("#imgfile").fileinput({
        language: 'zh',
        initialPreview: imgurl,
        initialPreviewAsData: true,
        initialPreviewConfig: [
            {caption:"{{$poster->imgurl}}", }
        ],
        initialPreviewFileType: "image",
        // previewFileIcon: "<i class='fas fa-file-image'></i>",
        // language:'zh',                                          // 多语言设置，需要引入local中相应的js，例如locales/zh.js
        // theme: "explorer-fa",                                // 主题
        uploadUrl: "profile/upload",         // 上传地址
        uploadAsync: false, //默认异步上传
        maxFileCount: 1,                                        // 最大上传数量
        maxFileSize : 10240, 
        autoOrientImage:false,
        allowedFileExtensions : ['jpg', 'png','gif','jpeg'],//允许的文件类型
        enctype:'multipart/form-data',
        // showPreview: true,                                   //是否显示预览
        showRemove: true,                                       // 显示移除按钮
        showCancel: false,
        showUpload: false,
        previewClass:"uploadPreview1",
        dropZoneEnabled: false,
        uploadExtraData: {'filename':'imgfile','filetype':'userimg','_token':"{{ csrf_token() }}"},   // 上传数据
        // browseClass: "btn btn-primary", //按钮样式
        // hideThumbnailContent:true,                  // 是否隐藏文件内容
        layoutTemplates :{
            actionDelete:'', //去除上传预览的缩略图中的删除图标
            actionUpload:'',//去除上传预览缩略图中的上传图片；
            // actionZoom:'<i class="fas fa-file-image"></i>'   //去除上传预览缩略图中的查看详情预览的缩略图标
            actionZoom:'',
        },
    }).on("filecleared", function() {
        $("#imgurl").val('');
    }).on("change", function() {               
        // 清除掉上次上传的图片
        $(".uploadPreview1").find(".file-preview-frame:first").remove();
        $(".uploadPreview1").find(".kv-zoom-cache:first").remove();
    }).on("filebatchselected", function(e, files) {  
        // console.log(e);
        // console.log(JSON.stringify(files)=="{}");  
        // console.log(typeof(files.length) == "undefined" );  
        if(JSON.stringify(files)=="{}"){
            // $(e.target).fileinput('clear');
            // $(e.target).fileinput('unlock');
            return;
        }else{
            // console.log(1);
            $(this).fileinput("upload");             // 文件选择完直接调用上传方法。
        }
    }).on("filebatchuploadsuccess", function(event, data) { // 上传成功回调
        // alert("Upload Success!");
        // console.log(data);
        // console.log(event);
        $("#imgurl").val(data.response.filename);
    }).on('fileerror', function(event, data, msg) {
        alert("Upload Error "+msg);
    });

    $("#aufile").fileinput({
        language: 'zh',
        initialPreview: audiourl,
        initialPreviewAsData: true,
        initialPreviewConfig: [
            {caption:"{{$poster->audiourl}}", }
        ],
        initialPreviewFileType: "audio",
        // previewFileIcon: "<i class='fas fa-file-image'></i>",
        // language:'zh',                                          // 多语言设置，需要引入local中相应的js，例如locales/zh.js
        // theme: "explorer-fa",                                // 主题
        uploadUrl: "profile/upload",         // 上传地址
        uploadAsync: false, //默认异步上传
        maxFileCount: 1,                                        // 最大上传数量
        maxFileSize : 8000, 
        autoOrientImage:false,
        // allowedFileTypes:['audio'],
        allowedFileExtensions : ['mp3', 'm4a'],//允许的文件类型
        enctype:'multipart/form-data',
        // showPreview: true,                                   //是否显示预览
        showRemove: true,                                       // 显示移除按钮
        showCancel: false,
        showUpload: false,
        previewClass:"uploadPreview2",
        dropZoneEnabled: false,
        uploadExtraData: {'filename':'aufile','filetype':'userimg','_token':"{{ csrf_token() }}"},   // 上传数据
        // browseClass: "btn btn-primary", //按钮样式
        // hideThumbnailContent:true,                  // 是否隐藏文件内容
        layoutTemplates :{
            actionDelete:'', //去除上传预览的缩略图中的删除图标
            actionUpload:'',//去除上传预览缩略图中的上传图片；
            // actionZoom:'<i class="fas fa-file-image"></i>'   //去除上传预览缩略图中的查看详情预览的缩略图标
            actionZoom:'',
        },
    }).on("filecleared", function() {
        $("#audiourl").val('');
    }).on("change", function() {               
        // 清除掉上次上传的图片
        $(".uploadPreview2").find(".file-preview-frame:first").remove();
        $(".uploadPreview2").find(".kv-zoom-cache:first").remove();
    }).on("filebatchselected", function(e, files) {  
        // console.log(e);
        // console.log(JSON.stringify(files)=="{}");  
        // console.log(typeof(files.length) == "undefined" );  
        if(JSON.stringify(files)=="{}"){
            // $(e.target).fileinput('clear');
            // $(e.target).fileinput('unlock');
            return;
        }else{
            // console.log(1);
            $(this).fileinput("upload");             // 文件选择完直接调用上传方法。
        }
    }).on("filebatchuploadsuccess", function(event, data) { // 上传成功回调
        // alert("Upload Success!");
        // console.log(data);
        // console.log(event);
        $("#audiourl").val(data.response.filename);
    }).on('fileerror', function(event, data, msg) {
        alert("Upload Error "+msg);
    });
    
</script>
@endif
@endsection