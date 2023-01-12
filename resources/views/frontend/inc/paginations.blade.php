<nav aria-label="Page navigation example">
    <ul class="pagination  mb-0">
        <li class="page-item {{ ($paginators->currentPage() == 1) ? ' disabled' : '' }}">
            <a class="page-link mx-1 rounded" href="{{ $paginators->url(1) }}" tabindex="-1" aria-disabled="true">
                <i class="mdi mdi-chevron-left"></i>
            </a>
        </li>
        @for ($i = 1; $i <= $paginators->lastPage(); $i++)
            <li class="page-item {{ ($paginators->currentPage() == $i) ? ' active' : '' }}">
                <a class="page-link mx-1 rounded" href="{{ $paginators->url($i) }}"> {{ $i }}</a>
            </li>
        @endfor
        <li class="page-item {{ ($paginators->currentPage() == $paginators->lastPage()) ? ' disabled' : '' }}">
            <a class="page-link mx-1 rounded" href="{{  $paginators->url($paginators->currentPage()+1) }}">
                <i class="mdi mdi-chevron-right"></i>
            </a>
        </li>
    </ul>
</nav>
