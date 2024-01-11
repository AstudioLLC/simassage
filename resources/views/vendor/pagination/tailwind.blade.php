{{--@if ($paginator->hasPages())
    <nav role="navigation" aria-label="{{ __('Pagination Navigation') }}" class="my-3 flex items-center justify-between">
        --}}{{--<div class="flex justify-end flex-1 sm:hidden">
            @if ($paginator->onFirstPage())
                <span class="relative inline-flex items-center px-2 py-2 text-sm font-medium text-gray-500 bg-gray mr-2 hover:text-gray-400 focus:z-10 focus:outline-none focus:border-blue-300 focus:shadow-outline-blue active:bg-gray-100 active:text-gray-500 transition ease-in-out duration-150">
                    {!! __('pagination.previous') !!}

                     <svg xmlns="http://www.w3.org/2000/svg" width="14.815" height="10.416" viewBox="0 0 14.815 10.416">
                         <path id="_001-left-arrow" data-name="001-left-arrow" d="M4.832,4.833a.525.525,0,0,1,.747.739L1.793,9.357H14.285a.526.526,0,0,1,.53.523.532.532,0,0,1-.53.53H1.793l3.785,3.779a.536.536,0,0,1,0,.747.523.523,0,0,1-.747,0L.151,10.254a.527.527,0,0,1,0-.739Z" transform="translate(0.001 -4.676)" fill="#162e44"/>
                    </svg>
                </span>
            @else
                <a href="{{ $paginator->previousPageUrl() }}" class="page-link relative inline-flex items-center px-2 py-2 text-sm font-medium text-gray-500 bg-gray mr-2 hover:text-gray-400 focus:z-10 focus:outline-none focus:border-blue-300 focus:shadow-outline-blue active:bg-gray-100 active:text-gray-500 transition ease-in-out duration-150">
                    {!! __('pagination.previous') !!}

                    <svg xmlns="http://www.w3.org/2000/svg" width="14.815" height="10.416" viewBox="0 0 14.815 10.416">
                        <path id="_001-left-arrow" data-name="001-left-arrow" d="M4.832,4.833a.525.525,0,0,1,.747.739L1.793,9.357H14.285a.526.526,0,0,1,.53.523.532.532,0,0,1-.53.53H1.793l3.785,3.779a.536.536,0,0,1,0,.747.523.523,0,0,1-.747,0L.151,10.254a.527.527,0,0,1,0-.739Z" transform="translate(0.001 -4.676)" fill="#162e44"/>
                    </svg>
                </a>
            @endif

            @if ($paginator->hasMorePages())
                <a href="{{ $paginator->nextPageUrl() }}" class="page-link relative inline-flex items-center px-2 py-2 text-sm font-medium text-gray-500 bg-gray mr-2 hover:text-gray-400 focus:z-10 focus:outline-none focus:border-blue-300 focus:shadow-outline-blue active:bg-gray-100 active:text-gray-500 transition ease-in-out duration-150">
                    {!! __('pagination.next') !!}

                    <svg xmlns="http://www.w3.org/2000/svg" width="14.815" height="10.416" viewBox="0 0 14.815 10.416">
                        <path d="M9.982,4.833a.525.525,0,0,0-.747.739L13.02,9.357H.529A.526.526,0,0,0,0,9.88a.532.532,0,0,0,.53.53H13.02L9.235,14.189a.536.536,0,0,0,0,.747.523.523,0,0,0,.747,0l4.681-4.682a.527.527,0,0,0,0-.739Z" transform="translate(0.001 -4.676)" fill="#162e44"/>
                    </svg>
                </a>
            @else
                <span class="relative inline-flex items-center px-2 py-2 text-sm font-medium text-gray-500 bg-gray mr-2 hover:text-gray-400 focus:z-10 focus:outline-none focus:border-blue-300 focus:shadow-outline-blue active:bg-gray-100 active:text-gray-500 transition ease-in-out duration-150">
                    {!! __('pagination.next') !!}

                     <svg xmlns="http://www.w3.org/2000/svg" width="14.815" height="10.416" viewBox="0 0 14.815 10.416">
                        <path d="M9.982,4.833a.525.525,0,0,0-.747.739L13.02,9.357H.529A.526.526,0,0,0,0,9.88a.532.532,0,0,0,.53.53H13.02L9.235,14.189a.536.536,0,0,0,0,.747.523.523,0,0,0,.747,0l4.681-4.682a.527.527,0,0,0,0-.739Z" transform="translate(0.001 -4.676)" fill="#162e44"/>
                    </svg>
                </span>
            @endif
        </div>--}}{{--

        <div class="hidden sm:flex-1 sm:flex sm:items-center sm:justify-end mt-3">
            <div>
                <span class="relative z-0 inline-flex shadow-sm rounded-md">
--}}{{-- Previous Page Link--}}{{--

                    @if ($paginator->onFirstPage())
                        <span aria-disabled="true"  class="flex" aria-label="{{ __('pagination.previous') }}">
                            <span class="relative inline-flex items-center px-2 py-2 text-sm mr-2 font-medium text-gray-500 bg-gray  cursor-default " aria-hidden="true">
                                 <svg xmlns="http://www.w3.org/2000/svg" width="14.815" height="10.416" viewBox="0 0 14.815 10.416">
                              <path  d="M4.832,4.833a.525.525,0,0,1,.747.739L1.793,9.357H14.285a.526.526,0,0,1,.53.523.532.532,0,0,1-.53.53H1.793l3.785,3.779a.536.536,0,0,1,0,.747.523.523,0,0,1-.747,0L.151,10.254a.527.527,0,0,1,0-.739Z" transform="translate(0.001 -4.676)" fill="#162e44"/>
                            </svg>
                            </span>
                        </span>
                    @else
                        <a href="{{ $paginator->previousPageUrl() }}" rel="prev" class="page-link relative inline-flex items-center px-2 py-2 text-sm font-medium text-gray-500 bg-gray mr-2 hover:text-gray-400 focus:z-10 focus:outline-none focus:border-blue-300 focus:shadow-outline-blue active:bg-gray-100 active:text-gray-500 transition ease-in-out duration-150" aria-label="{{ __('pagination.previous') }}">
                           <svg xmlns="http://www.w3.org/2000/svg" width="14.815" height="10.416" viewBox="0 0 14.815 10.416">
                              <path d="M4.832,4.833a.525.525,0,0,1,.747.739L1.793,9.357H14.285a.526.526,0,0,1,.53.523.532.532,0,0,1-.53.53H1.793l3.785,3.779a.536.536,0,0,1,0,.747.523.523,0,0,1-.747,0L.151,10.254a.527.527,0,0,1,0-.739Z" transform="translate(0.001 -4.676)" fill="#162e44"/>
                            </svg>
                        </a>
                    @endif

 --}}{{--Pagination Elements--}}{{--

                    @foreach ($elements as $element)
 --}}{{--"Three Dots" Separator--}}{{--

                        @if (is_string($element))
                            <span aria-disabled="true">
                                <span class="relative inline-flex items-center px-4 py-2 -ml-px text-sm font-medium text-gray-700 bg-white border border-gray-300 cursor-default leading-5">{{ $element }}</span>
                            </span>
                        @endif

--}}{{-- Array Of Links--}}{{--

                        @if (is_array($element))
                            @foreach ($element as $page => $url)
                                @if ($page == $paginator->currentPage())
                                    <span aria-current="page" class=" mr-2 ">
                                        <span class="relative inline-flex items-center px-4 py-2 -ml-px text-sm font-medium text-gray-500 bg-blue text-white cursor-default leading-5">{{ $page }}</span>
                                    </span>
                                @else
                                    <a href="{{ $url }}" data-page="{{ $page }}" class="page-link mr-2  relative inline-flex items-center px-4 py-2 -ml-px text-sm font-medium text-blue-dark bg-gray  leading-5 hover:text-gray-500 focus:z-10 focus:outline-none focus:border-blue-300 focus:shadow-outline-blue active:bg-blue active:text-white transition ease-in-out duration-150" aria-label="{{ __('Go to page :page', ['page' => $page]) }}">
                                        {{ $page }}
                                    </a>
                                @endif
                            @endforeach
                        @endif
                    @endforeach

 --}}{{--Next Page Link--}}{{--

                    @if ($paginator->hasMorePages())
                        <a href="{{ $paginator->nextPageUrl() }}" rel="next" class="page-link relative inline-flex items-center px-2 py-2 -ml-px text-sm font-medium text-gray-500 bg-gray hover:text-gray-400 focus:z-10 focus:outline-none focus:bg-blue  active:bg-gray-100 active:text-gray-500 transition ease-in-out duration-150" aria-label="{{ __('pagination.next') }}">
                             <svg xmlns="http://www.w3.org/2000/svg" width="14.815" height="10.416" viewBox="0 0 14.815 10.416">
                                 <path d="M9.982,4.833a.525.525,0,0,0-.747.739L13.02,9.357H.529A.526.526,0,0,0,0,9.88a.532.532,0,0,0,.53.53H13.02L9.235,14.189a.536.536,0,0,0,0,.747.523.523,0,0,0,.747,0l4.681-4.682a.527.527,0,0,0,0-.739Z" transform="translate(0.001 -4.676)" fill="#162e44"/>
                             </svg>
                        </a>
                    @else
                        <span aria-disabled="true" class="flex" aria-label="{{ __('pagination.next') }}">
                            <span class="relative inline-flex items-center px-2 py-2 text-sm font-medium text-gray-500 bg-gray mr-2 hover:text-gray-400 focus:z-10 focus:outline-none focus:border-blue-300 focus:shadow-outline-blue active:bg-gray-100 active:text-gray-500 transition ease-in-out duration-150" aria-hidden="true">
                                <svg xmlns="http://www.w3.org/2000/svg" width="14.815" height="10.416" viewBox="0 0 14.815 10.416">
                                      <path  d="M9.982,4.833a.525.525,0,0,0-.747.739L13.02,9.357H.529A.526.526,0,0,0,0,9.88a.532.532,0,0,0,.53.53H13.02L9.235,14.189a.536.536,0,0,0,0,.747.523.523,0,0,0,.747,0l4.681-4.682a.527.527,0,0,0,0-.739Z" transform="translate(0.001 -4.676)" fill="#162e44"/>
                                </svg>
                            </span>
                        </span>
                    @endif
                </span>
            </div>
        </div>
    </nav>
@endif--}}

@push('css')
    <style>
        .pagination {
            display: flex;
            align-items: center;
            margin: 20px 0 0;
            font-size: 0;
            text-align: center;
        }

        .pagination a {
            width: 34px;
            height: 34px;
            text-decoration: none;
            color: #000;
            font-size: 17px;
            display: inline-block;
            font-weight: 700;
        }

        .pagination > a {
            border-radius: 6px;
            border: 1px solid #E4E4E9;
        }

        .pagination a:hover {
            text-decoration: underline;
        }
        .pagination ol {
            list-style-type: none;
            padding: 0;
            margin: 0;
            display: inline-block;
        }
        .pagination li {
            display: inline-block;
            margin: 0 2.5px;
        }
        .pagination li.active a {
            color: #F86A04;
            border-bottom: 1px solid #F86A04;

        }
        .pagination li.active a:hover {
            text-decoration: none;
            cursor: default;
        }
        .pagination .prev.disabled, .pagination .next.disabled {
            cursor: default;
            border-color: #888;
        }
        .pagination .prev.disabled:hover, .pagination .next.disabled:hover {
            cursor: default;
            text-decoration: none;
        }
        .pagination .prev {
            margin-right: 2.5px;
        }
        .pagination .next {
            margin-left: 2.5px;
        }
        @media (max-width: 767px) {
            .pagination li:first-child, .pagination li.active, .pagination li.active-sibling:nth-last-child(2), .pagination li:last-child {
                display: inline-block !important;
            }
            .pagination li:first-child:nth-last-child(n+6) ~ li {
                display: none;
            }
            .pagination li:first-child:nth-last-child(n+6) ~ li:nth-last-child(-n + 3) {
                display: inline-block;
            }
            .pagination li:first-child:nth-last-child(n+6) ~ li:nth-last-child(3):before {
                content: "\2026";
                font-size: 24px;
                display: inline-block;
                margin-right: 2.5px;
            }
            .pagination li:first-child:nth-last-child(n+6).active:before, .pagination li:first-child:nth-last-child(n+6) ~ li.active:before {
                content: "\2026";
                font-size: 24px;
                display: inline-block;
                margin-right: 2.5px;
            }
            .pagination li:first-child:nth-last-child(n+6).active:after, .pagination li:first-child:nth-last-child(n+6) ~ li.active:after {
                content: "\2026";
                font-size: 24px;
                display: inline-block;
                margin-left: 2.5px;
            }
            .pagination li:first-child:nth-last-child(n+6).active:nth-child(-n + 2):before, .pagination li:first-child:nth-last-child(n+6) ~ li.active:nth-child(-n + 2):before, .pagination li:first-child:nth-last-child(n+6).active:nth-last-child(-n + 2):before, .pagination li:first-child:nth-last-child(n+6) ~ li.active:nth-last-child(-n + 2):before, .pagination li:first-child:nth-last-child(n+6).active:nth-child(-n + 2):after, .pagination li:first-child:nth-last-child(n+6) ~ li.active:nth-child(-n + 2):after, .pagination li:first-child:nth-last-child(n+6).active:nth-last-child(-n + 2):after, .pagination li:first-child:nth-last-child(n+6) ~ li.active:nth-last-child(-n + 2):after {
                display: none;
            }
            .pagination li:first-child:nth-last-child(n+6).active ~ li:nth-last-child(-n + 3), .pagination li:first-child:nth-last-child(n+6) ~ li.active ~ li:nth-last-child(-n + 3) {
                display: none;
            }
            .pagination li:first-child:nth-last-child(n+6).active ~ li:nth-child(-n + 3), .pagination li:first-child:nth-last-child(n+6) ~ li.active ~ li:nth-child(-n + 3) {
                display: inline-block;
            }
            .pagination li:first-child:nth-last-child(n+6).active ~ li:nth-child(-n + 2):after, .pagination li:first-child:nth-last-child(n+6) ~ li.active ~ li:nth-child(-n + 2):after {
                display: none;
            }
            .pagination li:first-child:nth-last-child(n+6).active ~ li:nth-child(3):after, .pagination li:first-child:nth-last-child(n+6) ~ li.active ~ li:nth-child(3):after {
                content: "\2026";
                font-size: 24px;
                display: inline-block;
                margin-left: 2.5px;
            }
        }
        @media (min-width: 768px) {
            .pagination li:first-child, .pagination li.active-sibling, .pagination li.active, .pagination li.active + li, .pagination li:last-child {
                display: inline-block !important;
            }
            .pagination li:first-child:nth-last-child(n+8) ~ li {
                display: none;
            }
            .pagination li:first-child:nth-last-child(n+8) ~ li.active-sibling:before {
                content: "\2026";
                font-size: 24px;
                display: inline-block;
                margin-right: 2.5px;
            }
            .pagination li:first-child:nth-last-child(n+8) ~ li.active + li:after {
                content: "\2026";
                font-size: 24px;
                display: inline-block;
                margin-left: 2.5px;
            }
            .pagination li:first-child:nth-last-child(n+8) ~ li:nth-last-child(-n + 5) {
                display: inline-block;
            }
            .pagination li:first-child:nth-last-child(n+8) ~ li:nth-last-child(5):before {
                content: "\2026";
                font-size: 24px;
                display: inline-block;
                margin-right: 2.5px;
            }
            .pagination li:first-child:nth-last-child(n+8) ~ li:nth-child(-n + 2):before, .pagination li:first-child:nth-last-child(n+8) ~ li:nth-last-child(-n + 2):before, .pagination li:first-child:nth-last-child(n+8) ~ li.active-sibling:nth-last-child(-n + 4):before, .pagination li:first-child:nth-last-child(n+8) ~ li:nth-child(-n + 2):after,.pagination li:first-child:nth-last-child(n+8) ~ li:nth-last-child(-n + 2):after, .pagination li:first-child:nth-last-child(n+8) ~ li.active-sibling:nth-last-child(-n + 4):after {
                display: none !important;
            }
            .pagination li:first-child:nth-last-child(n+8).active ~ li:nth-last-child(-n + 5), .pagination li:first-child:nth-last-child(n+8) ~ li.active ~ li:nth-last-child(-n + 5) {
                display: none;
            }
            .pagination li:first-child:nth-last-child(n+8).active ~ li:nth-last-child(-n + 5):before, .pagination li:first-child:nth-last-child(n+8) ~ li.active ~ li:nth-last-child(-n + 5):before {
                display: none;
            }
            .pagination li:first-child:nth-last-child(n+8).active ~ li:nth-child(-n + 5), .pagination li:first-child:nth-last-child(n+8) ~ li.active ~ li:nth-child(-n + 5) {
                display: inline-block;
            }
            .pagination li:first-child:nth-last-child(n+8).active ~ li:nth-child(-n + 4):after, .pagination li:first-child:nth-last-child(n+8) ~ li.active ~ li:nth-child(-n + 4):after {
                display: none;
            }
            .pagination li:first-child:nth-last-child(n+8).active ~ li:nth-child(5):after, .pagination li:first-child:nth-last-child(n+8) ~ li.active ~ li:nth-child(5):after {
                content: "\2026";
                font-size: 24px;
                display: inline-block;
                margin-left: 2.5px;
            }
            .pagination li:first-child:nth-last-child(n+8).active:before, .pagination  li:first-child:nth-last-child(n+8) ~ li.active:before, .pagination li:first-child:nth-last-child(n+8).active:after, .pagination li:first-child:nth-last-child(n+8) ~ li.active:after {
                display: none;
            }
        }

    </style>
@endpush

@push('js')
    <script>
        $(document).ready(function() {
            var CLASS_DISABLED = "disabled",
                CLASS_ACTIVE = "active",
                CLASS_SIBLING_ACTIVE = "active-sibling",
                DATA_KEY = "pagination";

            $(".pagination").each(initPagination);

            function initPagination() {
                var $this = $(this);

                $this.data(DATA_KEY, $this.find("li").index(".active"));

                $this.find(".prev").on("click", navigateSinglePage);
                $this.find(".next").on("click", navigateSinglePage);
                $this.find("li").on("click", function() {
                    var $parent = $(this).closest(".pagination");
                    $parent.data(DATA_KEY, $parent.find("li").index(this));
                    changePage.apply($parent);
                });
            }

            function navigateSinglePage() {
                if(!$(this).hasClass(CLASS_DISABLED)) {
                    var $parent = $(this).closest(".pagination"),
                        currActive = parseInt($parent.data("pagination"), 10);

                    currActive += 1 * ($(this).hasClass("prev") ? -1 : 1);
                    $parent.data(DATA_KEY, currActive);

                    changePage.apply($parent);
                }
            }

            function changePage(currActive) {
                var $list = $(this).find("li"),
                    currActive = parseInt($(this).data(DATA_KEY), 10);

                $list.filter("."+CLASS_ACTIVE).removeClass(CLASS_ACTIVE);
                $list.filter("."+CLASS_SIBLING_ACTIVE).removeClass(CLASS_SIBLING_ACTIVE);

                $list.eq(currActive).addClass(CLASS_ACTIVE);

                if(currActive === 0) {
                    $(this).find(".prev").addClass(CLASS_DISABLED);
                } else {
                    $list.eq(currActive-1).addClass(CLASS_SIBLING_ACTIVE);
                    $(this).find(".prev").removeClass(CLASS_DISABLED);
                }

                if(currActive == ($list.length - 1)) {
                    $(this).find(".next").addClass(CLASS_DISABLED);
                } else {
                    $(this).find(".next").removeClass(CLASS_DISABLED);
                }
            }
        });
    </script>
@endpush




<div class="pagination-wrap">
    <div class="pagination">
        <a href="{{ $paginator->previousPageUrl() }}" class="prev disabled">
            <svg xmlns="http://www.w3.org/2000/svg" width="7" height="11" viewBox="0 0 7 11">
                <g transform="translate(104.141 -0.001) rotate(90)">
                    <path d="M5.5,104.141a.73.73,0,0,1-.545-.252l-4.73-5.28a.932.932,0,0,1,0-1.216.715.715,0,0,1,1.089,0L5.5,102.065l4.185-4.672a.715.715,0,0,1,1.089,0,.932.932,0,0,1,0,1.216l-4.73,5.28A.729.729,0,0,1,5.5,104.141Z" transform="translate(0)" fill="#104aa0"/>
                </g>
            </svg>
        </a>
        <ol>
            @foreach ($elements as $element)
                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        <li class="{{ $page == $paginator->currentPage() ? 'active' : null }}">
                            <a href="{{ $page == $paginator->currentPage() ? 'javascript:void(0)' : $url }}">
                                {{ $page }}
                            </a>
                        </li>
                    @endforeach
                @endif
            @endforeach
        </ol>
        <a href="{{ $paginator->nextPageUrl() }}" class="next">
            <svg xmlns="http://www.w3.org/2000/svg" width="7" height="11" viewBox="0 0 7 11">
                <g transform="translate(7) rotate(90)">
                    <path d="M5.5,0a.73.73,0,0,0-.545.252L.226,5.532a.932.932,0,0,0,0,1.216.715.715,0,0,0,1.089,0L5.5,2.076,9.685,6.748a.715.715,0,0,0,1.089,0,.932.932,0,0,0,0-1.216L6.045.252A.729.729,0,0,0,5.5,0Z" fill="#104aa0"/>
                </g>
            </svg>
        </a>
    </div>
</div>



{{--<nav class="pagination-wrap" aria-label="Page navigation example">
<nav class="pagination-wrap" aria-label="Page navigation example">
    <ul class="pagination">
        <li class="page-item">
            <a class="page-link-prev"
               href="{{ $paginator->onFirstPage() ? 'javascript:void(0)' : $paginator->previousPageUrl() }}"
               aria-label="{{ __('pagination.previous') }}">
                <span aria-hidden="true">
                    <img class="img-fluid" src="{{ asset('images/pagination-prev.jpg') }}" alt="{{ __('pagination.previous') }}" title="{{ __('pagination.previous') }}">
                </span>
            </a>
        </li>
        @foreach ($elements as $element)
            @if (is_string($element))
                <span aria-disabled="true">
                                <span class="relative inline-flex items-center px-4 py-2 -ml-px text-sm font-medium text-gray-700 bg-white border border-gray-300 cursor-default leading-5">{{ $element }}</span>
                            </span>
            @endif
            @if (is_array($element))
                @foreach ($element as $page => $url)
                    <li class="page-item {{ $page == $paginator->currentPage() ? 'page-item-active' : null }}">
                        <a class="page-link" href="{{ $page == $paginator->currentPage() ? 'javascript:void(0)' : $url }}">
                            {{ $page }}
                        </a>
                    </li>
                @endforeach
            @endif

        @endforeach
        <li class="page-item">
            <a class="page-link-next"
               href="{{ $paginator->hasMorePages() ? $paginator->nextPageUrl() : 'javascript:void(0)' }}"
               aria-label="{{ __('pagination.next') }}">
                <span aria-hidden="true">
                    <img class="img-fluid" src="{{ asset('images/pagination-next.jpg') }}" alt="{{ __('pagination.next') }}" title="{{ __('pagination.next') }}">
                </span>
            </a>
        </li>
    </ul>
</nav>--}}
