<header>
  <nav class="navbar navbar-expand-lg bg-body-tertiary">
    <div class="container-fluid">
      <a class="navbar-brand " href="#">TNKA</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
        aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mx-auto mb-2 mb-lg-0">
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="/">Trang Chủ</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">Sản Phẩm</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">Chương trình khuyến mãi</a>
          </li>
          
          <li class="nav-item">
            <a class="nav-link" href="#">About</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">Contact</a>
          </li>
          @if (Auth::check())
          <li class="nav-item">
          <a href="{{ route('forgot-password.form') }}">
        <button type="button">Forgot Password?</button>
    </a>
          </li>
          @else
          <li class="nav-item">
          
          </li>
          @endif
        </ul>
        <form class="d-flex" role="search">
          @if (!Auth::check())
          <a href="{{route('register')}}" class="btn btn-outline"><i class="bi bi-person-circle"></i></a>
          @elseif (Auth::check() && Auth::user()->role == 'admin')
          <div class="dropdown">
            <button class="btn  dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
              Xin Chào, {{Auth::user()->name}}
            </button>
            <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="{{route('admin.dashboard')}}">Quản Lý</a></li>
            <li><a class="dropdown-item" href="{{ route('viewsorder', ['id' => Auth::user()->id]) }}">Theo Dõi Đơn</a></li>
              <li><a class="dropdown-item" href="{{route('logout')}}">Đăng Xuất</a></li>
            </ul>
          </div>
        @else
        <div class="dropdown">
            <button class="btn  dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
              Xin Chào, {{Auth::user()->name}}
            </button>
            <ul class="dropdown-menu">
              <li><a class="dropdown-item" href="{{ route('viewsorder', ['id' => Auth::user()->id]) }}">Theo Dõi Đơn</a></li>
              <li><a class="dropdown-item" href="{{route('logout')}}">Đăng Xuất</a></li>
            </ul>
            
          </div>
          @endif
          <a href="{{Route('cart')}}" class="btn btn-outline"><i class="bi bi-bag-fill"></i></a>
          <a href="/bell" class="btn btn-outline"><i class="bi bi-bell-fill"></i></a>
        </form>
      </div>
    </div>
  </nav>
  <!-- banner -->
</header>