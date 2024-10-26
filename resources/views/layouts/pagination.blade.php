<footer class="pb-3 w-100 v-md-center px-4 d-flex flex-wrap" style="position: relative;">
    <div class="col-auto me-auto">
        @if(isset($columns) && \Orchid\Screen\TD::isShowVisibleColumns($columns))
            <div class="btn-group dropup d-inline-block">
                <button type="button"
                        class="btn btn-sm btn-link dropdown-toggle p-0 m-0"
                        data-bs-toggle="dropdown"
                        aria-haspopup="true"
                        data-bs-boundary="viewport"
                        aria-expanded="false">
                    {{ __('Configure columns') }}
                </button>
                <div class="dropdown-menu dropdown-column-menu dropdown-scrollable">
                    @foreach($columns as $column)
                        {!! $column->buildItemMenu() !!}
                    @endforeach
                </div>
            </div>
        @endif

        @if($paginator instanceof \Illuminate\Contracts\Pagination\LengthAwarePaginator)
            <small class="text-muted d-block">
                {{ __('Displayed records: :from-:to of :total',[
                    'from' => ($paginator->currentPage() -1 ) * $paginator->perPage() + 1,
                    'to' => ($paginator->currentPage() -1 ) * $paginator->perPage() + count($paginator->items()),
                    'total' => $paginator->total(),
                ]) }}
            </small>
        @endif
    </div>

    <div class="col-auto flex-shrink-1 mt-3 mt-sm-0 d-flex align-items-center">
        <div class="me-2">
            @if($paginator instanceof \Illuminate\Contracts\Pagination\CursorPaginator)
                {!!
                    $paginator->appends(request()
                        ->except(['page','_token']))
                        ->links('platform::partials.pagination')
                !!}
            @elseif($paginator instanceof \Illuminate\Contracts\Pagination\Paginator)
                {!!
                    $paginator->appends(request()
                        ->except(['page','_token']))
                        ->onEachSide($onEachSide ?? 3)
                        ->links('platform::partials.pagination')
                !!}
            @endif
        </div>

        <!-- Dropdown for items per page -->
        <div class="dropdown" style="z-index: 1050;">
            <button class="btn btn-sm btn-link dropdown-toggle" type="button" id="itemsPerPageDropdown" data-bs-toggle="dropdown" aria-expanded="false" data-bs-boundary="viewport">
                {{ request('pp_page', 25) }} {{ config('platform-pp.label') }}
            </button>
            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="itemsPerPageDropdown">
                @foreach(config('platform-pp.options') as $perPageOption)
                    <li>
                        <a class="dropdown-item {{ request('pp_page') == $perPageOption ? 'active' : '' }}"
                           href="{{ request()->fullUrlWithQuery(['pp_page' => $perPageOption]) }}">
                            {{ $perPageOption }} {{ __('per page') }}
                        </a>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>
</footer>
