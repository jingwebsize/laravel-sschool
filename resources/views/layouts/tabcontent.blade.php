@extends('layouts.app')

@section('content')
<div class="container">
<ul class="nav nav-tabs" id="myTab" role="tablist">
    <li class="nav-item">
        <a class="nav-link active" id="home-tab" href="home" role="tab" aria-controls="home" aria-selected="true">Home</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" id="profile-tab" data-toggle="tab" href="profile" role="tab" aria-controls="profile" aria-selected="false">Profile</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" id="course-tab" data-toggle="tab" href="course" role="tab" aria-controls="course" aria-selected="false">Courses</a>
    </li>
</ul>
</div>
<div class="tab-content" id="myTabContent">
    @yield('tab-content')
</div>
@endsection
