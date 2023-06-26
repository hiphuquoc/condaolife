@if(!empty($feedbacks)&&$feedbacks->isNotEmpty())
    <div class="feedbackBox {{ !empty($addClass) ? $addClass : null }}">
        @foreach($feedbacks as $feedback)
            @php
                $phone      = $feedback->phone ?? null;
                if(!empty($phone)) $phone  = substr($phone, 0, -3).'***';
            @endphp
            <div class="feedbackBox_item">
                <div class="feedbackBox_item_head">
                    <div class="feedbackBox_item_head_icon" style="background:url('{{ Storage::url('images/svg/icon-user.png') }}') no-repeat;background-size:100% 100%;"></div>
                    <div class="feedbackBox_item_head_info">
                        <div class="feedbackBox_item_head_info_name">
                            {{ $feedback->name ?? null }} - {{ $phone }}
                        </div>
                        <div class="feedbackBox_item_head_info_date">
                            {{ date('H:i\, d/m/Y', strtotime($feedback->created_at)) }}
                        </div>
                    </div>
                </div>
                <div class="feedbackBox_item_body maxLine_10">
                    {{ $feedback->content ?? null }}
                </div>
                <a href="/{{ $feedback->seo->slug_full ?? null }}" class="feedbackBox_item_footer">
                    Xem chi tiết<i class="fa-solid fa-angle-right"></i>
                </a>
            </div>
        @endforeach
        @foreach($feedbacks as $feedback)
            @php
                $phone      = $feedback->phone ?? null;
                if(!empty($phone)) $phone  = substr($phone, 0, -3).'***';
            @endphp
            <div class="feedbackBox_item">
                <div class="feedbackBox_item_head">
                    <div class="feedbackBox_item_head_icon" style="background:url('{{ Storage::url('images/svg/icon-user.png') }}') no-repeat;background-size:100% 100%;"></div>
                    <div class="feedbackBox_item_head_info">
                        <div class="feedbackBox_item_head_info_name">
                            {{ $feedback->name ?? null }} - {{ $phone }}
                        </div>
                        <div class="feedbackBox_item_head_info_date">
                            {{ date('H:i\, d/m/Y', strtotime($feedback->created_at)) }}
                        </div>
                    </div>
                </div>
                <div class="feedbackBox_item_body maxLine_10">
                    {{ $feedback->content ?? null }}
                </div>
                <a href="/{{ $feedback->seo->slug_full ?? null }}" class="feedbackBox_item_footer">
                    Xem chi tiết<i class="fa-solid fa-angle-right"></i>
                </a>
            </div>
        @endforeach
    </div>
@endif