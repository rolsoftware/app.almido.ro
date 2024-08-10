@foreach($childs as $child)

    @can($child['permissions'])
        <li>
            <a
                href="{{ $child['url'] }}"
                class="@if(request()->is(trim($child['url'], '/'))) active @endif"
                key="{{ $child['slug'] }}"
                @if(isset($child['target'])) target="{{ $child['target'] }}" @endif>
                <i class="{{ $child['icon'] }}"></i>{{ $child['name'] }}
            </a>
        </li>
    @endcan

@endforeach
