@extends('layouts.tabcontent')

@section('content')
<div class="container">
<br/>
    <div class="row justify-content-center">
        <div class="col-md-12">
            @if($posters->isEmpty())
                <h3>请等待开放。</h3>
            @endif
            @foreach($posters as $poster)
                <div class="blog-post">
                    <h3 class="blog-post-title"><a href="/poster/{{$poster->id}}">{{$poster->title}}</a></h3>
                    <p class="blog-post-meta">{{$poster->created_at->toDateString()}} ｜ 作者：{{$poster->user->name}} ({{$poster->user->email}})</p>

                    <!-- <p>{{$poster['content']}}</p> -->
                    <p class="blog-post-meta"><i class="fas fa-thumbs-up"></i> 点赞 <span class="text-primary">{{$poster->stars_count}}</span> | 评论数 <span class="text-primary">{{$poster->comments_count}}</span></p>
                <hr/>
                </div>
            @endforeach
            <div>{{ $posters->links() }}</div>
        </div>
    </div>
</div>
@endsection