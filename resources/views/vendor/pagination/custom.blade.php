@if ($paginator->hasPages())
<nav>
    <ul class="pagination">
        {{-- Nút Previous --}}
        @if ($paginator->onFirstPage())
        <li class="disabled" aria-disabled="true" aria-label="@lang('pagination.previous')">
            <span aria-hidden="true">&lsaquo;</span>
        </li>
        @else
        <li>
            <a href="{{ $paginator->previousPageUrl() }}" rel="prev" aria-label="@lang('pagination.previous')">&lsaquo;</a>
        </li>
        @endif

        {{-- Các nút số trang --}}
        @foreach ($elements as $element)
        {{-- Dấu "..." --}}
        @if (is_string($element))
        <li class="disabled" aria-disabled="true"><span>{{ $element }}</span></li>
        @endif

        {{-- Số trang --}}
        @if (is_array($element))
        @foreach ($element as $page => $url)
        @if ($page == $paginator->currentPage())
        <li class="active" aria-current="page"><span>{{ $page }}</span></li>
        @else
        <li><a href="{{ $url }}">{{ $page }}</a></li>
        @endif
        @endforeach
        @endif
        @endforeach

        {{-- Nút Next --}}
        @if ($paginator->hasMorePages())
        <li>
            <a href="{{ $paginator->nextPageUrl() }}" rel="next" aria-label="@lang('pagination.next')">&rsaquo;</a>
        </li>
        @else
        <li class="disabled" aria-disabled="true" aria-label="@lang('pagination.next')">
            <span aria-hidden="true">&rsaquo;</span>
        </li>
        @endif
    </ul>


    {{-- Thêm nút "Đến Trang" --}}
    <!-- <form action="{{ request()->url() }}" method="GET" class="go-to-page">
        <label for="page">Đến trang:</label>
        <input type="number" name="page" id="page" min="1" max="{{ $paginator->lastPage() }}" value="{{ $paginator->currentPage() }}">
        <button type="submit">Đi</button>
    </form> -->
</nav>
@endif