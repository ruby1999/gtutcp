<!-- Search Box -->
<section id="search" class="alt">
<form method="get" action="#">
    <input type="text" name="search" id="search" placeholder="Search..." />
</form>
</section>

<!-- Menu -->
{{-- START OF 神奇的三層  --}}
<nav id="menu">
    <ul>
        @foreach ($datas as $key => $item)
        
        {{-- 如果只有一層 --}}
            @if (!isset($item->subCategories))
                <li><a href="{{ $item->slug }}">{{ $item->name }}</a></li>    
            @else
                {{-- 如果有兩層的話 --}}
                <li>
                    <span class="opener">{{ $item->name }}</span>
                    <ul>
                        @foreach ($item->subCategories as $subItem)
                            @if (!isset($subItem->childCategories))
                                <li><a href="#">{{ $subItem->name }}</a></li>
                            @endif
                        @endforeach
                    </ul>
                </li>
            @endif
        @endforeach
    </ul>
</nav>
{{-- END OF 神奇的三層  --}}

<!-- Footer -->
<footer id="footer">
    <p class="copyright">Copyright &copy; 2020 GTUT
    <br>Designed by <a rel="nofollow" href="https://www.facebook.com/Iamgtut/">GTUT</a></p>
</footer>

