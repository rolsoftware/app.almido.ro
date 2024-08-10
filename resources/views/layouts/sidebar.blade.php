
<div class="vertical-menu">
    <div data-simplebar class="h-100">
        <div id="sidebar-menu">
            <ul class="metismenu list-unstyled" id="side-menu">
                @forelse ($menu_items as $key => $menus)
                    <li class="menu-title" key="t-menu">{{ $key }}</li>
                    @foreach ($menus as $menu)
                        @can($menu['permissions'])
                            @php  $isActive = false; @endphp

                            <li class="@if($isActive) mm-active @endif">
                                <a href="{{ !empty($menu['subitems']) ? "#" : $menu['url'] }}" 
                                class="{{ !empty($menu['subitems']) ? 'has-arrow' :'' }} waves-effect">
                                    <i class="{{ $menu['icon'] }}"></i><span key="t-{{ str_replace('','-',$menu['name']) }}">{{ $menu['name'] }}</span>
                                </a>
                                @if(!empty($menu['subitems']))
                                    <ul class="sub-menu" aria-expanded="false">
                                        @include('layouts.menusub',['childs' => $menu['subitems']])
                                    </ul>
                                @endif
                            </li>

                        @endcan
                    @endforeach
                @empty
                    
                @endforelse
            </ul>
        </div>
    </div>
</div>

