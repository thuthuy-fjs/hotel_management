<!-- Sidenav -->
<nav class="sidenav navbar navbar-vertical  fixed-left  navbar-expand-xs navbar-light bg-white" id="sidenav-main">
    <div class="scrollbar-inner">
        <!-- Brand -->
        <div class="sidenav-header  align-items-center">
            <a class="navbar-brand" href="javascript:void(0)">
                <img src="{{ asset('admin_assets/img/brand/blue.png')}}" class="navbar-brand-img" alt="...">
            </a>
        </div>
        <div class="navbar-inner">
            <!-- Collapse -->
            <div class="collapse navbar-collapse" id="sidenav-collapse-main">
                <!-- Nav items -->
                <ul class="navbar-nav mb-md-3">
                    <li class="nav-item">
                        <a class="nav-link active" href="{{route('admin.dashboard')}}">
                            <i class="ni ni-tv-2 text-primary"></i>
                            <span class="nav-link-text">Dashboard</span>
                        </a>
                    </li>
                </ul>
                <!-- Divider -->
                <hr class="my-3">
                <!-- Heading -->
                <h6 class="navbar-heading p-0 text-muted">
                    <span class="docs-normal">Khách sạn</span>
                </h6>
                <ul class="navbar-nav mb-md-3">
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('admin.country')}}">
                            <i class="ni ni-planet text-orange"></i>
                            <span class="nav-link-text">Quốc gia</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('admin.province')}}">
                            <i class="ni ni-pin-3 text-primary"></i>
                            <span class="nav-link-text">Tỉnh/Thành phố</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('admin.hotel')}}">
                            <i class="ni ni-building text-yellow"></i>
                            <span class="nav-link-text">Chỗ nghỉ</span>
                        </a>
                    </li>
                    {{--<li class="nav-item">--}}
                        {{--<a class="nav-link nav-pills nav-fill flex-column flex-md-row" href="#collapse1"--}}
                           {{--data-toggle="collapse" data-target="#collapse1" aria-expanded="true"--}}
                           {{--aria-controls="collapse">--}}
                            {{--<i class="ni ni-building text-yellow"></i>--}}
                            {{--<span class="nav-link-text">Loại chỗ nghỉ</span>--}}
                        {{--</a>--}}
                        {{--<div id="collapse1" class="collapse">--}}
                            {{--<ul class="nav flex-column">--}}
                                {{--<li class="nav-item">--}}
                                    {{--<a class="nav-link" href="{{route('admin.hotel')}}">Khách sạn</a>--}}
                                {{--</li>--}}
                                {{--<li class="nav-item">--}}
                                    {{--<a class="nav-link" href="#">Căn hộ</a>--}}
                                {{--</li>--}}
                                {{--<li class="nav-item">--}}
                                    {{--<a class="nav-link" href="#">Resort</a>--}}
                                {{--</li>--}}
                                {{--<li class="nav-item">--}}
                                    {{--<a class="nav-link" href="#">Biệt thự</a>--}}
                                {{--</li>--}}
                                {{--<li class="nav-item">--}}
                                    {{--<a class="nav-link" href="#">Nhà nghỉ</a>--}}
                                {{--</li>--}}
                            {{--</ul>--}}
                        {{--</div>--}}
                    {{--</li>--}}
                    <li class="nav-item">
                        <a class="nav-link nav-pills nav-fill flex-column flex-md-row" href="#collapse1"
                           data-toggle="collapse" data-target="#collapse2" aria-expanded="true"
                           aria-controls="collapse">
                            <i class="ni ni-shop text-green"></i>
                            <span class="nav-link-text">Phòng</span>
                        </a>
                        <div id="collapse2" class="collapse">
                            <ul class="nav flex-column">
                                <li class="nav-item">
                                    <a class="nav-link" href="{{route('admin.room.type')}}">Loại phòng</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{route('admin.room.list')}}">Danh sách</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{route('admin.room.detail')}}">Chi tiết</a>
                                </li>
                            </ul>
                        </div>
                    </li>
                </ul>
                <!-- Divider -->
                <hr class="my-3">
                <!-- Heading -->
                <h6 class="navbar-heading p-0 text-muted">
                    <span class="docs-normal">Người dùng</span>
                </h6>
                <!-- Navigation -->
                <ul class="navbar-nav mb-md-3">
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('admin.guest')}}">
                            <i class="ni ni-single-02 text-dark"></i>
                            <span class="nav-link-text">Danh sách</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('admin.booking')}}">
                            <i class="ni ni-collection text-danger"></i>
                            <span class="nav-link-text">Phòng đã đặt</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('admin.star_rating')}}">
                            <i class="ni ni-chat-round text-blue"></i>
                            <span class="nav-link-text">Đánh giá</span>
                        </a>
                    </li>
                </ul>
            </div>

        </div>
    </div>
</nav>