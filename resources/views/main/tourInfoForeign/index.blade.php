@extends('main.layouts.main')
@push('head-custom')
<!-- ===== START:: SCHEMA ===== -->
@php
    $dataSchema = $item->seo ?? null;
@endphp

<!-- STRAT:: Title - Description - Social -->
@include('main.schema.social', ['data' => $dataSchema])
<!-- END:: Title - Description - Social -->

<!-- STRAT:: Organization Schema -->
@include('main.schema.organization')
<!-- END:: Organization Schema -->

<!-- STRAT:: Article Schema -->
@include('main.schema.article', ['data' => $dataSchema])
<!-- END:: Article Schema -->

<!-- STRAT:: Article Schema -->
@include('main.schema.creativeworkseries', ['data' => $dataSchema])
<!-- END:: Article Schema -->

<!-- STRAT:: Article Schema -->
@php
    $highPrice  = $item->price_show ?? 5000000;
    $lowPrice   = round($highPrice/2, 0);
@endphp
@include('main.schema.product', ['data' => $dataSchema, 'files' => $item->files, 'lowPrice' => $lowPrice, 'highPrice' => $highPrice])
<!-- END:: Article Schema -->

<!-- STRAT:: Article Schema -->
@include('main.schema.breadcrumb', ['data' => $breadcrumb])
<!-- END:: Article Schema -->

<!-- STRAT:: FAQ Schema -->
@include('main.schema.faq', ['data' => $item->questions])
<!-- END:: FAQ Schema -->

<!-- ===== END:: SCHEMA ===== -->
@endpush
@section('content')

    @include('main.snippets.breadcrumb')

    <div class="pageContent">
        <div id="elementPrint" class="sectionBox">
            <div class="container">
                <!-- ảnh header của phần in => do trong chrome phải tải trước bản in mới hiển thị -->
                <img src="https://hitour.vn/storage/images/upload/blue-modern-tour-and-travel-twitter-header-type-manager-upload.webp" style="display:none;" />

                <div class="pageContent_head">
                    <!-- title -->
                    <h1 class="titlePage">{{ $item->name }}</h1>
                    <!-- rating -->
                    @include('main.template.rating', compact('item'))
                </div>

                <div class="pageContent_body">
                    <div class="pageContent_body_content">

                        <!-- gallery -->
                        @include('main.tour.gallery', compact('item'))

                        <!-- content box -->
                        @include('main.tour.content', compact('item'))

                    </div>
                    <div class="pageContent_body_sidebar">

                        @include('main.tour.detailTour', compact('item'))

                        @include('main.tour.price', compact('item'))

                        <div class="js_scrollFixed" style="margin-top:0;">
                            @include('main.template.callbook', [
                                'flagButton'    => true,
                                'button'        => 'Đặt Tour'
                            ])

                            @include('main.tour.tocContentTour', compact('item'))
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

    
    
@endsection
@push('scripts-custom')
    <script type="text/javascript">
        $(window).on('load', function () {
            setupSlick();
            $(window).resize(function(){
                setupSlick();
            })

            $('.sliderHome').slick({
                infinite: true,
                autoplaySpeed: 5000,
                lazyLoad: 'ondemand',
                dots: true,
                arrows: true,
                autoplay: true,
                responsive: [
                    {
                        breakpoint: 567,
                        settings: {
                            arrows: false,
                        }
                    }
                ]
            });

            function setupSlick(){
                setTimeout(function(){
                    $('.sliderHome .slick-prev').html('<i class="fa-solid fa-arrow-left-long"></i>');
                    $('.sliderHome .slick-next').html('<i class="fa-solid fa-arrow-right-long"></i>');
                    $('.sliderHome .slick-dots button').html('');
                }, 0);
            }
        });
        
    </script>
@endpush