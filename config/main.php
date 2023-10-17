<?php

return [
    'name'              => 'LifeTour',
    'webname'           => 'Condaolife.com',
    'description'       => 'Trang thông tin du lịch Côn Đảo hàng đầu ®LifeTour',
    /* Thông báo validate form */
    'message_validate'  => [
        'not_empty'     => 'Không để trống trường này!',
    ],
    'unit_currency'     => 'đ',
    'logo_square'       => 'https://hitour.vn/storage/images/upload/logo-share-type-manager-upload.png',
    'icon-arrow-email'  => 'https://hitour.vn/images/main/icon-arrow-email.png',
    'avatar_home'       => 'https://hitour.vn/storage/images/upload/banner-hitour-1-type-manager-upload.webp',
    'svg'               => [
        'loading_main'      => '/images/main/svg/loading_plane_bge9ecef.svg',
        'loading_main_nobg' => '/storage/images/svg/loading_plane_transparent.svg'
    ],
    'title_list_service_sidebar'        => 'Có thể bạn cần?',
    /* Background hỗ trợ loading */
    'background_slider_home'            => '/images/main/background-slider-home.jpg',
    'cache'     => [
        'folderSave'    => 'public/caches/',
        'extension'     => 'html',
    ],
    'rating_rule'       => [
        [
            'text'  => 'Rất tuyệt',
            'score' => '9'
        ],
        [
            'text'  => 'Tuyệt vời',
            'score' => '8'
        ],
        [
            'text'  => 'Rất tốt',
            'score' => '7'
        ],
        [
            'text'  => 'Tốt',
            'score' => '6'
        ],
        [
            'text'  => 'Tạm được',
            'score' => '5'
        ],
        [
            'text'  => 'Hơi tệ',
            'score' => '3'
        ],
        [
            'text'  => 'Rất tệ',
            'score' => '0'
        ]
    ],
    'hotel_type'    => [
        'Khách sạn', 'Khu nghỉ dưỡng', 'Homestay', 'Nhà nghỉ', 'Căn hộ', 'Nhà khách gia đình', 'Biệt thự', 'Nhà riêng','Khác'
    ],
    'company'           => [
        'gpdkkd'        => 'Giấy chứng nhận đăng ký kinh doanh số GP/no: 0310568522 cấp bởi Sở Kế hoạch và Đầu tư Tỉnh TPHCM ngày 10/01/2011',
        'name'          => 'CÔNG TY CỔ PHẦN DỊCH VỤ DU LỊCH XUẤT NHẬP KHẨU CUỘC SỐNG',
        'address'       => 'H14 Quang Trung, Phường 11, Quận Gò Vấp, TPHCM',
        'hotline'       => '0912 014 151',
        'website'       => 'https://condaofile.com',
        'email'         => 'dichvucondao@gmail.com'
    ],
    'hotel_time_receive' => [
        'Tôi chưa biết', '14h00 - 15h00', '15h00 - 16h00', '16h00 - 17h00', '17h00 - 18h00', '18h00 - 19h00', '20h00 - 21h00', '21h00 - 22h00', '22h00 - 23h00', '23h00 - 00h00', '00h00 - 01h00 (hôm sau)', '01h00 - 02h00 (hôm sau)'
    ]
];