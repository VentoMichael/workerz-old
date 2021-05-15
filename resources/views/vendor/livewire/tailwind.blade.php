@if ($paginator->hasPages())
    <nav role="navigation" aria-label="{{ __('Pagination Navigation') }}">

        <div class="container-pagination">
                <span class="pagination">
                    {{-- Previous Page Link --}}
                                            <div>

                    @if ($paginator->onFirstPage())
                                                    <span aria-disabled="true"
                                                          class="@if ($paginator->onFirstPage()) hidden @endif"
                                                          aria-label="{{ __('pagination.previous') }}">
                            <span aria-hidden="true">
                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                          d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z"
                                          clip-rule="evenodd"/>
                                </svg>
                            </span>
                        </span>
                                                @else
                                                    <a href="{{$paginator->previousPageUrl()}}#workerzLink"
                                                       wire:click="previousPage" dusk="previousPage.after" rel="prev"
                                                       aria-label="{{ __('Page précédente') }}">
                                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                      d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z"
                                      clip-rule="evenodd"/>
                            </svg>                        </a>

                                                @endif
                                                    </div>

                        <div class="container-links-pagination"
                             @if ($paginator->onFirstPage()) style="margin-left: -15px" @endif>
                                        {{-- Pagination Elements --}}
                            @foreach ($elements as $element)
                                {{-- "Three Dots" Separator --}}
                                @if (is_string($element))
                                    <span aria-disabled="true">
                                    <span
                                        class="relative inline-flex items-center px-4 py-2 -ml-px text-sm font-medium text-gray-700 bg-white border border-gray-300 cursor-default leading-5">{{ $element }}</span>
                                </span>
                                @endif
                                {{-- Array Of Links --}}
                                @if (is_array($element))
                                    @foreach ($element as $page => $url)
                                        <span wire:key="paginator-page{{ $page }}">

                                        @if ($page == $paginator->currentPage())
                                                <span
                                                    class="current_page_item-nav @if (!$paginator->hasMorePages()) last-item-pagination @endif"
                                                    aria-current="page">
                                                <span>
                                                    {{ $page }}
                                                </span>
                                            </span>
                                            @else
                                            @if($element == Request::is('announcements'))
                                                <a wire:click="gotoPage({{ $page }})" href="announcements?page={{ $page }}#adsLink"
                                                   aria-label="{{ __('Aller à la page :page', ['page' => $page]) }}">
                                                {{ $page }}</a>
                                                @else
                                                    <a wire:click="gotoPage({{ $page }})" href="workerz?page={{ $page }}#workerzLink"
                                                       aria-label="{{ __('Aller à la page :page', ['page' => $page]) }}">
                                                {{ $page }}</a>
                                                @endif
                                            @endif
                                        </span>
                                    @endforeach
                                @endif
                            @endforeach
                    </div>
                    {{-- Next Page Link --}}
                    @if ($paginator->hasMorePages())
                        <div>
                             <a href="{{ $paginator->nextPageUrl() }}#workerzLink" wire:click="nextPage" dusk="nextPage.after" rel="next" aria-label="{{ __('Page suivante') }}">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                                <path fill-rule="evenodd"
                                      d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                                      clip-rule="evenodd"/>
                            </svg>                        </a>

                    </div>
                    @endif
                </span>
        </div>
    </nav>
@endif
