@extends('layouts.tabcontent')

@section('content')
<div class="container">
<br/>
    <div class="row justify-content-center">
        <div class="col-md-12">
            @if($posters->isEmpty())
                <h6>请等待开放。</h6>
            @else
            @foreach($posters as $poster)
                <div class="blog-post">
                    <h4 class="blog-post-title"><a href="/poster/{{$poster->id}}">{{$poster->title}}</a></h4>
                    <p class="blog-post-meta">作者：{{$poster->user->name}} ({{$poster->user->email}})</p>
                    <!-- <p>{{$poster->updated_at->toDateString()}} ｜ {{$poster['content']}}</p> -->
                    <p class="blog-post-meta"><i class="fas fa-thumbs-up"></i> 点赞 <span class="text-primary">{{$poster->stars_count}}</span> | 评论数 <span class="text-primary">{{$poster->comments_count}}</span></p>
                <hr/>
                </div>
            @endforeach
            <div>{{ $posters->links() }}</div>
            @endif
        </div>
    </div>
</div>
@endsection