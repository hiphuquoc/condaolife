@if(!empty($list)&&$list->isNotEmpty())
    <div class="partnerBox">
        {{-- <div class="partnerBox_content">
            <div class="partnerBox_content_title">
                <h2 class="sectionBox_title">{{ $title ?? null }}</h2>
            </div>
            <div class="partnerBox_content_desc maxLine_5">
                {!! $description ?? null !!}
            </div>
        </div> --}}
        <div id="js_autoMoveTransformLeft_contact" class="partnerBox_list">
            @foreach($list as $item)
                <div class="partnerBox_list_item">
                    <a href="/{{ $item->seo->slug_full ?? null }}" title="{{ $item->name ?? $item->seo->title ?? $item->seo->seo_title ?? null }}">
                        <img src="{{ config('main.svg.loading_main') }}" data-src="{{ $item->company_logo ?? $item->seo->image_small ?? $item->seo->image ?? config('admin.images.default_750x460') }}" alt="{{ $item->name ?? $item->seo->title ?? $item->seo->seo_title ?? null }}" title="{{ $item->name ?? $item->seo->title ?? $item->seo->seo_title ?? null }}" />
                    </a>
                </div>
            @endforeach
        </div>
    </div>
    @push('scripts-custom')
        <script type="text/javascript">
            $(document).ready(function(){
                autoMoveTransformLeft('js_autoMoveTransformLeft_contact', 185, 0, 3000);
            })
            function autoMoveTransformLeft(id, range, timeMove, delayMove){
                var elemt	= $('#'+id);
                var nod		= elemt.children(':first-child');
                var lef		= parseInt(elemt.css('left'));
                setTimeout(function(){
                    elemt.animate({left: '-'+range+'px'}, timeMove, 'swing', function(){
                        $(this).append(nod);
                        autoMoveTransformLeft(id, range, timeMove, delayMove);
                        $(this).css('left', '0px');
                    });
                }, delayMove);
            }
        </script>
    @endpush
@endif
