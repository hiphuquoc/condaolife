{{-- <div class="bannerHome" style="background:url('{{ Storage::url('/images/svg/slider-home-1.png') }}') no-repeat;background-size:100% 100%;"> --}}
<div class="bannerHome" style="background:url('https://mytourcdn.com/upload_images/Image/Location/27_7_2016/11/du-lich-bien-dao-mytour-1.jpg') no-repeat;background-size:100% 100%;">
    
    <img src="{{ Storage::url('images/svg/stock-wave-1.png') }}" alt="trang chủ {{ config('main.company_name') }}"  title="trang chủ {{ config('main.company_name') }}" />
    <!-- START: Sort Booking -->
    @php
        $active = 'ship';
    @endphp
    @include('main.form.formBooking', compact('active'))
    <!-- END: Sort Booking -->
    
</div>