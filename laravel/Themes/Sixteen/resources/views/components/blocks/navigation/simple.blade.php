<div class="navigation-simple">
    <nav class="simple-nav">
        <!-- Basic navigation component for Sixteen theme -->
        <ul class="nav-list">
            @if(isset($items) && is_array($items))
                @foreach($items as $item)
                    <li class="nav-item">
                        @if(isset($item['url']))
                            <a href="{{ $item['url'] }}" class="nav-link">
                                {{ $item['label'] ?? 'Menu Item' }}
                            </a>
                        @else
                            <span class="nav-text">{{ $item['label'] ?? 'Menu Item' }}</span>
                        @endif
                    </li>
                @endforeach
            @else
                <li class="nav-item">
                    <a href="/" class="nav-link">Home</a>
                </li>
                <li class="nav-item">
                    <a href="/about" class="nav-link">About</a>
                </li>
                <li class="nav-item">
                    <a href="/contact" class="nav-link">Contact</a>
                </li>
            @endif
        </ul>
    </nav>
</div>