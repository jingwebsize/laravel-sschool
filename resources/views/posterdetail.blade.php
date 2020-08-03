@extends('layouts.tabcontent')

@section('content')
<style>
    img{
        max-width: 100%;
        height: auto;
    }
    /* @media only screen and (max-width: 1000px) {
        img {
        max-width: 100%; 
        height: auto;
        }
    } */
    iframe{
        width: 700px;
        height: 500px;
    }
    @media only screen and (max-width: 800px) {
        iframe {
        max-width: 100%; 
        height: auto;
        }
    }
    #comments{
        width: 100%;
        height: 1000px;
    }
    
    /* #videoBox { 
        transition: 0.5s; 
    } 
  
    #videoBox.in { 
        animation: ac 1s; 
    } 
  
    #videoBox.out { 
        position: fixed; 
        bottom: 0; 
        right: 0; 
        width: 300px; 
        z-index: 999; 
        animation: an 0.5s; 
    } */
</style>

<script>
    function mymethod(){
// $(document).ready(function(){
    // $('#starbutton').click(function(){
        if ($('#starlogo').hasClass('far')){
            // $.ajax({
            //     url: "/poster/{{$poster->id}}/likeit",
            //     type: 'GET',
            //     headers: {'X-CSRF-TOKEN': "{{ csrf_token() }}"},
            //     success: function(data){
            //         console.log(response);
            //         $('#starlogo').attr("class","fas");
            //     }
            // });
            axios.get('/poster/{{$poster->id}}/likeit')
            .then((response)=>{
                // console.log(response);
                $('#starbutton').attr("class","btn btn-primary");
                $('#starlogo').attr("class","fas fa-thumbs-up");
            }).catch((error)=>{
                console.log(error.response.data);
            })
        }else{
            axios.get('/poster/{{$poster->id}}/cancel')
            .then((response)=>{
                // console.log(response);
                $('#starbutton').attr("class","btn btn-outline-primary");
                $('#starlogo').attr("class","far fa-thumbs-up");
            }).catch((error)=>{
                console.log(error.response.data);
            })
        }
    }
    // });
// });
</script>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <br/>
            <h3>{{$poster->title}}
            </h3>
            <br/>
            <div>
                <!-- @if($poster->star(Auth::user()->userid)->exists())
                    <a href="/poster/{{$poster->id}}/cancel" type="button" class="btn-outline-primary"><i class="fas fa-thumbs-up"></i> I Like it</a>
                @else
                    <a href="/poster/{{$poster->id}}/likeit" type="button" class="btn-outline-primary"><i class="far fa-thumbs-up"></i> I Like it</a>
                @endif -->
                <button type="button" class="btn {{ $poster->star(Auth::user()->userid)->exists()? 'btn-primary':'btn-outline-primary'}}" id="starbutton" onclick="mymethod()"><i id="starlogo" class="{{ $poster->star(Auth::user()->userid)->exists()? 'fas':'far'}} fa-thumbs-up"></i> 点赞</button>
                
            </div>
            <br/>
            <div>
                <!-- {{$poster->content}} -->
                <a href="{{url('userimg/'.$poster->imgurl)}}" target="_blank"><img src="{{url('userimg/'.$poster->imgurl)}}"></div><div style="padding-top:20px"></a>
                <!-- <div style="position: relative; width:400px"> -->
            </div>

            <div id="videoBox" class="videobox">
                @if($poster->isvideo)
                    {!!$poster->videourl!!}
                @else
                <audio controls="controls">
                    <!-- <source src="{{url('userimg/111.mp3')}}" type="audio/mpeg" /> -->
                    <!-- <source src="{{url('userimg/20200731_174008.m4a')}}" type="audio/mpeg" /> -->
                    <source src="{{url('userimg/'.$poster->audiourl)}}" type="audio/mpeg" />
                    您的浏览器不支持此组件。
                    <a href="{{url('userimg/'.$poster->audiourl)}}" target="_blank">音频链接</a>
                </audio>
                @endif
                
                <!-- <video width="400" controls> 
                    <source src="sample.mp4" type="video/mp4">  
                    Your browser does not support HTML5 video. 
                </video>  -->
                <!-- <iframe src="//player.bilibili.com/player.html?aid=841323838&bvid=BV1x54y1q7ko&cid=212866300&page=1" scrolling="no" border="0" frameborder="no" framespacing="0" allowfullscreen="true"> </iframe> -->
                <!-- </div> -->
            </div>
            <br/>
            <br/>
            <h3>讨论区</h3>
            <hr/>
            <!-- <div id="vueapp"><comments-list v-bind:postid="{{$poster->id}}"></comments-list></div> -->
            <!-- <div class="commentsdiv"> -->
            <iframe id="comments" name="comments" src="/postercomments/{{$poster->id}}" border="0" scrolling="0" frameborder="no" framespacing="0" ></iframw>
        </div>
    </div>
</div>
<script type="text/javascript">
    // setInterval(test, 1000);
    // function test(){
    //     // $('#comments').load();
    //     $(".commentsdiv").load(location.href+".commentsdiv");
    // }
    // var ha = ( $('#videoBox').offset().top + $('#videoBox').height() ); 
  
    // $(window).scroll(function(){   
    
    // if ( $(window).scrollTop() > ha + 500 ) {  
    //     $('#videoBox').css('bottom','0');  
    // } else if ( $(window).scrollTop() < ha + 200) {   
    //     $('#videoBox').removeClass('out').addClass('in');      
    // } else {        
    //     $('#videoBox').removeClass('in').addClass('out');    
    //     $('#videoBox').css('bottom','-500px');              
    // };   
    
    // });
</script>
@endsection