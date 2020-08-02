<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" ></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('fontawesome-free-5.13.0-web/css/all.css') }}">
    <link rel="stylesheet" href="{{ asset('bootstrap-datetimepicker-master/css/bootstrap-datetimepicker.min.css') }}">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <style>
    #commentshow{
        /* border: 1px solid #000; */
        width: 100%;
        height: 450px;
    }
    </style>
</head>
<body>
    <div>@comments(['model'=>$poster])</div>
    <!-- <iframe id="commentshow" name="commentshow" src="/postercommentshow/{{$poster->id}}" border="0" frameborder="no" framespacing="0" ></iframw> -->
</body>
<!-- <script>
    setInterval(test, 1000);
    function test(){
        // $('#comments').load();
        $(".commentsdiv").load(location.href+".commentsdiv");
    }
</script> -->