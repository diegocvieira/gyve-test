@if ($paginator->lastPage() > 1)
    <ul class="pagination" style="margin: 50px 0; text-align: center;">
        @if ($paginator->currentPage() > 1)
            <li class="waves-effect">
                <a href="{{ $paginator->appends(request()->query())->previousPageUrl() }}">
                    <i class="material-icons">chevron_left</i>
                </a>
            </li>
        @else
            <li class="disabled">
                <a href="#!">
                    <i class="material-icons">chevron_left</i>
                </a>
            </li>
        @endif

        <li class="teal lighten-4">
            <a href="#!">{{ $paginator->currentPage() }}</a>
        </li>

        @if ($paginator->currentPage() < $paginator->lastPage())
            <li class="waves-effect">
                <a href="{{ $paginator->appends(request()->query())->nextPageUrl() }}">
                    <i class="material-icons">chevron_right</i>
                </a>
            </li>
        @else
            <li class="disabled">
                <a href="#!">
                    <i class="material-icons">chevron_right</i>
                </a>
            </li>
        @endif
    </ul>
@endif
