{{-- config/menu.php --}}
<ul id="main-menu" class="main-menu">
    <!-- add class "multiple-expanded" to allow multiple submenus to open -->
    <!-- class "auto-inherit-active-class" will automatically add "active" class for parent elements who are marked already with class "active" -->
    @foreach (config('menu') as $menu)
        @if (Auth::user()->hasPermission($menu['link']))
        <li>
            <a href="{{ route($menu['link']) }}">
                @if (isset($menu['icon']))<i class="{{$menu['icon']}}"></i> @endif
                <span class="title">{{ $menu['name'] }}</span>
            </a>
            @if (isset($menu['sons']))
                <ul>
                    @foreach($menu['sons'] as $sons1)
                        @if (Auth::user()->hasPermission($sons1['link']))
                            <li>
                                <a href="{{ route($sons1['link']) }}">
                                    @if (isset($sons1['icon']))<i class="{{$sons1['icon']}}"></i> @endif
                                    <span class="title">{{$sons1['name']}}</span>
                                </a>
                                @if (isset($sons1['sons']))
                                    <ul>
                                        @foreach($sons1['sons'] as $sons2)
                                            @if (Auth::user()->hasPermission($sons2['link']))
                                                <li>
                                                    <a href="{{ route($sons2['link']) }}">
                                                        @if (isset($sons2['icon']))<i class="{{$sons2['icon']}}"></i> @endif
                                                        <span class="title">{{$sons2['name']}}</span>
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
            @endif
        </li>
        @endif
    @endforeach
</ul>