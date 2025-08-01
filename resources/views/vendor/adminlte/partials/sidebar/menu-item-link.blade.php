@php
    $isLogout = isset($item['url']) && $item['url'] === 'logout';
@endphp

@if ($isLogout)
    <li class="nav-item">
        <form id="logout-form" action="{{ url($item['url']) }}" method="POST" style="display: none;">
            @csrf
        </form>
        <a class="nav-link" href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
            <i class="{{ $item['icon'] ?? 'fas fa-sign-out-alt' }}"></i>
            <p>{{ $item['text'] }}</p>
        </a>
    </li>
@else
    <li @isset($item['id']) id="{{ $item['id'] }}" @endisset class="nav-item">
        <a class="nav-link {{ $item['class'] ?? '' }} @isset($item['shift']) {{ $item['shift'] }} @endisset"
           href="{{ $item['href'] ?? url($item['url']) }}" @isset($item['target']) target="{{ $item['target'] }}" @endisset
           {!! $item['data-compiled'] ?? '' !!}>
            <i class="{{ $item['icon'] ?? 'far fa-fw fa-circle' }} {{
                isset($item['icon_color']) ? 'text-'.$item['icon_color'] : ''
            }}"></i>
            <p>
                {{ $item['text'] }}
                @isset($item['label'])
                    <span class="badge badge-{{ $item['label_color'] ?? 'primary' }} right">
                        {{ $item['label'] }}
                    </span>
                @endisset
            </p>
        </a>
    </li>
@endif
