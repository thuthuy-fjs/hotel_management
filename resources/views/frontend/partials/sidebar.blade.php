<div class="col-sm-3 sidebar">
    <div id="sidebar-container" class="sidebar-expanded d-none d-md-block">
        <ul class="list-group">
            <a href="#submenu1" data-toggle="collapse" aria-expanded="false" class="bg-light list-group-item list-group-item-action flex-column align-items-start">
                <div class="d-flex w-100 justify-content-start align-items-center">
                    <span class="fa fa-user fa-fw mr-3 text-info"></span>
                    <span class="menu-collapsed">Tài khoản của tôi</span>
                    <span class="submenu-icon ml-auto"></span>
                </div>
            </a>
            <!-- Submenu content -->
            <div id='submenu1' class="collapse sidebar-submenu">
                <a href="{{route('profile')}}" class="list-group-item list-group-item-action bg-default text-dark">
                    <span class="menu-collapsed">Hồ sơ</span>
                </a>
                <a href="{{route('change_password.edit')}}" class="list-group-item list-group-item-action
                    bg-default text-dark">
                    <span class="menu-collapsed">Đổi mật khẩu</span>
                </a>
            </div>
            <hr class="my-1">
            <a href="{{route('booking.list')}}" class="bg-light list-group-item list-group-item-action">
                <div class="d-flex w-100 justify-content-start align-items-center">
                    <span class="fa fa-list fa-fw mr-3 text-danger"></span>
                    <span class="menu-collapsed">Đơn đặt phòng</span>
                </div>
            </a>
            <hr class="my-1">
            <a href="{{route('booking.star')}}" class="bg-light list-group-item list-group-item-action">
                <div class="d-flex w-100 justify-content-start align-items-center">
                    <span class=" fa fa-star fa-fw mr-3" style="color: #FBC02D;"></span>
                    <span class="menu-collapsed">Đánh giá</span>
                </div>
            </a>

        </ul><!-- List Group END-->
    </div><!-- sidebar-container END -->
</div>
