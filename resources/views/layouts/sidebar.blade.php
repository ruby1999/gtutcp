<!-- Search Box -->
<section id="search" class="alt">
<form method="get" action="#">
    <input type="text" name="search" id="search" placeholder="Search..." />
</form>
</section>

<!-- Menu -->
<nav id="menu">
    <ul>
        @foreach ($datas as $key => $item)
        
        {{-- 如果只有一層 --}}
            @if (!isset($item->subCategories))
                <li><a href="http://gtutcp.com/{{ $item->slug }}">{{ $item->name }}</a></li>
            @else
                {{-- 如果有兩層的話 --}}
                <li>
                    <span class="opener">{{ $item->name }}</span>
                    <ul>
                        @foreach ($item->subCategories as $subItem)
                            @if (!isset($subItem->childCategories))
                                <li><a href="http://gtutcp.com/{{ $subItem->slug }}">{{ $subItem->name }}</a></li>
                            @endif
                        @endforeach
                    </ul>
                </li>
            @endif
        @endforeach
    </ul>
</nav>

<!-- Footer -->
<footer id="footer">
    <p class="copyright">Copyright &copy; 2020 GTUT
    <br>Designed by <a rel="nofollow" href="https://www.facebook.com/Iamgtut/">GTUT</a></p>
</footer>
