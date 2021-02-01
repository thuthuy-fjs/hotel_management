<nav class="navbar navbar-expand-lg navbar-dark ftco_navbar bg-dark ftco-navbar-light" id="ftco-navbar">
    <div class="container">
        <a class="navbar-brand" href="#">Pacific</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#ftco-nav"
                aria-controls="ftco-nav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="oi oi-menu"></span> Menu
        </button>

        <div class="collapse navbar-collapse" id="ftco-nav">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item active"><a href="index.html" class="nav-link">Home</a></li>
                <li class="nav-item"><a href="about.html" class="nav-link">About</a></li>
                <li class="nav-item"><a href="destination.html" class="nav-link">Tỉnh/Thành phố</a></li>
                <li class="nav-item">
                    @guest
                        <a href="{{route('login')}}" class="nav-link">Đăng nhập</a>
                    @else
                        <div class="nav-link dropdown">
                            <a class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"
                               id="dropdownMenuButton">
                                Tài khoản
                            </a>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                <a class="dropdown-item" href="#">Tài khoản</a>
                                <a class="dropdown-item" href="#">Logout</a>
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
