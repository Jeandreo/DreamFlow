@unless ($breadcrumbs->isEmpty())
    <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 my-0 pt-1 justify-content-center">
        @foreach ($breadcrumbs as $breadcrumb)
            @if (!is_null($breadcrumb->url) && !$loop->last)
                <li class="breadcrumb-item">
                    <a href="{{ $breadcrumb->url }}" class="text-muted text-hover-primary">{{ $breadcrumb->title }}</a>
                </li>
                <span class="text-gray-200 ms-2 opacity-50">
                    /
                </span>
            @else
                <li class="breadcrumb-item text-muted">{{ $breadcrumb->title }}</li>
            @endif
        @endforeach
    </ul>
    @endunless