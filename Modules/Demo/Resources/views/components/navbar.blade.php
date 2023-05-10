<div id="lf-menu">
    <ul id="navbar">
        <li class="item {{ request()->routeIs('demo')? 'active' : '' }} ">
            <a href="{{route('demo')}}" class="link"><span class="icon">{!! lfIcon("home") !!}</span><span class="link-title">Demo</span></a>
        </li>
        @foreach($data as $item)
            @if(Route::has($item['route']))
                <li class="item {{ (request()->routeIs($item['route'])|| request()->routeIs($item['route'].'*') )? 'active' : '' }} ">
                    <a href="{{route($item['route'])}}" class="link"><span class="icon">{!! lfIcon($item['icon']) !!}</span><span class="link-title">{{$item['label']}}</span></a>
                    @if(!empty($item["children"]))
                        <ul class="children">
                            @foreach($item['children'] as $child)
                                @if(Route::has($child['route']))
                                    <li class="child {{ request()->routeIs($child['route'].'*') ? 'active' : '' }} ">
                                        <a class="link" href="{{route($child['route'])}}">
                                            <span class="icon">{!! lfIcon($child['icon']) !!}</span><span class="link-title">{{$child['label']}}</span>
                                        </a>
                                    </li>
                                @endif
                            @endforeach
                        </ul>
                    @endif
                </li>
            @endif
        @endforeach
    </ul>
</div>
