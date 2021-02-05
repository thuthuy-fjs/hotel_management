<nav class="navbar navbar-expand-lg navbar-dark ftco_navbar bg-dark ftco-navbar-light" id="ftco-navbar">
    <div class="container">
        <a class="navbar-brand" href="{{route('home')}}">Pacific</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#ftco-nav"
                aria-controls="ftco-nav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="oi oi-menu"></span> Menu
        </button>

        <div class="collapse navbar-collapse" id="ftco-nav">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item active"><a href="{{route('home')}}" class="nav-link">Home</a></li>
                <li class="nav-item"><a href="about.html" class="nav-link">About</a></li>
                <li class="nav-item"><a href="{{route('search.country', 10)}}" class="nav-link">Tỉnh/Thành phố</a></li>
                <li class="nav-item">
                    @guest
                        <a href="{{route('login')}}" class="nav-link">Đăng nhập</a>
                    @else
                        <div class="nav-link dropdown">
                            <a class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"
                               id="dropdownMenuButton">
                                {{Auth::user()->user_name}}
                            </a>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                <a class="dropdown-item" href="{{route('profile')}}">Tài khoản của bạn</a>
                                <a class="dropdown-item" href="{{ route('logout') }}">Đăng xuất</a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                      style="display: none;">
                                    @csrf
                                </form>
                            </div>
                        </div>
                    @endguest
                </li>
            </ul>
        </div>
    </div>
</nav>
<!-- END nav -->

<div class="hero-wrap js-fullheight" style="background-image: url({{asset('frontend_assets/images/bg_5.jpg')}});">
    <div class="overlay"></div>
    <div class="container">
        <div class="row no-gutters slider-text js-fullheight align-items-center" data-scrollax-parent="true">
            <div class="col-md-7 ftco-animate">
                <span class="subheading">Welcome to Pacific</span>
                <h1 class="mb-4">Tìm kiếm khách sạn, chỗ nghỉ ...</h1>
                <p class="caps">Từ những khu nghỉ dưỡng thanh bình đến những căn hộ hạng sang hiện đại</p>
            </div>
        </div>
    </div>
</div>
