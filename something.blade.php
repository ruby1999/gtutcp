{{-- START OF 神奇的三層  --}}
<div class="collapse navbar-collapse" id="navbarResponsive">
    <ul class="navbar-nav ml-auto">
        @foreach ($datas as $key => $item)
        {{-- 如果只有一層 --}}
            @if (!isset($item->subCategories))
                <li class="nav-item">
                    <a class="nav-link" href="{{ $subItem->slug }}">{{ $item->name }}
                    <span class="sr-only"></span>
                    </a>
                </li> 
            @else
                {{-- 如果有兩層的話 --}}
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">{{ $item->name }}</a>
                    <div class="dropdown-menu">
                        @foreach ($item->subCategories as $subItem)
                            @if (!isset($subItem->childCategories))
                                <a class="dropdown-item" href="#">{{ $subItem->name }}
                            @else
                                {{-- 如果有三層的話 --}}
                                {{-- <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="false">{{ $subItem->name }}</a> --}}
                                <button class="dropdown-item dropdown-toggle" type="button" data-toggle="dropdown">{{ $subItem->name }}</button>
                                <div class="dropdown-menu">
                                    @foreach ($subItem->childCategories as $childItem)
                                    {{-- <button class="dropdown-item" type="button">第三層</button> --}}
                                    <button class="dropdown-item" type="button">{{ $childItem->name }} </button>
                                    @endforeach
                                </div>
                            @endif
                        @endforeach
                    </div>
                </li>
            @endif
        @endforeach
    </ul>
</div>
{{-- END OF 神奇的三層  --}}