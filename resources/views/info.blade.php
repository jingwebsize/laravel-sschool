@extends('layouts.tabcontent')

@section('content')
<div class="container">
<br/>
    <div class="row justify-content-center">
        <div class="col-md-12">
            @if($info->house>0) 
                <h6>您已完成提交。</h6>
            @else
            <div class="card">
                <!-- <div class="card-header">Supplementary Information</div> -->
                <div class="card-header">提交总结</div>
                <form method="POST" action="profile/{{$info->id}}">
                    @csrf
                <div class="col-md-10">
                    <br/>
                    <div class="form-group">
                        <label for="payfile">Word版总结（文件命名格式：编号_姓名，文件大小：<4M）</label>
                        <input id="payfile" type="file" class="form-control" name="payfile">
                        <input id="payurl" type="text" name="url" value="{{$info->url}}" hidden>    
                    </div> 
                </div>
                <!-- <div class="col-md-5 mb-3">
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
                        <label for="sumfile">Pdf版总结（文件命名格式：编号_姓名，文件大小：<4M）</label>
                        <input id="sumfile" type="file" class="form-control-file" name="sumfile">
                        <input id="sumurl" type="text" name="file" value="{{$info->file}}" hidden> 
                    </div>               
                </div>
                <br/> 
                <!-- <div class="row justify-content-md-center"> -->
                    <div class="col-md-5">
                        <button id="formsubmit" type="submit" class="btn btn-primary btn-block">提交</button>
                    </div>
                <!-- </div> -->
                <br/>        
                </form>
            </div>
            @endif
        </div>
    </div>
</div>
<!-- <script src="https://kit.fontawesome.com/be20376ea9.js" crossorigin="anonymous"></script> -->
<script>
$(function(){
    $('#formsubmit').click(function (){
        if (!$('#payurl').val()) {
            alert('请上传Word版总结');
            return false;
        };
        console.log($('#payurl').val());
        if (!$('#sumurl').val()) {
            alert('请上传Pdf版总结');
            return false;
        }
        return confirm('提交后不可修改，确定提交吗?');
    });
});
    // 上传附件
    $('#tsize').val("{{$info->tsize}}");
    var payurl = "{{ $info->url? asset('userfile/'.$info->url):null }}";
    var fileurl = "{{ $info->file? asset('userfile/'.$info->file):null }}";
    $("#payfile").fileinput({
        language: 'zh',
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
        maxFileSize: 4096,
        autoOrientImage:false,
        allowedFileExtensions : ['doc','docx'],//允许的文件类型
        enctype:'multipart/form-data',
        // showPreview: true,                                   //是否显示预览
        showRemove: true,                                       // 显示移除按钮
        showCancel: false,
        showUpload: false,
        previewClass:"uploadPreview1",
        dropZoneEnabled: false,
        uploadExtraData: {'filename':'payfile','filetype':'userfile','_token':"{{ csrf_token() }}"},   // 上传数据
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
        $("#payurl").val(data.response.filename);
    }).on('fileerror', function(event, data, msg) {
        alert("Upload Error "+msg);
    });

    $("#sumfile").fileinput({
        language: 'zh',
        initialPreview: fileurl,
        initialPreviewAsData: true,
        initialPreviewConfig: [
            {caption:"{{$info->file}}", }
        ],
        initialPreviewFileType: "pdf",
        previewFileIcon: "<i class='fas fa-file-image'></i>",
        // language:'zh',                                          // 多语言设置，需要引入local中相应的js，例如locales/zh.js
        // theme: "explorer-fa",                                // 主题
        uploadUrl: "profile/upload",         // 上传地址
        uploadAsync: false, //默认异步上传
        maxFileCount: 1,                                        // 最大上传数量
        maxFileSize: 4096,
        autoOrientImage:false,
        allowedFileExtensions : ['pdf'],//允许的文件类型
        enctype:'multipart/form-data',
        // showPreview: true,                                   //是否显示预览
        showRemove: true,                                       // 显示移除按钮
        showCancel: false,
        showUpload: false,
        previewClass:"uploadPreview2",
        dropZoneEnabled: false,
        uploadExtraData: {'filename':'sumfile','filetype':'userfile','_token':"{{ csrf_token() }}"},   // 上传数据
        // browseClass: "btn btn-primary", //按钮样式
        // hideThumbnailContent:true,                  // 是否隐藏文件内容
        layoutTemplates :{
            actionDelete:'', //去除上传预览的缩略图中的删除图标
            actionUpload:'',//去除上传预览缩略图中的上传图片；
            // actionZoom:'<i class="fas fa-file-image"></i>'   //去除上传预览缩略图中的查看详情预览的缩略图标
            actionZoom:'',
        },
    }).on("filecleared", function() {
        $("#sumurl").val('');
    }).on("change", function() {               
        // 清除掉上次上传的图片
        $(".uploadPreview2").find(".file-preview-frame:first").remove();
        $(".uploadPreview2").find(".kv-zoom-cache:first").remove();
    }).on("filebatchselected", function(e, files) {  
        if(JSON.stringify(files)=="{}"){
            return;
        }else{
            $(this).fileinput("upload");             // 文件选择完直接调用上传方法。
        }
    }).on("filebatchuploadsuccess", function(event, data) { // 上传成功回调
        $("#sumurl").val(data.response.filename);
    }).on('fileerror', function(event, data, msg) {
        alert("Upload Error "+msg);
    });
</script>

@endsection