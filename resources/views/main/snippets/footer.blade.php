<section class="footer" style="background:url('{{ Storage::url('images/svg/background-wave.png') }}') no-repeat;background-size:100% 102%;">
    <div class="container">
        <div class="footerBox">
                <div class="footerBox_item">
                    <ul style="margin:0;">
                        <li>
                            <b style="font-family:'SVN-Gilroy Bold', serif;">{{ config('main.company.name') }}</b>
                        </li>
                        <li>
                            <i class="fa-solid fa-location-dot"></i>trụ sở: {{ config('main.company.address') }}
                        </li>
                        <li>
                            @php
                                $hotlineNoSpace = config('main.company.hotline');
                                $tmp            = explode(' ', $hotlineNoSpace);
                                for($i=0;$i<count($tmp);++$i){
                                    $tmp[$i]    = trim($tmp[$i]);
                                }
                                $hotlineNoSpace = implode($tmp);
                            @endphp
                            <i class="fa-solid fa-phone"></i>hotline: <a href="tel:{{ $hotlineNoSpace }}" title="Hotline {{ config('main.name') }}">{{ config('main.company.hotline') }}</a>
                        </li>
                        <li>
                            <i class="fa-solid fa-globe"></i>website: <a href="{{ config('main.company.website') }}" title="Trang chủ {{ config('main.name') }}">{{ config('main.company.website') }}</a>
                        </li>
                        <li>
                            <i class="fa-solid fa-envelope"></i>email: <a href="mailTo:{{ config('main.company.email') }}" title="Email {{ config('main.name') }}">{{ config('main.company.email') }}</a>
                        </li>
                    </ul>
                </div>
                <div class="footerBox_item">
                    <div class="footerBox_item_title">Góc khách hàng</div>
                    <ul class="footerBox_item_list">
                        <li>
                            <div>Thông tin thanh toán</div>
                        </li>
                        <li>
                            <div>Chính sách đặt dịch vụ</div>
                        </li>
                        <li>
                            <div>Chính sách bảo mật</div>
                        </li>
                        {{-- <li>
                            <div>Ý kiến khách hàng</div>
                        </li>
                        <li>
                            <div>Phiếu góp ý</div>
                        </li> --}}
                    </ul>
                </div>
                <div class="footerBox_item">
                    <div class="footerBox_item_title">Chứng nhận</div>
                    <div class="certificateBox">
                        <div class="certificateBox_item certificateBCT"></div>
                        <div class="certificateBox_item certificateDMCA"></div>
                    </div>
                </div>
                <div class="footerBox_item">
                    <div class="footerBox_item_title">Đăng ký nhận khuyến mãi</div>
                    <div class="signupReceiveEmail">
                        <div class="signupReceiveEmail_desc">Nhập email để nhận thông tin về các chương trình khuyến mãi của {{ config('main.name') }}!</div>
                        <div class="signupReceiveEmail_input">
                            <form id="registryEmailForm" action="#" method="get">
                                <div class="registryEmailBox">
                                    {{-- <div class="registryEmailBox_text">
                                        Đăng ký nhận thông tin 
                                    </div>
                                    <div class="registryEmailBox_input">
                                        <input type="text" name="registry_email" placeholder="Email không hợp lệ!" required="">
                                        <button type="button" class="button" onclick="submitFormRegistryEmail('registryEmailForm')" aria-label="Gửi email đăng ký nhận tin"><i class="fa-solid fa-paper-plane"></i>Gửi</button>
                                    </div> --}}

                                    <input type="text" name="registry_email" placeholder="Email của bạn" />
                                    <button type="button" aria-label="Đăng ký email" onclick="submitFormRegistryEmail('registryEmailForm')" aria-label="Gửi email đăng ký nhận tin"><i class="fa-solid fa-envelope"></i></button>
                                </div>
                            </form>
                            
                        </div>
                    </div>
                </div>
        </div>
        <div class="footerBox">
            <div class="footerBox_item">
                <div>
                    Giấy chứng nhận đăng ký kinh doanh số GP/no: 1702204052 cấp bởi Sở Kế hoạch và Đầu tư Tỉnh Kiên Giang ngày 20/08/2020 
                </div>
            </div>
            <div class="footerBox_item">
                <div class="footerBox_item_title">Chấp nhận thanh toán</div>
                <div class="paymentList">
                    <div class="paymentList_item paymentBank">
                        <span class="paymentList_item_icon paymentBank"></span>
                        <span>Ngân hàng /Internet Banking</span>
                    </div>
                    <div class="paymentList_item">
                        <span class="paymentList_item_icon paymentAtm"></span>
                        <span>Thanh toán qua ATM</div>
                    <div class="paymentList_item">
                        <span class="paymentList_item_icon paymentDirect"></span>
                        <span>Thanh toán trực tiếp</span>
                    </div>
                </div>
            </div>
            <div class="footerBox_item" style="padding:0 !important;margin:0 !important;">
                {{-- <div class="footerBox_item_title">Hệ thống</div>
                <ul>
                    <li>
                        <a href="https://superdong.vn" title="Cẩm nang du lịch Việt" target="_blank" rel="nofollow">Cẩm nang du lịch Việt</a>
                    </li>
                    <li>
                        <a href="https://tickets.com.vn" title="Trang vé toàn quốc" target="_blank" rel="nofollow">Trang vé toàn quốc</a>
                    </li>
                    <li>
                        <a href="https://name.com.vn" title="Đặc sản ba miền" target="_blank" rel="nofollow">Đặc sản ba miền</a>
                    </li>
                    <li>
                        <a href="https://name.com.vn" title="Bất động sản" target="_blank" rel="nofollow">Bất động sản</a>
                    </li>
                </ul> --}}
            </div>
            <div class="footerBox_item">
                <div class="footerBox_item_title">Kết nối với chúng tôi</div>
                <div class="socialBox">
                    <div class="socialBox_item socialFacebook"></div>
                    {{-- <div class="socialBox_item socialInstagram"></div> --}}
                    <div class="socialBox_item socialYoutube"></div>
                    <div class="socialBox_item socialLinkendin"></div>
                    <div class="socialBox_item socialTwitter"></div>
                </div>
            </div>
        </div>
    </div>
</section>
<div class="copyright">
    <div class="container">
        © Copyright - Bản quyền <b><a href="{{ config('main.company.website') }}" title="Trang chủ {{ config('main.name') }}">{{ config('main.name') }}</a></b> - Thiết kế và phát triển bởi Phạm Văn Phú. Ghi rõ nguồn "{{ config('main.name') }}" khi sử dụng thông tin từ website này!
    </div>
</div>