<div class="headerMain">
   <div class="container">
      <div class="headerMain_logo">
         <a href="/" class="logoMain" aria-label="Trang du lịch Côn Đảo {{ env('LOCAL_VN') }}">
            @php
               $titlePage = null;
               if(!empty($item)&&$item->slug==null) $titlePage = '<h1 style="display:none;">Trang du lịch Côn Đảo '.env('LOCAL_VN').'</h1>';
            @endphp
            {!! $titlePage !!}
         </a>
      </div>
      <!-- header main desktop -->
      <div class="hide-1199 headerMain_item">
         @php
            $listMenu = [
               [
                  'name'         => 'Tour Côn Đảo',
                  'url'          => '/tour-du-lich-con-dao',
                  'label'        => 'Tour Côn Đảo',
                  'icon'         => '<i class="fa-solid fa-person-hiking"></i>'
               ],
               [
                  'name'         => 'Combo Côn Đảo',
                  'url'          => '/combo-du-lich-con-dao',
                  'label'        => 'Combo Côn Đảo',
                  'icon'         => '<i class="fa-solid fa-award"></i>'
               ],
               [
                  'name'         => 'Khách sạn Côn Đảo',
                  'url'          => '/khach-san-con-dao',
                  'label'        => 'Khách sạn',
                  'icon'         => '<i class="fa-solid fa-hotel"></i>'
               ],
               [
                  'name'         => 'Vé tàu Côn Đảo',
                  'url'          => '/tau-cao-toc-con-dao',
                  'label'        => 'Vé tàu',
                  'icon'         => '<i class="fa-solid fa-ship"></i>'
               ],
               [
                  'name'         => 'Tin tức',
                  'url'          => '/tin-tuc-du-lich-con-dao',
                  'label'        => 'Tin tức',
                  'icon'         => '<i class="fa-solid fa-newspaper"></i>'
               ]
            ];
         @endphp
         <ul style="justify-content:flex-end;">
            @foreach($listMenu as $itemMenu)
               @php
                   $active = null;
                   if(Request::getRequestUri()==$itemMenu['url']) $active = 'active';
               @endphp
               <li>
                  <div>
                     <a href="{{ $itemMenu['url'] }}" class="{{ $active }}" title="{{ $itemMenu['label'] }}" aria-label="{{ $itemMenu['label'] }}">{{ $itemMenu['name'] }}</a>
                  </div>
               </li>
            @endforeach
            <li>
               <div>
                  <a href="/lien-he" title="liên hệ {{ config('main.name') }}">Liên hệ</a>
               </div>
            </li>
            {{-- <li>
               <div>
                  <i class="fa-solid fa-bars" style="font-size:1.4rem;margin-top:0.25rem;"></i>
               </div>
               <div class="normalMenu" style="margin-right:1.5rem;right:0;">
                  <ul>
                     <li>
                        <a href="/lien-he-Website {{ env('LOCAL_VN') }}" title="Liên hệ Website {{ env('LOCAL_VN') }}">
                           <div>Liên hệ</div>
                        </a>
                     </li>
                  </ul>
               </div>
            </li> --}}
         </ul>
      </div>
      <div class="show-1199 headerMain_item" onClick="openCloseElemt('nav-mobile')">
         <div style="padding:0.5rem;">
            <i class="fa-solid fa-bars" style="font-size:1.4rem;margin-top:0.25rem;"></i>
         </div>
      </div>
   </div>
</div>

<!-- Menu Mobile -->
<div id="nav-mobile" style="display:none;">
   <div class="nav-mobile">
      <div class="nav-mobile_bg" onclick="javascript:openCloseElemt('nav-mobile');"></div>
      <div class="nav-mobile_main customScrollBar-y">
         <div class="nav-mobile_main__exit" onclick="javascript:openCloseElemt('nav-mobile');">
            <i class="fas fa-times"></i>
         </div>
         <a href="/" title="Trang chủ {{ config('main.name') }}" style="display:flex;justify-content:center;margin-top:5px;margin-bottom:-10px;">
            <div class="logoSquare"></div>
         </a>
         <ul>
            <li>
               <a href="/" title="Trang chủ {{ config('main.name') }}">
                  <div><i class="fas fa-home"></i>Trang chủ</div>
                  <div class="right-icon"></div>
               </a>
            </li>
            @foreach($listMenu as $menu)
               <li>
                  <a href="{{ $menu['url'] }}">
                     {!! $menu['icon'] !!}
                     {{ $menu['name'] }}
                  </a>
                  {{-- <span class="right-icon" onclick="javascript:showHideListMenuMobile(this);"><i class="fas fa-chevron-right"></i></span>
                  <ul style="display:none;">
                     <li>
                        <a href="/tour-du-lich-chau-a" title="Châu Á">
                           <div>Châu Á</div>
                        </a>
                     </li>
                     <li>
                        <a href="/tour-du-lich-chau-au" title="Châu Âu">
                           <div>Châu Âu</div>
                        </a>
                     </li>
                     <li>
                        <a href="/tour-du-lich-chau-my" title="Châu Mỹ">
                           <div>Châu Mỹ</div>
                        </a>
                     </li>
                     <li>
                        <a href="/tour-du-lich-chau-uc" title="Châu Úc">
                           <div>Châu Úc</div>
                        </a>
                     </li>
                     <li>
                        <a href="/tour-du-lich-chau-phi" title="Châu Phi">
                           <div>Châu Phi</div>
                        </a>
                     </li>
                  </ul> --}}
               </li>
            @endforeach
            <li>
               <a href="/lien-he" title="Liên hệ {{ config('main.name') }}">
                  <i class="fa-solid fa-phone"></i>
                  <div>Liên hệ</div>
               </a>
            </li>
         </ul>
      </div>
   </div>
</div>