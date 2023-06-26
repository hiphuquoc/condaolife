@if(!empty($list)&&$list->isNotEmpty())
    @php
        $classSlick = $list->count()>3 ? 'slickBox' : '';
    @endphp
    <div id="js_filterTour_parent" class="tourGrid {{ $classSlick }}">
        @foreach($list as $combo)
            <div class="tourGrid_item" data-filter-day="{{ $combo->days ?? 0 }}">
                <a href="/{{ $combo->seo->slug_full ?? null }}" title="{{ $combo->name ?? $combo->seo->title ?? $combo->seo->seo_title ?? null }}" class="tourGrid_item_image">
                    <img src="{{ config('main.svg.loading_main') }}" data-src="{{ $combo->seo->image_small ?? $combo->seo->image ?? config('admin.images.default_750x460') }}" alt="{{ $combo->name ?? $combo->seo->title ?? $combo->seo->seo_title ?? null }}" title="{{ $combo->name ?? $combo->seo->title ?? $combo->seo->seo_title ?? null }}" />
                    @php
                        $xhtmlLocation = [];
                        foreach($combo->locations as $location){
                            if(!in_array($location->infoLocation->display_name, $xhtmlLocation)) $xhtmlLocation[] = $location->infoLocation->display_name;
                        }
                        $xhtmlLocation = implode(', ', $xhtmlLocation);
                    @endphp
                    @if(!empty($xhtmlLocation))
                        <div class="tourGrid_item_image_time">
                            <i class="fa-solid fa-location-dot"></i> {{ $xhtmlLocation }}
                        </div>
                    @endif
                </a>
                <div class="tourGrid_item_content">
                    <a href="/{{ $combo->seo->slug_full ?? null }}" title="{{ $combo->name ?? $combo->seo->title ?? $combo->seo->seo_title ?? null }}" class="tourGrid_item_content_title maxLine_1">
                        <h2>{{ $combo->name ?? $combo->seo->title ?? null }}</h2>
                    </a>
                    <a href="/{{ $combo->seo->slug_full ?? null }}" title="{{ $combo->name ?? $combo->seo->title ?? $combo->seo->seo_title ?? null }}" class="tourGrid_item_content_desc">
                        <h3 class="maxLine_4">{{ $combo->description ?? $combo->seo->description ?? null }}</h3>
                    </a>
                    @php
                        $tmp            = [];
                        foreach($combo->options as $option){
                            foreach($option->prices as $price){
                                if(!in_array($price->departure->display_name, $tmp)) $tmp[] = $price->departure->display_name;
                            }
                        }
                    @endphp
                    <div class="column" style="align-items:flex-end !important;">
                        <div class="column_item">
                            <div class="tourGrid_item_content_departureFrom maxLine_1">
                                Xuất phát {{ implode('/ ', $tmp) }}
                            </div>
                            @if(!empty($combo->departure_schedule))
                                <div class="tourGrid_item_content_departureSchedule">
                                    {{ $combo->departure_schedule }}
                                </div>
                            @endif
                        </div>
                        @if(!empty($combo->price_show))
                            <div class="column_item tourGrid_item_content_price">
                                {{ number_format($combo->price_show).config('main.unit_currency') }}
                            </div>
                        @endif
                    </div>
                </div>
                {{-- <div class="tourGrid_item_info">

                </div>
                <div class="tourGrid_item_location">
                    <i class="fa-solid fa-location-dot"></i>{{ $combo->tour_location_name }}
                </div> --}}
            </div>
        @endforeach
    </div>
    <div id="js_filterTour_hidden" style="display:none;">
        <!-- chứa phần tử tạm của filter => để hiệu chỉnh nth-child cho chính xác -->
    </div>
@endif
@include('main.tourLocation.loadingGridBox')