@if ($breadcrumbs->isNotEmpty())
    <ol class="breadcrumbs">
        @foreach ($breadcrumbs as $breadcrumb)
            <li class="breadcrumbs__item">
                @if (! $breadcrumb->url || $loop->last)
                    {{ $breadcrumb->label }}
                @else
                    <a href="{{ $breadcrumb->url }}" class="breadcrumbs__link">
                        {{ $breadcrumb->label }}
                    </a>
                @endif
            </li>
        @endforeach
    </ol>
@endif