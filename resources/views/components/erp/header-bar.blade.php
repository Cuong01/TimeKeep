<header>
    <label for="lf-control" class="h-btn h-menu">{!! lfIcon('menu') !!}</label>
    <div class="show1">
        <a href="{{ route('admin') }}">
            <h4>Admin</h4>
        </a>
    </div>

    <div class="show1" x-data="{ open1: false }" @click="open1=!open1">
        <div class="open">
            <div class="loading">
                Quản lý chấm công
                <label>{!! lfIcon('expand-down') !!}</label>
            </div>
        </div>
        <div class="box_right" x-show="open1" @click.outside="open1 = false" style="display: none;">
            <div class="module_list">
                <a href="{{ route('time-keep.timekeeps') }}">
                    <label>{!! lfIcon('expand-right') !!}</label>
                    <p>Chấm công</p>
                </a>
                <a href="{{ route('time-keep.timekeep-rules') }}">
                    <label>{!! lfIcon('expand-right') !!}</label>
                    <p>Luật chấm công</p>
                </a>
                <a href="{{ route('time-keep.singles') }}">
                    <label>{!! lfIcon('expand-right') !!}</label>
                    <p>Đơn</p>
                </a>
                <a href="{{ route('time-keep.applications') }}">
                    <label>{!! lfIcon('expand-right') !!}</label>
                    <p>Loại nghỉ</p>
                </a>
                <a href="{{ route('time-keep.holidays') }}">
                    <label>{!! lfIcon('expand-right') !!}</label>
                    <p>Nghỉ lễ</p>
                </a>
            </div>
        </div>
    </div>
    <div class="show1" x-data="{ open2: false }" @click="open2=!open2">
        <div class="open">
            <div class="loading">
                Quản lý nhân sự
                <label>{!! lfIcon('expand-down') !!}</label>
            </div>
        </div>
        <div class="box_right" x-show="open2" @click.outside="open2 = false" style="display: none;">
            <div class="module_list">
                <a href="{{ route('company.staff-infomations') }}">
                    <label>{!! lfIcon('expand-right') !!}</label>
                    <p>Quản lý nhân sự</p>
                </a>
                <a href="{{ route('company.companies') }}">
                    <label>{!! lfIcon('expand-right') !!}</label>
                    <p>Công ty</p>
                </a>
                <a href="{{ route('company.departments') }}">
                    <label>{!! lfIcon('expand-right') !!}</label>
                    <p>Phòng ban</p>
                </a>
                <a href="{{ route('company.positions') }}">
                    <label>{!! lfIcon('expand-right') !!}</label>
                    <p>Chức vụ</p>
                </a>
            </div>
        </div>
    </div>
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
            @if (Auth::user()->profile_photo_path)
                <img class="h-20 w-20 rounded-full object-cover"
                    src="/{{ json_decode(Auth::user()->profile_photo_path)->name }}" alt="{{ Auth::user()->name }}" />
            @else
                <img class="h-20 w-20 rounded-full object-cover" src="{{ Auth::user()->profile_photo_url }}"
                    alt="{{ Auth::user()->name }}" />
            @endif
            <span class="name">{{ Auth::user()->name }}</span>
        </div>
        <div class="action">
            <a class="btn" href="/user/profile">Hồ sơ cá nhân</a>
            <form method="post" action="{{ route('logout') }}">
                @csrf
                <button class="btn">Đăng xuất</button>
            </form>
        </div>
    </x-lf.btn.dropdown>
</header>

<style>
    .header-bar1 {
        width: 100px;
    }

    /* menu */
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
        box-shadow: 0 1px 1px 1px rgb(0 0 0 / 20%);
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
        box-shadow: 2px 2px 2px 2px rgb(0 0 0 / 10%);
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

    /**/
    .show1 {
        position: relative;
        height: 3rem;
        width: 10rem;
        display: flex;
        cursor: pointer;
        align-items: center;
        justify-content: center;
        --tw-text-opacity: 1;
        color: rgb(255 255 255 / var(--tw-text-opacity));
    }

    .show1 .loading {
        display: flex;
        height: 100%;
        width: 100%;
        cursor: pointer;
        align-items: center;
        justify-content: center;
        --tw-text-opacity: 1;
        color: rgb(255 255 255 / var(--tw-text-opacity));
    }

    .show1 .loading label {
        margin-top: 3px;
    }

    .show1 .open {
        width: 100%;
        height: 100%;
    }

    .show1:hover {
        --tw-bg-opacity: 1;
        background-color: rgb(2 132 199 / var(--tw-bg-opacity));
    }

    .show1 .box_right {
        position: absolute;
        width: 10rem;
        min-height: 151px;
        top: 100%;
        height: auto;
        color: black;
        border-radius: 2px;
        background: #fff;
        /* padding: 10px; */
        box-shadow: 0 1px 1px 1px rgb(0 0 0 / 20%);
    }

    .show1 .box_right .module_list a {
        justify-content: flex-start;
        gap: 5px;
        margin-bottom: 5px;
        display: flex;
        width: 100%;
        height: 30px;
    }

    .show1 .box_right .module_list a:hover {
        border-radius: 2px;
        background-color: rgb(180, 241, 255)
    }

    .show1 .box_right .module_list a label {
        margin-top: 7px;
    }

    .show1 .box_right .module_list a p {
        padding: 5px;
    }
</style>
