<nav class="navbar navbar-expand navbar-dark blue-gradient">

  <a class="navbar-brand" href="/"><i class="far fa-sticky-note mr-1"></i>memo</a>

  <ul class="navbar-nav ml-auto">
    @guest
    <li class="nav-item">
    <a class="nav-link" href="{{ route('register') }}">ユーザー登録</a>
    </li>
    @endguest
    @guest 
    <li class="nav-item">
    <a class="nav-link" href="{{ route('login') }}">ログイン</a>
    </li>
    @endguest
    @auth
    <li class="nav-item">
    <a class="nav-link" href="{{ route('articles.create') }}"><i class="fas fa-pen mr-1"></i>投稿する</a> 
    </li>
    @endauth
    @auth
    <li class="nav-item dropdown">
      <a class="nav-link dropdown-toggle" id="navbarDropdownMenuLink" data-toggle="dropdown"
         aria-haspopup="true" aria-expanded="false">
        @if(!empty(Auth::user()->image))
              <img class='prof-photo' src="{{ asset('storage/images/'.Auth::user()->image) }}" >
        @else
              <i class="fas fa-user-circle fa-3x mr-1"></i>
        @endif
      </a>
      <div class="dropdown-menu dropdown-menu-right dropdown-primary" aria-labelledby="navbarDropdownMenuLink">
        <button class="dropdown-item" type="button"
                onclick="location.href='{{ route("users.show", ["name" => Auth::user()->name]) }}'">
          マイページ
        </button>
        <div class="dropdown-divider"></div>
        <button class="dropdown-item" type="button"
                onclick="location.href='{{ route("users.edit", ["name" => Auth::user()->name]) }}'">
          基本プロフィールを編集
        </button>
        <div class="dropdown-divider"></div>
        <button class="dropdown-item" type="button"
                onclick="location.href='{{ route("background") }}'">
          経歴・実績を編集
        </button>
        <div class="dropdown-divider"></div>
        <button class="dropdown-item" type="button"
                onclick="location.href='{{ route("message_list", ["name" => Auth::user()->name]) }}'">
          メッセージ一覧
        </button>
        <div class="dropdown-divider"></div>
        <button form="logout-button" class="dropdown-item" type="submit">
          ログアウト
        </button>
      </div>
    </li>
    <form id="logout-button" method="POST" action="{{ route('logout') }}">
    @csrf
    </form>
    @endauth
  </ul>
</nav>