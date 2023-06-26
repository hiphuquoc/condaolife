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
@include('main.schema.breadcrumb', ['data' => $breadcrumb])
<!-- END:: Article Schema -->

<!-- ===== END:: SCHEMA ===== -->
@endpush
@section('content')

    @include('main.snippets.breadcrumb')

    <div class="pageContent">
        <div class="sectionBox">
            <div class="container">
                <div class="pageContent_body">
                    <div id="js_buildTocContentSidebar_element" class="pageContent_body_content">
                        <!-- title -->
                        @php
                            $phone      = $item->phone ?? null;
                            if(!empty($phone)) $phone  = substr($phone, 0, -3).'***';
                        @endphp
                        <h1 class="titlePage">{{ $item->name }} - {{ $phone }}</h1>
                        <!-- content -->
                        <div class="contentShip">
                            <!-- Nội dung tùy biến -->
                            {!! $item->content ?? null !!}
                        </div>
                        
                    </div>
                    <div class="pageContent_body_sidebar">
                        @include('main.feedback.sidebar')
                    </div>
                </div>
            </div>
        </div>

        <!-- START: -->
        <div class="sectionBox noBackground">
            <div class="container">
                <h2 class="sectionBox_title">Feedback tương tự</h2>
                <p class="sectionBox_desc">Nhận xét của khách hàng đã từng sử dụng dịch vụ của LifeTour.</p>
                @include('main.home.feedback')
            </div>
        </div>
        <!-- END: -->

    </div>
@endsection
@push('scripts-custom')
    <script type="text/javascript">
        buildTocContentMain('js_buildTocContentSidebar_element');
    </script>
@endpush