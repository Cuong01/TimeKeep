<header>
    <label for="lf-control" class="h-btn h-menu">{!! lfIcon('menu') !!}</label>
    <div class="header-bar"></div>
    <div class="module_show" x-data="{ open: false }" @click="open=!open">
        <div class="open">
            <div class="loading">
                {!! lfIcon('app') !!}
            </div>
        </div>
        <div class="box_right" x-show="open" @click.outside="open = false" style="display: none;">
            <div class="list_module">
                <div class="module_list">
                    <h3>Module Admin</h3>
                    <a href="{{ route('admin.menus') }}">
                        <label class="icon_mod">
                            {!! lfIcon('list', 25) !!}
                        </label>
                        <h4>Menu</h4>
                    </a>
                    <a href="{{ route('admin.icons') }}">
                        <label class="icon_mod">
                            {!! lfIcon('setting', 25) !!}
                        </label>
                        <h4>Icon</h4>
                    </a>
                    <a href="{{ route('admin.permissions') }}">
                        <label class="icon_mod">
                            {!! lfIcon('security', 25) !!}
                        </label>
                        <h4>Quyền</h4>
                    </a>
                </div>
                <div class="module_list">
                    <h3>Module Chấm công</h3>
                    {{-- <a href="{{ route('time-keep.timekeeps') }}">
                        <label class="icon_mod">
                            {!! lfIcon('edit', 25) !!}
                        </label>
                        <h4>Module Chấm công</h4>
                    </a> --}}
                    <a href="{{ route('time-keep.timekeeps') }}">
                        <label class="icon_mod">
                            {!! lfIcon('edit', 25) !!}
                        </label>
                        <h4>Chấm công</h4>
                    </a>
                    <a href="{{ route('time-keep.timekeep-rules') }}">
                        <label class="icon_mod">
                            {!! lfIcon('security', 25) !!}
                        </label>
                        <h4>Luật chấm công</h4>
                    </a>
                    <a href="{{ route('time-keep.singles') }}">
                        <label class="icon_mod">
                            {!! lfIcon('contact-mail', 25) !!}
                        </label>
                        <h4>Đơn</h4>
                    </a>
                    <a href="{{ route('time-keep.applications') }}">
                        <label class="icon_mod">
                            {!! lfIcon('event', 25) !!}
                        </label>
                        <h4>Loại nghỉ</h4>
                    </a>
                    <a href="{{ route('time-keep.holidays') }}">
                        <label class="icon_mod">
                            {!! lfIcon('event', 25) !!}
                        </label>
                        <h4>Nghỉ lễ</h4>
                    </a>
                </div>
                <div class="module_list">
                    <h3>Module Quản lý nhân sự</h3>
                    <a href="{{ route('company.staff-infomations') }}">
                        <label class="icon_mod">
                            {!! lfIcon('group', 25) !!}
                        </label>
                        <h4>Quản lý nhân sự</h4>
                    </a>
                    <a href="{{ route('company.companies') }}">
                        <label class="icon_mod">
                            {!! lfIcon('business', 25) !!}
                        </label>
                        <h4>Công ty</h4>
                    </a>
                    <a href="{{ route('company.departments') }}">
                        <label class="icon_mod">
                            {!! lfIcon('account-manager', 25) !!}
                        </label>
                        <h4>Phòng ban</h4>
                    </a>
                    <a href="{{ route('company.positions') }}">
                        <label class="icon_mod">
                            {!! lfIcon('account-manager', 25) !!}
                        </label>
                        <h4>Chức vụ</h4>
                    </a>
                </div>
            </div>
        </div>
    </div>
    <x-lf.btn.dropdown class="h-user" icon="person">
        <div class="user">
            <span class="icon">{!! lfIcon('person', 56) !!}</span>
            <span class="name">{{ Auth::user()->name }}</span>
        </div>
        <div class="action">
            <a class="btn">Thông tin cá nhân</a>
            <form method="post" action="{{ route('logout') }}">
                @csrf
                <button class="btn">Đăng xuất</button>
            </form>
        </div>
    </x-lf.btn.dropdown>
</header>

<style>
    .module_show .loading {
        display: flex;
        height: 100%;
        width: 100%;
        cursor: pointer;
        align-items: center;
        justify-content: center;
        --tw-text-opacity: 1;
        color: rgb(255 255 255 / var(--tw-text-opacity));
    }

    .module_show {
        position: relative;
        height: 3rem;
        width: 3rem;
        display: flex;
        cursor: pointer;
        align-items: center;
        justify-content: center;
        --tw-text-opacity: 1;
        color: rgb(255 255 255 / var(--tw-text-opacity));
    }

    .module_show .open {
        width: 100%;
        height: 100%;
    }

    .module_show:hover {
        --tw-bg-opacity: 1;
        background-color: rgb(2 132 199 / var(--tw-bg-opacity));
    }


    .module_show .box_right {
        position: absolute;
        width: 800px;
        min-height: 151px;
        top: 100%;
        height: auto;
        right: 0;
        color: black;
        border-radius: 2px;
        background: #fff;
        padding: 10px;
        box-shadow: 0 3px 2px 3px rgb(0 0 0 / 15%);
    }

    .module_show .box_right .list_module .module_list {
        border: 1px solid #4e4e4e2b;
    }

    .module_show .box_right .list_module .module_list h3 {
        width: 100%;
        padding: 10px 0;
        font-size: 15px;
        margin-bottom: 10px;
        font-weight: bold;
        text-align: center;
        border-bottom: 1px solid #4e4e4e2b;
        text-transform: uppercase;
        color: #334155;
    }

    .module_show .box_right .list_module {
        display: flex;
    }

    .module_show .box_right .list_module .module_list {
        width: 33%;
        text-align: center;
    }

    .module_show .box_right .list_module .module_list a {
        justify-content: flex-start;
        gap: 5px;
        margin-bottom: 10px;
        display: flex;
        width: 100%;
        height: 40px;
    }

    .module_show .box_right .list_module .module_list a:hover {
        border-radius: 3px;
        box-shadow: 2px 2px 2px 2px rgb(0 0 0 / 20%);
        color: #1f2937;
    }

    .module_show .box_right .list_module .module_list a .icon_mod {
        padding: 5px;
    }

    .module_show .box_right .list_module .module_list a h4 {
        padding: 5px;
        font-size: 14px;
        text-transform: capitalize;
    }
</style>
