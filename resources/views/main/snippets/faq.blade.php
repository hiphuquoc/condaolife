@if($list->isNotEmpty())
    <div class="faqBox">
        @if(!empty($hiddenTitle)&&$hiddenTitle==true)
            
        @else 
            <div class="faqBox_title">
                <h2 class="sectionBox_title">Câu hỏi thường gặp về {{ $item->name ?? null }}</h2>
            </div>
        @endif
        <div class="faqBox_content">
            @foreach($list as $faq)
                <div class="faqBox_content_item">
                    <div class="faqBox_content_item_question on">
                        <h3>{{ ($loop->index+1).'. '.$faq->question }}</h3>
                    </div>
                    <div class="faqBox_content_item_answer">
                        {!! $faq->answer !!}
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endif

@push('scripts-custom')
    <script type="text/javascript">
        $('.faqBox_content_item_question').on('click', function(){
            const elementButton     = $(this);
            const elementContent    = $(this).next();
            const displayContent    = elementContent.css('display');
            if(displayContent=='none'){
                elementButton.removeClass('on').addClass('off');
                elementContent.css('display', 'block');
            }else {
                elementButton.removeClass('off').addClass('on');
                elementContent.css('display', 'none');
            }
        });
    </script>

@endpush