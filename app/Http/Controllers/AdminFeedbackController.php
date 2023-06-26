<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Feedback;
use App\Models\Seo;
use App\Http\Requests\FeedbackRequest;
use App\Services\BuildInsertUpdateModel;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Cookie;

class AdminFeedbackController extends Controller {

    public function __construct(BuildInsertUpdateModel $BuildInsertUpdateModel){
        $this->BuildInsertUpdateModel  = $BuildInsertUpdateModel;
    }

    public function list(Request $request){
        $params             = [];
        /* Search theo tên */
        if(!empty($request->get('search_name'))) $params['search_name'] = $request->get('search_name');
        /* paginate */
        $viewPerPage        = Cookie::get('viewFeedbackInfo') ?? 50;
        $params['paginate'] = $viewPerPage;
        $list               = Feedback::getList($params);
        return view('admin.feedback.list', compact('list', 'params', 'viewPerPage'));
    }

    public function view(Request $request){
        $id             = $request->get('id') ?? 0;
        $item           = Feedback::select('*')
                            ->where('id', $id)
                            ->with('seo')
                            ->first();
        /* type */
        $type           = !empty($item) ? 'edit' : 'create';
        $type           = $request->get('type') ?? $type;
        return view('admin.feedback.view', compact('item', 'type'));
    }

    public function create(FeedbackRequest $request){
        try {
            DB::beginTransaction();
            /* insert seo */
            $insertSeo          = $this->BuildInsertUpdateModel->buildArrayTableSeo($request->all(), 'feedback_info');
            $seoId              = Seo::insertItem($insertSeo);
            /* insert feedback_info */
            $insertFeedback     = $this->BuildInsertUpdateModel->buildArrayTableFeedbackInfo($request->all(), $seoId);
            $idFeedback             = Feedback::insertItem($insertFeedback);
            DB::commit();
            /* Message */
            $message        = [
                'type'      => 'success',
                'message'   => '<strong>Thành công!</strong> Dã tạo Feedback thành công'
            ];
        } catch (\Exception $exception){
            DB::rollBack();
            /* Message */
            $message        = [
                'type'      => 'danger',
                'message'   => '<strong>Thất bại!</strong> Có lỗi xảy ra, vui lòng thử lại'
            ];
        }
        $request->session()->put('message', $message);
        return redirect()->route('admin.feedback.view', ['id' => $idFeedback]);
    }

    public function update(FeedbackRequest $request){
        try {
            DB::beginTransaction();
            $idFeedback         = $request->get('feedback_info_id');
            /* update page */
            $updateSeo          = $this->BuildInsertUpdateModel->buildArrayTableSeo($request->all(), 'feedback_info');
            Seo::updateItem($request->get('seo_id'), $updateSeo);
            /* update Feedback */
            $updateFeedback     = $this->BuildInsertUpdateModel->buildArrayTableFeedbackInfo($request->all(), $request->get('seo_id'));
            Feedback::updateItem($idFeedback, $updateFeedback);
            DB::commit();
            /* Message */
            $message        = [
                'type'      => 'success',
                'message'   => '<strong>Thành công!</strong> Các thay đổi đã được lưu'
            ];
        } catch (\Exception $exception){
            DB::rollBack();
            /* Message */
            $message        = [
                'type'      => 'danger',
                'message'   => '<strong>Thất bại!</strong> Có lỗi xảy ra, vui lòng thử lại'
            ];
        }
        $request->session()->put('message', $message);
        return redirect()->route('admin.feedback.view', ['id' => $idFeedback]);
    }

    public function delete(Request $request){
        if(!empty($request->get('id'))){
            try {
                DB::beginTransaction();
                $id         = $request->get('id');
                $info       = Feedback::select('*')
                                ->where('id', $id)
                                ->with('seo')
                                ->first();
                /* delete bảng seo */
                Seo::find($info->seo->id)->delete();
                $info->delete();
                DB::commit();
                return true;
            } catch (\Exception $exception){
                DB::rollBack();
                return false;
            }
        }
    }
}
