@extends('layouts.tabcontent')

@section('content')
<div class="container">
    <!-- <ul class="nav nav-tabs"> -->
        <!-- <li class="nav-item">
            <a class="nav-link" href="home">Home</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="profile">Profile</a>
        </li>
        <li class="nav-item">
            <a class="nav-link active" href="courses">Courses</a>
        </li> -->
        <!-- <li class="nav-item">
            <a class="nav-link" href="profile">Profile</a>
        </li>
        <li class="nav-item">
            <a class="nav-link active" href="poster">Poster</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="download">Download</a>
        </li>
    </ul> -->
<br/>
    <div class="row justify-content-center">
        <div class="col-md-12">
            @if($posters->isEmpty())
                <p>Waiting for opening.</P>
            @endif
            @foreach($posters as $poster)
                <div class="blog-post">
                    <h3 class="blog-post-title"><a href="/poster/{{$poster->id}}">{{$poster->title}}</a></h3>
                    <p class="blog-post-meta">{{$poster->created_at->toFormattedDateString()}} by <strong>{{$poster->user->name}}</strong> ({{$poster->user->email}})</p>

                    <!-- <p>{{$poster['content']}}</p> -->
                    <p class="blog-post-meta"><i class="fas fa-thumbs-up"></i> <span class="text-primary">{{$poster->stars_count}}</span> | Comments <span class="text-primary">{{$poster->comments_count}}</span></p>
                <hr/>
                </div>
            @endforeach
            <div>{{ $posters->links() }}</div>
        </div>
    </div>
</div>
@endsection