@extends('main.layouts.main')
@push('head-custom')
<!-- ===== START:: SCHEMA ===== -->
<!-- STRAT:: Title - Description - Social -->
@include('main.schema.social', ['data' => $item])
<!-- END:: Title - Description - Social -->

<!-- STRAT:: Organization Schema -->
@include('main.schema.organization')
<!-- END:: Organization Schema -->

<!-- STRAT:: Article Schema -->
@include('main.schema.article', ['data' => $item])
<!-- END:: Article Schema -->

<!-- STRAT:: Article Schema -->
@include('main.schema.creativeworkseries', ['data' => $item])
<!-- END:: Article Schema -->

<!-- ===== END:: SCHEMA ===== -->
@endpush
@section('content')
    @include('main.home.slide')

    @php
        /* loc tour tàu và tour bay */
        $tourShip   = new \Illuminate\Database\Eloquent\Collection;
        $tourAir    = new \Illuminate\Database\Eloquent\Collection;
        foreach($tours as $tour){
            $pos    = strpos($tour->transport, 'Tàu');
            if(!empty($pos)) {
                $tourShip[] = $tour;
            }else {
                $tourAir[]  = $tour;
            }
        }
    @endphp

    <!-- START: Combo Côn Đảo -->
    <div class="sectionBox">
        <div class="container">
            <a href="/combo-du-lich-con-dao" title="Combo Côn Đảo">
                <h2 class="sectionBox_title">Combo du lịch Côn Đảo</h2>
            </a>
            <p class="sectionBox_desc">Tổng hợp Combo du lịch Côn Đảo hấp dẫn và đa dạng với nhiều lựa chọn cho du khách.</p>
            @include('main.comboLocation.comboItem', [
                'list' => $combos,
                // 'slick' => true
            ])
        </div>
    </div>
    <!-- END: Combo Côn Đảo -->

    <!-- START: Tour Côn Đảo bằng máy bay -->
    <div class="sectionBox">
        <div class="container">
            <h2 class="sectionBox_title">Tour Côn Đảo bằng máy bay</h2>
            <p class="sectionBox_desc">Tổng hợp Tour du lịch Côn Đảo hấp dẫn và đa dạng di chuyển bằng máy bay khởi hành từ TPHCM, Hà Nội hoặc Cần Thơ.</p>
            @include('main.tourLocation.tourItem', [
                'list' => $tourAir,
                'slick' => true
            ])
        </div>
    </div>
    <!-- END: Tour Côn Đảo bằng máy bay -->

    <!-- START: Tour Côn Đảo bằng cao tốc -->
    <div class="sectionBox backgroundSecondary">
        <div class="container">
            <h2 class="sectionBox_title">Tour Côn Đảo bằng tàu cao tốc</h2>
            <p class="sectionBox_desc">Tổng hợp Tour du lịch Côn Đảo hấp dẫn và đa dạng di chuyển bằng máy bay khởi hành từ Vũng Tàu, Trần Đề Sóc Trăng hoặc Cần Thơ.</p>
            @include('main.tourLocation.tourItem', [
                'list' => $tourShip,
                'slick' => true
            ])
        </div>
    </div>
    <!-- END: Tour Côn Đảo bằng cao tốc -->

    <!-- Cho thuê xe -->
    @if(!empty($itemTourLocation->carrentalLocations[0]->infoCarrentalLocation))
        <div class="sectionBox withBorder">
            <div class="container">
                <h2 class="sectionBox_title">Cho thuê xe {{ $item->display_name ?? null }}</h2>
                <p class="sectionBox_desc">Nếu cần phương tiện đưa đón, di chuyển và tham quan bạn có thể tham khảo thêm dịch vụ <strong>Cho thuê xe tại {{ $item->display_name ?? null }}</strong> của {{ config('main.name') }} với đầy đủ lựa chọn (tự lái hoặc có tài xế), xe đời mới, nhiều loại phù hợp yêu cầu và mức giá hợp lí.</p>
                <div class="guideList">
                    @foreach($itemTourLocation->carrentalLocations as $carrentalLocation)
                        <div class="guideList_item">
                            <i class="fa-solid fa-angles-right"></i>Xem thêm <a href="/{{ $carrentalLocation->infoCarrentalLocation->seo->slug_full }}" title="{{ $carrentalLocation->infoCarrentalLocation->name }}">{{ $carrentalLocation->infoCarrentalLocation->name }}</a>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    @endif

    <!-- Vé máy bay -->
    @php
        $dataAirs               = new \Illuminate\Support\Collection();
        $i                      = 0;
        if(!empty($itemTourLocation->airLocations)){
            foreach($itemTourLocation->airLocations as $airLocation){
                foreach($airLocation->infoAirLocation->airs as $air){
                    $dataAirs[$i]               = $air;
                    $dataAirs[$i]->seo          = $air->seo;
                    $dataAirs[$i]->location     = $air->location;
                    $dataAirs[$i]->departure    = $air->departure;
                    ++$i;
                }
            }
        }
    @endphp
    @if(!empty($dataAirs)&&$dataAirs->isNotEmpty())
        <div class="sectionBox" style="background:#e9ecef;">
            <div class="container">
                @if(!empty($itemTourLocation->airLocations[0]->infoAirLocation->seo->slug_full))
                    <a href="/{{ $itemTourLocation->airLocations[0]->infoAirLocation->seo->slug_full }}" title="Vé máy bay đi {{ $itemTourLocation->display_name ?? null }}">
                        <h2 class="sectionBox_title">Vé máy bay đi {{ $itemTourLocation->display_name ?? null }}</h2>
                    </a>
                @else 
                    <h2 class="sectionBox_title">Vé máy bay đi {{ $item->display_name ?? null }}</h2>
                @endif
                <p class="sectionBox_desc">Để đến được {{ $itemTourLocation->display_name ?? null }} nhanh chóng, an toàn và tiện lợi tốt nhất bạn nên di chuyển bằng máy bay. Thông tin chi tiết các <strong>chuyến bay đến {{ $itemTourLocation->display_name ?? null }}</strong> bạn có thể tham khảo bên dưới</p>
                @include('main.airLocation.airItem', [
                    'list'          => $dataAirs, 
                    'limit'         => 3, 
                    'link'          => $itemTourLocation->airLocations[0]->infoAirLocation->seo->slug_full, 
                    'itemHeading'   => 'h3'
                ])
            </div>
        </div>
    @endif

    <!-- Vé tàu cao tốc -->
    @if(!empty($itemTourLocation->shipLocations[0]->infoShipLocation))
        <div class="sectionBox backgroundPrimary">
            <div class="container">
                @if(!empty($itemTourLocation->shipLocations[0]->infoShipLocation->seo->slug_full))
                    <a href="/{{ $itemTourLocation->shipLocations[0]->infoShipLocation->seo->slug_full }}" title="Vé tàu cao tốc {{ $itemTourLocation->display_name ?? null }}">
                        <h2 class="sectionBox_title">Vé tàu cao tốc {{ $itemTourLocation->display_name ?? null }}</h2>
                    </a>
                @else
                    <h2 class="sectionBox_title">Vé tàu cao tốc {{ $itemTourLocation->display_name ?? null }}</h2>
                @endif
                <p class="sectionBox_desc">Một trong các phương tiện tối ưu nhất hiện nay để đi đến {{ $itemTourLocation->display_name ?? null }} là <strong>Tàu cao tốc</strong>, ngoài việc tiết kiệm thời gian, chi phí bạn còn được trải nghiệm khung cảnh biển đúng nghĩa. Thông tin chi tiết các <strong>chuyến tàu {{ $itemTourLocation->display_name ?? null }}</strong> đang hoạt động năm {{ date('Y', time() )}} bạn có thể tham khảo bên dưới</p>
                @php
                    $dataShips      = new \Illuminate\Support\Collection();
                    foreach($itemTourLocation->shipLocations as $shipLocation){
                        $dataShips  = $dataShips->merge($shipLocation->infoShipLocation->ships);
                    }
                @endphp
                @include('main.shipLocation.shipGridMerge', [
                    'list'          => $dataShips, 
                    'limit'         => 3, 
                    'link'          => $itemTourLocation->shipLocations[0]->infoShipLocation->seo->slug_full,
                    'itemHeading'   => 'h3'
                ])
            </div>
        </div>
    @endif

    <!-- Cẩm nang du lịch -->
    @if(!empty($itemTourLocation->guides[0]->infoGuide))
        <div class="sectionBox withBorder">
            <div class="container">
                <h2 class="sectionBox_title">Cẩm nang du lịch {{ $itemTourLocation->display_name ?? null }}</h2>
                <p class="sectionBox_desc">Nếu các chương trình <strong>Tour du lịch {{ $itemTourLocation->display_name ?? null }}</strong> của {{ config('main.name') }} không đáp ứng được nhu cầu của bạn hoặc là người ưu thích du lịch tự túc,... Bạn có thể tham khảo <strong>Cẩm nang du lịch</strong> bên dưới để có đầy đủ thông tin, tự do lên kế hoạch, sắp xếp lịch trình cho chuyến đi của mình được chu đáo nhất.</p>
                <div class="guideList">
                    @foreach($itemTourLocation->guides as $guide)
                        <div class="guideList_item">
                            <i class="fa-solid fa-angles-right"></i>Xem thêm <a href="/{{ $guide->infoGuide->seo->slug_full }}" title="{{ $guide->infoGuide->name }}">{{ $guide->infoGuide->name }}</a>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    @endif

    <!-- Đặc sản -->
    @if(!empty($specialList[0]))
        <div class="sectionBox backgroundPrimary">
            <div class="container">
                <h2 class="sectionBox_title">Đặc sản {{ $item->display_name ?? null }}</h2>
                <p class="sectionBox_desc">Tổng hợp những món ngon, đặc sản nổi tiếng tại {{ $item->display_name ?? null }} bạn nên mua làm quà hoặc thưởng thức ít nhất một lần.</p>
                @include('main.tourLocation.blogGridSlick', ['list' => $specialList, 'link' => $item->specials[0]->infoCategory->seo->slug_full ?? null, 'limit' => 10])
            </div>
        </div>
    @endif

    <!-- START: Điểm đến nổi bật -->
    @if(!empty($specialLocations)&&$specialLocations->isNotEmpty())
        <div class="sectionBox noBackground">
            <div class="container">
                <h2 class="sectionBox_title">Điểm đến nổi bật Côn Đảo</h2>
                <p class="sectionBox_desc">Danh sách và thông tin chi tiết về điểm đến hấp dẫn tại Côn Đảo</p>
                @include('main.home.specialLocation', compact('specialLocations'))
            </div>
        </div>
    @endif
    <!-- END: Điểm đến nổi bật -->

    <!-- START: Điểm đến nổi bật -->
    <div class="sectionBox backgroundPrimary">
        <div class="container">
            <h2 class="sectionBox_title">Khách hàng nói về LifeTour</h2>
            <p class="sectionBox_desc">Nhận xét của khách hàng đã từng sử dụng dịch vụ của LifeTour.</p>
            @include('main.home.feedback', ['addClass' => 'slickBoxFeedback'])
        </div>
    </div>
    <!-- END: Điểm đến nổi bật -->

    <!-- START: Đối tác -->
    @if(!empty($partners)&&$partners->isNotEmpty())
        <div class="sectionBox noBackground">
            <div class="container">
                @include('main.home.partner', [
                    'list'          => $partners,
                    'title'         => 'Đối tác tàu cao tốc',
                    'description'   => 'Những đối tác tàu cao tốc đang hoạt động các tuyến biển đảo tại Việt Nam'
                ])
            </div>
        </div>
    @endif
    <!-- END: Đối tác -->
    
@endsection
@push('scripts-custom')
    <script type="text/javascript">
        $(document).ready(function(){
            setSlick();
        })
        $(window).resize(function(){
            setSlick();
        })
        function setSlick(){
            $('.slickBox').slick({
                infinite: false,
                slidesToShow: 3.01,
                slidesToScroll: 3,
                arrows: true,
                prevArrow: '<button class="slick-arrow slick-prev" aria-label="Slide trước"><i class="fa-solid fa-angle-left"></i></button>',
                nextArrow: '<button class="slick-arrow slick-next" aria-label="Slide tiếp theo"><i class="fa-solid fa-angle-right"></i></button>',
                responsive: [
                    {
                        breakpoint: 1023,
                        settings: {
                            infinite: false,
                            slidesToShow: 2.6,
                            slidesToScroll: 2,
                            arrows: true,
                        }
                    },
                    {
                        breakpoint: 767,
                        settings: {
                            infinite: false,
                            slidesToShow: 1.7,
                            slidesToScroll: 1,
                            arrows: true,
                        }
                    },
                    {
                        breakpoint: 577,
                        settings: {
                            infinite: false,
                            slidesToShow: 1.3,
                            slidesToScroll: 1,
                            arrows: false,
                        }
                    }
                ]
            });
            $('.slickBoxFeedback').slick({
                infinite: false,
                slidesToShow: 3.4,
                slidesToScroll: 3,
                arrows: true,
                prevArrow: '<button class="slick-arrow slick-prev" aria-label="Slide trước"><i class="fa-solid fa-angle-left"></i></button>',
                nextArrow: '<button class="slick-arrow slick-next" aria-label="Slide tiếp theo"><i class="fa-solid fa-angle-right"></i></button>',
                responsive: [
                    {
                        breakpoint: 1023,
                        settings: {
                            infinite: false,
                            slidesToShow: 2.6,
                            slidesToScroll: 2,
                            arrows: true,
                        }
                    },
                    {
                        breakpoint: 767,
                        settings: {
                            infinite: false,
                            slidesToShow: 1.7,
                            slidesToScroll: 1,
                            arrows: true,
                        }
                    },
                    {
                        breakpoint: 577,
                        settings: {
                            infinite: false,
                            slidesToShow: 1.2,
                            slidesToScroll: 1,
                            arrows: true,
                        }
                    },
                ]
            });
        }
    </script>
@endpush