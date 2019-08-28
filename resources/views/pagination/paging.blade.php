@if (!$paginator->count())
    <?php
    header("Refresh:0; url=" . $paginator->url(1));
    ?>
@endif
@if ($paginator->hasPages())
    <?php
    $newElements = App\Helpers\PaginationHelper::elements($paginator->currentPage(), $paginator->lastPage());
    ?>
    <nav class="pager-basic">
        @if (!$paginator->onFirstPage())
            <a class="pager-basic__item is-prev-button" href="{{ $paginator->previousPageUrl() }}">Prev</a>
        @endif
        @foreach ($newElements as $element)
            @if (is_string($element))
                <span class="pager-basic__sep">{{ $element }}</span>
            @endif
            @if (is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                        <span class="pager-basic__item is-current u-wd40">{{ $page }}</span>
                    @else
                        <a class="pager-basic__item u-wd40" href="{{ $paginator->url($page) }}">{{ $page }}</a>
                    @endif
                @endforeach
            @endif
        @endforeach
        @if ($paginator->hasMorePages())
            <a class="pager-basic__item is-next-button" href="{{ $paginator->nextPageUrl() }}">Next</a>
        @endif
    </nav>
@endif
