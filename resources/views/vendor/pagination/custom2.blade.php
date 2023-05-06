<style>
    /* GENERAL STYLES */
    :root {
        --main-color: #0E9E4D;
        --font-color: #424248;
        --hover-color: #208f50;
    }

    .pagination {
        padding: 30px 0;
        text-align: center;
    }

    .pagination ul li {
        display: inline-block;
        border: 0.5px solid var(--hover-color);
        border-radius: 5px;
    }

    .pagination a {
        text-decoration: none;
        display: inline-block;
        padding: 10px 18px;
        color: black;
        transition: 0.3s;
    }

    .pagination ul li:hover a {
        background-color: var(--hover-color);
        color: white;
        cursor: pointer;
    }


    .is-active,
    .disabled {
        background-color: var(--main-color);
        color: #ffff;
        font-weight: bold;
    }
</style>
@if ($paginator->hasPages())
<div class="pagination">
    <ul>
        @if ($paginator->onFirstPage())
        <li class="disabled">
            <a href="#" tabindex="-1"><i class="fa-solid fa-arrow-left"></i></a>
        </li>
        @else
        <li><a href="{{ $paginator->previousPageUrl() }}"><i class="fa-solid fa-arrow-left"></i></a></li>
        @endif

        @foreach ($elements as $element)
        @if (is_string($element))
        <li class="disabled">{{ $element }}</li>
        @endif
        @if (is_array($element))
        @foreach ($element as $page => $url)
        @if ($page == $paginator->currentPage())
        <li class="is-active">
            <a>{{ $page }}</a>
        </li>
        @else
        <li>
            <a href="{{ $url }}">{{ $page }}</a>
        </li>
        @endif
        @endforeach
        @endif
        @endforeach

        @if ($paginator->hasMorePages())
        <li>
            <a href="{{ $paginator->nextPageUrl() }}" rel="next"><i class="fa-solid fa-arrow-right"></i></a>
        </li>
        @else
        <li class="disabled">
            <a href="#"><i class="fa-solid fa-arrow-right"></i></a>
        </li>
        @endif
    </ul>
</div>
@endif