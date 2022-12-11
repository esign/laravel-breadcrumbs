@if ($breadcrumbs->isNotEmpty())
    <ol class="breadcrumbs">
        @foreach ($breadcrumbs as $breadcrumb)
            <li class="breadcrumbs__item">
                @if ($breadcrumb->url)
                    <a href="{{ $breadcrumb->url }}" class="breadcrumbs__link">
                        {{ $breadcrumb->label }}
                    </a>
                @else
                    {{ $breadcrumb->label }}
                @endif
            </li>
        @endforeach
    </ol>
@endif