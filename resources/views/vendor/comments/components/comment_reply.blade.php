@auth
    @include('comments::_form')
@elseif(Config::get('comments.guest_commenting') == true)
    @include('comments::_form', [
        'guest_commenting' => true
    ])
@else
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">登录授权</h5>
            <p class="card-text">你必须要登录才能发表评论。</p>
            <a href="{{ route('login') }}" class="btn btn-primary">登录</a>
        </div>
    </div>
@endauth
