<div class="stickyBox">

   <div class="callBookTour">
      @include('main.template.callbook', ['button' => 'Đặt xe', 'flagButton' => false])
   </div>

   @php
       $flagMargin   = null;
   @endphp
   @if(!empty($item->tourLocations)&&$item->tourLocations->isNotEmpty())
      @php
         $flagMargin   = 'margin-top:1.5rem;';
      @endphp
      <div class="serviceRelatedSidebarBox" style="margin-top:1.5rem;">
         <div class="serviceRelatedSidebarBox_title">
            <h2>{{ config('main.title_list_service_sidebar') }}</h2>
         </div>
         <div class="serviceRelatedSidebarBox_box">
            <!-- tour du lịch -->
            @foreach($item->tourLocations as $tourLocation)
               <a href="/{{ $tourLocation->infoTourLocation->seo->slug_full ?? null }}" title="{{ $tourLocation->infoTourLocation->name ?? $tourLocation->infoTourLocation->seo->title ?? null }}" class="serviceRelatedSidebarBox_box_item">
                  <i class="fa-solid fa-person-hiking"></i><h3>{{ $tourLocation->infoTourLocation->name ?? $tourLocation->infoTourLocation->seo->title ?? null }}</h3>
               </a>
            @endforeach

            <!-- combo du lịch -->
            @foreach($item->tourLocations as $tourLocation)
               @if(!empty($tourLocation->infoTourLocation->comboLocations)&&$tourLocation->infoTourLocation->comboLocations->isNotEmpty())
                  @foreach($tourLocation->infoTourLocation->comboLocations as $comboLocation)
                     <a href="/{{ $comboLocation->infoComboLocation->seo->slug_full ?? null }}" title="{{ $airLocation->infoComboLocation->name ?? $comboLocation->infoComboLocation->seo->title ?? null }}" class="serviceRelatedSidebarBox_box_item">
                        <i class="fa-solid fa-award"></i><h3>{{ $comboLocation->infoComboLocation->name ?? $comboLocation->infoComboLocation->seo->title ?? null }}</h3>
                     </a>
                  @endforeach
               @endif
            @endforeach

            <!-- vé máy bay -->
            @foreach($item->tourLocations as $tourLocation)
               @if(!empty($tourLocation->infoTourLocation->airLocations)&&$tourLocation->infoTourLocation->airLocations->isNotEmpty())
                  @foreach($tourLocation->infoTourLocation->airLocations as $airLocation)
                     <a href="/{{ $airLocation->infoAirLocation->seo->slug_full ?? null }}" title="{{ $airLocation->infoAirLocation->name ?? $airLocation->infoAirLocation->seo->title ?? null }}" class="serviceRelatedSidebarBox_box_item">
                        <i class="fa-solid fa-paper-plane"></i><h3>{{ $airLocation->infoAirLocation->name ?? $airLocation->infoAirLocation->seo->title ?? null }}</h3>
                     </a>
                  @endforeach
               @endif
            @endforeach

            <!-- tàu cao tốc -->
            @foreach($item->tourLocations as $tourLocation)
               @if(!empty($tourLocation->infoTourLocation->shipLocations)&&$tourLocation->infoTourLocation->shipLocations->isNotEmpty())
                  @foreach($tourLocation->infoTourLocation->shipLocations as $shipLocation)
                     <a href="/{{ $shipLocation->infoShipLocation->seo->slug_full }}" title="{{ $shipLocation->infoShipLocation->name ?? $shipLocation->infoShipLocation->seo->title ?? null }}" class="serviceRelatedSidebarBox_box_item">
                        <i class="fa-solid fa-ship"></i><h3>{{ $shipLocation->infoShipLocation->name ?? $shipLocation->infoShipLocation->seo->title ?? null }}</h3>
                     </a>
                  @endforeach
               @endif
            @endforeach

            <!-- vé vui chơi -->
            @foreach($item->tourLocations as $tourLocation)
               @if(!empty($tourLocation->infoTourLocation->serviceLocations)&&$tourLocation->infoTourLocation->serviceLocations->isNotEmpty())
                  @foreach($tourLocation->infoTourLocation->serviceLocations as $serviceLocation)
                     <a href="/{{ $serviceLocation->infoServiceLocation->seo->slug_full ?? null }}" title="{{ $serviceLocation->infoServiceLocation->name ?? $serviceLocation->infoServiceLocation->seo->title ?? null }}" class="serviceRelatedSidebarBox_box_item">
                        <i class="fa-solid fa-star"></i><h3>{{ $serviceLocation->infoServiceLocation->name ?? $serviceLocation->infoServiceLocation->seo->title ?? null }}</h3>
                     </a>
                  @endforeach
               @endif
            @endforeach

            <!-- cẩm nang du lịch -->
            @foreach($item->tourLocations as $tourLocation)
               @if(!empty($tourLocation->infoTourLocation->guides)&&$tourLocation->infoTourLocation->guides->isNotEmpty())
                  @foreach($tourLocation->infoTourLocation->guides as $guide)
                     <a href="/{{ $guide->infoGuide->seo->slug_full ?? null }}" title="{{ $guide->infoGuide->name ?? $guide->infoGuide->seo->title ?? null }}" class="serviceRelatedSidebarBox_box_item">
                        <i class="fa-solid fa-book"></i><h3>{{ $guide->infoGuide->name ?? $guide->infoGuide->seo->title ?? null }}</h3>
                     </a>
                  @endforeach
               @endif
            @endforeach
            
            {{-- <a href="#" class="serviceRelatedSidebarBox_box_item">
               <i class="fa-solid fa-building"></i><h3>Khách sạn Phú Quốc</h3>
            </a>
            <a href="#" class="serviceRelatedSidebarBox_box_item">
               <i class="fa-solid fa-plane-departure"></i><h3>Vé máy bay</h3>
            </a> --}}
         </div>
      </div>
   @endif

   <div id="js_buildTocContentSidebar_idWrite" class="tocContentTour customScrollBar-y" style="{{ $flagMargin }}">
      <!-- loadTocContent ajax -->
   </div>

</div>