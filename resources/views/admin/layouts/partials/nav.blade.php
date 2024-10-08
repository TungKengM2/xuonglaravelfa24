<nav class="sidebar vertical-scroll  ps-container ps-theme-default ps-active-y">
    <div class="logo d-flex justify-content-between">
        <a href="index-2.html"><img src="/admin/img/logo.png" alt></a>
        <div class="sidebar_close_icon d-lg-none">
            <i class="ti-close"></i>
        </div>
    </div>
    <ul id="sidebar_menu">
        <li class="mm-active">
            <a class="has-arrow" href="#" aria-expanded="false">
                <div class="icon_menu">
                    <img src="/admin/img/menu-icon/dashboard.svg" alt>
                </div>
                <span>Posts</span>
            </a>
            <ul>
                <li><a class="active" href="{{ route('adminposts.index') }}">Danh sách</a></li>
                <li><a class="active" href="{{ route('adminposts.create') }}">Thêm Mới</a></li>
            </ul>
        </li>

        <li class>
            <a href="{{url('/adminHome')}}" aria-expanded="false">
                <div class="icon_menu">
                    <img src="/admin/img/menu-icon/5.svg" alt>
                </div>
                <span href="">Trang chủ</span>
            </a>
        </li>

    </ul>
</nav>
