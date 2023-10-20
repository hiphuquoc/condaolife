<?php

namespace App\Http\Controllers;

use App\Http\Controllers\AdminImageController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\TourLocation;
use App\Models\AirLocation;
use App\Models\Tour;
use App\Models\Combo;
use App\Models\Blog;
use App\Models\Feedback;
use App\Models\ShipPartner;
use App\Models\AirPartner;
use App\Models\TourPartner;
use App\Models\Seo;
use App\Models\TourTimetable;
use App\Models\TourTimetableForeign;
use App\Models\TourContent;
use App\Models\TourContentForeign;
use Illuminate\Support\Facades\Storage;

use App\Jobs\CheckSeo;
use App\Models\Redirect;

class HomeController extends Controller {

    public function home(){
        /* cache HTML */
        $nameCache              = 'home.'.config('main.cache.extension');
        $pathCache              = Storage::path(config('main.cache.folderSave')).$nameCache;
        $cacheTime    	        = 1800;
        if(file_exists($pathCache)&&$cacheTime>(time() - filectime($pathCache))){
            $xhtml = file_get_contents($pathCache);
        }else {
            $item               = Seo::select('*')
                                    ->where('slug', '')
                                    ->first();
            $airLocations       = AirLocation::select('*')
                                    ->with('seo')
                                    ->get();
            $tours              = Tour::select('*')
                                    ->get();
            $itemTourLocation   = TourLocation::select('*')
                                    ->whereHas('seo', function($q) {
                                        $q->where('slug', 'tour-du-lich-con-dao');
                                    })
                                    ->with('tours.infoTour', function($query){
                                        $query->where('status_show', 1);
                                    })
                                    ->with(['files' => function($query){
                                        $query->where('relation_table', 'tour_location');
                                    }])
                                    ->with(['questions' => function($q){
                                        $q->where('relation_table', 'tour_location');
                                    }])
                                    ->with('seo', 'airLocations', 'guides', 'shipLocations', 'carrentalLocations', 'serviceLocations', 'comboLocations', 'destinations', 'specials')
                                    ->first();
            $combos             = Combo::select('combo_info.*')
                                    ->whereHas('locations.infoLocation.seo', function($query){
                                        $query->where('slug', 'combo-du-lich-con-dao');
                                    })
                                    ->join('seo', 'seo.id', '=', 'combo_info.seo_id')
                                    ->with('locations.infoLocation')
                                    ->orderBy('ordering', 'DESC')
                                    ->orderBy('combo_info.id', 'DESC')
                                    ->get();
            $specialLocations   = Blog::select('*')
                                    ->whereHas('categories.infoCategory.seo', function($query){
                                        $query->where('slug', 'diem-den-con-dao');
                                    })
                                    ->with('seo')
                                    ->get();
            /* đối tác */
            $shipPartners       = ShipPartner::select('*')
                                    ->with('seo');
            $airPartners        = AirPartner::select('*')
                                    ->with('seo');
            $partners           = $shipPartners->union($airPartners)->get();
            /* feedback */
            $feedbacks          = Feedback::select('*')
                                    ->where('status', 1)
                                    ->get();
            $xhtml  = view('main.home.home', compact('item', 'itemTourLocation', 'tours', 'combos', 'airLocations', 'specialLocations', 'partners', 'feedbacks'))->render();
            if(env('APP_CACHE_HTML')==true) Storage::put(config('main.cache.folderSave').$nameCache, $xhtml);
        }
        echo $xhtml;
    }

    /* ===== Tính năng thay tất cả các ảnh hỗ trợ Loading ===== */
    public static function changeImageInContentWithLoading(){
        $data           = glob(Storage::path('/public/contents').'/*');
        $fileSuccess    = [];
        $fileError      = [];
        foreach($data as $child){
            $dataChild  = glob($child.'/*');
            foreach($dataChild as $fileName){
                $flag   = self::actionChangeImageInContentWithLoading($fileName);
                if($flag==true) {
                    $fileSuccess[]  = $fileName;
                }else {
                    $fileError[]    = $fileName;
                }
            }
        }
    }
    public static function actionChangeImageInContentWithLoading($fileName){
        if(!empty($fileName)){
            $content        = file_get_contents($fileName);
            $content        = AdminImageController::replaceImageInContentWithLoading($content);
            return file_put_contents($fileName, $content);
        }
        return false;
    }
    public static function changeImageInContentWithLoadingTourInfo(){
        /* cập nhật content bảng tour_timetable */
        $data           = TourTimetable::select('*')
                            ->get();
        foreach($data as $item){
            $params     = [
                'content'           => AdminImageController::replaceImageInContentWithLoading($item->content),
                'content_sort'      => AdminImageController::replaceImageInContentWithLoading($item->content_sort)
            ];
            TourTimetable::updateItem($item->id, $params);
        }
        /* cập nhật content bảng tour_timetable_foreign */
        $data           = TourTimetableForeign::select('*')
                            ->get();
        foreach($data as $item){
            $params     = [
                'content'           => AdminImageController::replaceImageInContentWithLoading($item->content),
                'content_sort'      => AdminImageController::replaceImageInContentWithLoading($item->content_sort)
            ];
            TourTimetableForeign::updateItem($item->id, $params);
        }
        /* cập nhật content bảng tour_content */
        $data           = TourContent::select('*')
                            ->get();
        foreach($data as $item){
            $params     = [
                'special_content'   => AdminImageController::replaceImageInContentWithLoading($item->special_content),
                'special_list'      => AdminImageController::replaceImageInContentWithLoading($item->special_list),
                'include'           => AdminImageController::replaceImageInContentWithLoading($item->include),
                'not_include'       => AdminImageController::replaceImageInContentWithLoading($item->not_include),
                'policy_child'      => AdminImageController::replaceImageInContentWithLoading($item->policy_child),
                'menu'              => AdminImageController::replaceImageInContentWithLoading($item->menu),
                'hotel'             => AdminImageController::replaceImageInContentWithLoading($item->hotel),
                'policy_cancel'     => AdminImageController::replaceImageInContentWithLoading($item->policy_cancel)
            ];
            TourContent::updateItem($item->id, $params);
        }
        /* cập nhật content bảng tour_content_foreign */
        $data           = TourContentForeign::select('*')
                            ->get();
        foreach($data as $item){
            $params     = [
                'special_content'   => AdminImageController::replaceImageInContentWithLoading($item->special_content),
                'special_list'      => AdminImageController::replaceImageInContentWithLoading($item->special_list),
                'include'           => AdminImageController::replaceImageInContentWithLoading($item->include),
                'not_include'       => AdminImageController::replaceImageInContentWithLoading($item->not_include),
                'policy_child'      => AdminImageController::replaceImageInContentWithLoading($item->policy_child),
                'menu'              => AdminImageController::replaceImageInContentWithLoading($item->menu),
                'hotel'             => AdminImageController::replaceImageInContentWithLoading($item->hotel),
                'policy_cancel'     => AdminImageController::replaceImageInContentWithLoading($item->policy_cancel)
            ];
            TourContentForeign::updateItem($item->id, $params);
        }
    }
    /* reset tất cả checkOnpage đưa vào Job */
    public static function checkOnpageAll(){
        $seos   = Seo::select('id')
                    ->get();
        foreach($seos as $seo){
            CheckSeo::dispatch($seo->id);
        }
        return \Illuminate\Support\Facades\Redirect::to(route('main.home'), 301);
    }

    public static function testHtml(){
        
        \App\Jobs\DownloadCommentHotelInfo::dispatch(3, 0);
    }
}
