<div class="slideBox">
    <div class="slideBox_body">
        {{-- <div class="container">
            <div class="slideBox_body_left">
                <div id="slideEffectDropdown" style="opacity:0;">
                    <h2>
                        <span>Website sẽ là "cỗ máy in tiền"</span>
                        <span>nếu bạn đầu tư đúng cách</span>
                    </h2>
                    <div class="slideBox_body_left_desc">
                        <span>Chúng tôi sẽ giúp bạn thiết kế, tối ưu toàn diện và quản trị Website.</span>
                        <span>Website của bạn sẽ trở thành nơi thu hút, giữ chân khách hàng và vượt qua mọi đối thủ</span>
                        <span>giúp doanh nghiệp tạo nên giá trị thương hiệu 4.0 chuyên nghiệp.</span>
                    </div>
                </div>
                <div id="slideEffectFadeIn" class="aboutUsSortBox" style="opacity:0;">
                        <div class="aboutUsSortBox_item">
                            <div class="aboutUsSortBox_item_number">
                                +10
                            </div>
                            <div class="aboutUsSortBox_item_text">
                                dịch vụ
                            </div>
                        </div>
                        <div class="aboutUsSortBox_item">
                            <div class="aboutUsSortBox_item_number">
                                +5
                            </div>
                            <div class="aboutUsSortBox_item_text">
                                kinh nghiệm
                            </div>
                        </div>
                        <div class="aboutUsSortBox_item">
                            <div class="aboutUsSortBox_item_number">
                                +200
                            </div>
                            <div class="aboutUsSortBox_item_text">
                                khách hàng thân thiết
                            </div>
                        </div>
                </div>
            </div>
        </div> --}}

        <!-- START: Sort Booking -->
        @include('main.form.formBooking', ['active' => 'tour'])
        <!-- END: Sort Booking -->
    </div>
    <div class="slideBox_bottom">
        <img src="{{ Storage::url('images/svg/background-wave-1.png') }}" alt="Thiết kế website kiên giang" title="Thiết kế website kiên giang" />
    </div>
    <video id="js_loadVideoBackground" class="slideBox_video" type="video/mp4" autoplay muted loop style="background:url('{{ Storage::url('images/svg/background-image-slide-500.jpg') }}') no-repeat;background-size: 100% 100%;">
        <!-- js loadVideoBackground -->
    </video>
</div>
@push('scripts-custom')
<script type="text/javascript">
    $(window).ready(function(){

        loadVideoBackground();
        
        // /* hiệu ứng rơi xuống */
        // const elementDropdown   = $('#slideEffectDropdown');
        // const marginTopReal     = parseInt(elementDropdown.css('margin-top'));
        // elementDropdown.css({
        //     'margin-top'    : (marginTopReal - 200)+'px'
        // });
        // setTimeout(() => {
        //     elementDropdown.animate({
        //         'margin-top'    : marginTopReal+'px',
        //         'opacity'       : 1
        //     }, 800, function(){
        //         slideEffectFadeIn();
        //         loadVideoBackground();
        //     });
        // }, 300);
    })
    // /* ẩn trước phần tử effect dropDown */
    // const elementDropdown   = $('#slideEffectDropdown');
    // const marginTopReal     = parseInt(elementDropdown.css('margin-top'));
    // elementDropdown.css({
    //     'margin-top'    : (marginTopReal - 200)+'px'
    // });
    
    /* hiệu ứng fade in */
    function slideEffectFadeIn(){
        const elementFladeIn    = $('#slideEffectFadeIn');
        elementFladeIn.animate({
            opacity : 1,
        }, 800);
    }
    /* thay background image bằng video */
    function loadVideoBackground(){
        $.ajax({
            url: '/storage/videos/video-slide-2.mp4',
            type: 'GET',
            xhr: function() {
                var xhr = new window.XMLHttpRequest();
                xhr.responseType = 'blob';
                return xhr;
            },
            success: function(data) {
                var videoUrl = URL.createObjectURL(data);
                const sourceVideo = '<source src="'+videoUrl+'" title="thiết kế website kiên giang">Video thiết kế website kiên giang';
                setTimeout(function(){
                    $('#js_loadVideoBackground').html(sourceVideo);
                }, 500);
            }
        });
    }
</script>
@endpush