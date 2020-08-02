@extends('layouts.tabcontent')

@section('content')
<div class="container">
    <!-- <ul class="nav nav-tabs"> -->
        <!-- <li class="nav-item">
            <a class="nav-link" href="home">Home</a>
        </li> -->
        <!-- <li class="nav-item">
            <a class="nav-link active" href="profile">Profile</a>
        </li> -->
        <!-- <li class="nav-item">
            <a class="nav-link" href="courses">Courses</a>
        </li> -->
        <!-- <li class="nav-item">
            <a class="nav-link" href="poster">Poster</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="download">Download</a>
        </li>
    </ul> -->
<br/>
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <!-- <div class="card-header">Supplementary Information</div> -->
                <div class="card-header">Information</div>
                <form method="POST" action="profile/{{$info->id}}">
                    @csrf
                <!-- <div class="col-md-10">
                    <br/>
                    <div class="form-group">
                        <label for="file">Payment Receipt</label>
                        <input id="payfile" type="file" class="form-control" name="payfile">
                        <input id="payurl" type="text" name="url" value="{{$info->url}}" hidden>    
                    </div> 
                </div>
                <div class="col-md-5 mb-3">
                    <label for="tsize">T-shirt Size</label>
                    <select class="custom-select d-block w-100" id="tsize" name="tsize">
                        <option value="0">Choose...</option>
                        <option value="1">S</option>
                        <option value="2">M</option>
                        <option value="3">L</option>
                        <option value="4">XL</option>
                    </select>
                </div> -->
                <br/>
                <div class="col-md-10">
                    <div class="form-group">
                        <!-- <label for="fileurl">Summary file</label> -->
                        <input id="sumfile" type="file" class="form-control-file" name="sumfile">
                        <input id="sumurl" type="text" name="file" value="{{$info->file}}" hidden> 
                    </div>               
                </div>
                <br/> 
                <!-- <div class="row justify-content-md-center"> -->
                    <div class="col-md-5">
                        <button type="submit" class="btn btn-primary btn-block">Confirm</button>
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
    // 上传附件
    $('#tsize').val("{{$info->tsize}}");
    var payurl = "{{ $info->url? asset('userimg/'.$info->url):null }}";
    var fileurl = "{{ $info->file? asset('userfile/'.$info->file):null }}";
    $("#payfile").fileinput({
        initialPreview: payurl,
        initialPreviewAsData: true,
        initialPreviewConfig: [
            {caption:"{{$info->url}}", }
        ],
        initialPreviewFileType: "object",
        previewFileIcon: "<i class='fas fa-file-image'></i>",
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
        previewClass:"uploadPreview",
        dropZoneEnabled: false,
        uploadExtraData: {'filename':'payfile','filetype':'userimg','_token':"{{ csrf_token() }}"},   // 上传数据
        // browseClass: "btn btn-primary", //按钮样式
        // hideThumbnailContent:true,                  // 是否隐藏文件内容
        layoutTemplates :{
            actionDelete:'', //去除上传预览的缩略图中的删除图标
            actionUpload:'',//去除上传预览缩略图中的上传图片；
            // actionZoom:'<i class="fas fa-file-image"></i>'   //去除上传预览缩略图中的查看详情预览的缩略图标
            actionZoom:'',
        },
    }).on("filecleared", function() {
        $("#payurl").val('');
    }).on("change", function() {               
        // 清除掉上次上传的图片
        $(".uploadPreview").find(".file-preview-frame:first").remove();
        $(".uploadPreview").find(".kv-zoom-cache:first").remove();
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
        $("#payurl").val(data.response.filename);
    }).on('fileerror', function(event, data, msg) {
        alert("Upload Error "+msg);
    });
    //sumfile
    $("#sumfile").fileinput({
        initialPreview: fileurl,
        initialPreviewAsData: true,
        initialPreviewConfig: [
            {caption:"{{$info->file}}", }
        ],
        initialPreviewFileType: "object",
        previewFileIcon: "<i class='fas fa-file-image'></i>",
        // language:'zh',                                          // 多语言设置，需要引入local中相应的js，例如locales/zh.js
        // theme: "explorer-fa",                                // 主题
        uploadUrl: "profile/upload",         // 上传地址
        uploadAsync: false, //默认异步上传
        maxFileCount: 1,                                        // 最大上传数量
        autoOrientImage:false,
        allowedFileExtensions : ['doc','docx'],//允许的文件类型
        enctype:'multipart/form-data',
        // showPreview: true,                                   //是否显示预览
        showRemove: true,                                       // 显示移除按钮
        showCancel: false,
        showUpload: false,
        previewClass:"uploadfilePreview",
        dropZoneEnabled: false,
        uploadExtraData: {'filename':'sumfile','filetype':'userfile','_token':"{{ csrf_token() }}"},   // 上传数据
        layoutTemplates:{
            actionDelete:'', 
            actionUpload:'',
            actionZoom:''   
        },
    }).on("filecleared", function() {
        $("#sumurl").val('');
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
        $("#sumurl").val(data.response.filename);
    }).on('fileerror', function(event, data, msg) {
        alert("Upload Error "+msg);
    });
    // 上传成功回调
    // $("#payfile").on("filebatchuploadcomplete", function(event, data) {
    //     alert("上传附件成功");
    //     console.log(data);
    //     console.log(event);
    //     // $("#payfile").val=data.response.filename;

    // });
// })
</script>

@endsection