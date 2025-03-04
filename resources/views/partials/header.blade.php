<div class="header">
    <div class="nav-buttons">
        <a href="{{ route('user.schedule') }}">時間割</a>
        <a href="{{ route('user.progress') }}">授業進捗</a>
        <a href="{{ route('user.profile') }}">プロフィール設定</a>
    </div>
    <a href="{{ route('logout') }}" class="nav-buttons logout-btn"
       onclick="event.preventDefault(); document.getElementById('logout-form').submit();">ログアウト</a>

    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
        @csrf
    </form>
</div>
