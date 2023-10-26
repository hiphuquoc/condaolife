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

<!-- STRAT:: Product Schema -->
@php
    $arrayPrice = [];
    foreach($item->tours as $tour) if(!empty($tour->infoTour->price_show)) $arrayPrice[] = $tour->infoTour->price_show;
    $highPrice  = !empty($arrayPrice) ? max($arrayPrice) : 5000000;
    $lowPrice   = !empty($arrayPrice) ? min($arrayPrice) : 3000000;
@endphp
@include('main.schema.product', ['data' => $dataSchema, 'files' => $item->files, 'lowPrice' => $lowPrice, 'highPrice' => $highPrice])
<!-- END:: Product Schema -->

<!-- STRAT:: Article Schema -->
@include('main.schema.breadcrumb', ['data' => $breadcrumb])
<!-- END:: Article Schema -->

<!-- STRAT:: FAQ Schema -->
@include('main.schema.faq', ['data' => $item->questions])
<!-- END:: FAQ Schema -->

@php
    $dataList           = new \Illuminate\Support\Collection();
    if(!empty($item->tours)&&$item->tours->isNotEmpty()){
        foreach($item->tours as $tour){
            $dataList[] = $tour->infoTour;
        }
    }
@endphp
<!-- STRAT:: Article Schema -->
@include('main.schema.itemlist', ['data' => $dataList])
<!-- END:: Article Schema -->

<!-- ===== END:: SCHEMA ===== -->
@endpush
@section('content')

    @include('main.form.sortBooking', [
        'item'      => $item,
        'active'    => 'tour'
    ])

    @include('main.snippets.breadcrumb')

    <div class="pageContent">

        <!-- Tour box -->
        <div class="sectionBox backgroundPrimaryGradiend">
            <div class="container">
                <h1 class="titlePage">Tour {{ $item->display_name ?? null }} - Danh sách Tour du lịch {{ $item->display_name ?? null }} chất lượng</h1>
                <p class="sectionBox_desc">Tổng hợp các chương trình <strong>Tour {{ $item->display_name ?? null }} trọn gói</strong> và <strong>Tour {{ $item->display_name ?? null }} trong ngày</strong> đa dạng, chất lượng hàng đầu được cung cấp và đảm bảo bởi {{ config('main.name') }} cùng hệ thống đối tác du lịch trên toàn quốc.</p>
                @include('main.tourLocation.filterBox')
                @php
                    $dataTours              = new \Illuminate\Support\Collection();
                    foreach($item->tours as $tour) if(!empty($tour->infoTour)) $dataTours[] = $tour->infoTour;
                @endphp
                @if(!empty($dataTours)&&$dataTours->isNotEmpty())
                    @include('main.tourLocation.tourItem', ['list' => $dataTours])
                @else 
                    <div style="color:rgb(0,123,255);">Các chương trình <strong>Tour {{ $item->display_name ?? null }}</strong> đang được {{ config('main.name') }} cập nhật và sẽ sớm giới thiệu đến Quý khách trong thời gian tới!</div>
                @endif
            </div>
        </div>

        <!-- Giới thiệu Tour du lịch -->
        <div class="sectionBox" style="padding-top:0;background:#e9ecef;">
            <div class="container">
                <!-- title -->
                <h2 class="sectionBox_title">Tour {{ $item->display_name ?? null }} - Giới thiệu thêm về Tour du lịch {{ $item->display_name ?? null }}</h2>
                <!-- content -->
                @if(!empty($content))
                    <div id="js_showHideFullContent_content" class="contentBox maxLine_4">
                        {!! $content !!}
                    </div>
                    <div class="viewMore">
                        <div onClick="showHideFullContent(this, 'maxLine_4');">
                            <i class="fa-solid fa-arrow-down-long"></i>Đọc thêm
                        </div>
                    </div>
                @endif
            </div>
        </div>

        <!-- START:: Video -->
        @include('main.tourLocation.videoBox', [
            'item'  => $item,
            'title' => 'Video Tour du lịch '.$item->display_name
        ])
        <!-- END:: Video -->

        <!-- Hướng dẫn đặt Tour -->
        @include('main.tourLocation.guideBook', ['title' => 'Hướng dẫn đặt Tour '.$item->display_name])

        <!-- faq -->
        @if(!empty($item->questions)&&$item->questions->isNotEmpty())
            <div class="sectionBox withBorder">
                <div class="container" style="border-bottom:none !important;">
                    @include('main.snippets.faq', ['list' => $item->questions, 'title' => $item->name])
                </div>
            </div>
        @endif
    </div>
</div>

    
    
@endsection
@push('scripts-custom')
    <script type="text/javascript">
        $(window).on('load', function () {
            
        });

        function showHideFullContent(elementButton, classCheck){
            const contentBox = $('#js_showHideFullContent_content');
            if(contentBox.hasClass(classCheck)){
                contentBox.removeClass(classCheck);
                $(elementButton).html('<i class="fa-solid fa-arrow-up-long"></i>Thu gọn');
            }else {
                contentBox.addClass(classCheck);
                $(elementButton).html('<i class="fa-solid fa-arrow-down-long"></i>Đọc thêm');
            }
        }
    </script>
@endpush