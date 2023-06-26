<input type="hidden" name="feedback_info_id" value="{{ !empty($item->id)&&$type=='edit' ? $item->id : null }}" />

<div class="formBox">
    <div class="formBox_full">
        <!-- One Row -->
        <div class="formBox_column2_item_row">
            <span data-toggle="tooltip" data-placement="top" title="
                Đây là Tiêu đề của Bài viết được hiển thị trên website
            ">
                <i class="explainInput" data-feather='alert-circle'></i>
                <label class="form-label inputRequired" for="title">Tên người đánh giá</label>
            </span>
            <input type="text" class="form-control" id="title" name="title" value="{{ old('title') ?? $item->name ?? '' }}" required>
            <div class="invalid-feedback">{{ config('admin.massage_validate.not_empty') }}</div>
        </div>
        <!-- One Row -->
        <div class="formBox_column2_item_row">
            <span data-toggle="tooltip" data-placement="top" title="
                Đây là Tiêu đề của Bài viết được hiển thị trên website
            ">
                <i class="explainInput" data-feather='alert-circle'></i>
                <label class="form-label inputRequired" for="phone">Số điện thoại</label>
            </span>
            <input type="text" class="form-control" id="phone" name="phone" value="{{ old('phone') ?? $item->phone ?? '' }}" required>
            <div class="invalid-feedback">{{ config('admin.massage_validate.not_empty') }}</div>
        </div>
        <!-- One Row -->
        <div class="formBox_column2_item_row">
            <span data-toggle="tooltip" data-placement="top" title="
                Đây là Mô tả của Bài viết được hiển thị trên website
            ">
                <i class="explainInput" data-feather='alert-circle'></i>
                <label class="form-label inputRequired" for="description">Nội dung đánh giá</label>
            </span>
            <textarea class="form-control" id="description"  name="description" rows="5" required>{{ old('description') ?? $item->content ?? '' }}</textarea>
            <div class="invalid-feedback">{{ config('admin.massage_validate.not_empty') }}</div>
        </div>
        <!-- One Row -->
        <div class="formBox_column2_item_row">
            <span data-toggle="tooltip" data-placement="top" title="
                Nhập vào một số để thể hiện độ ưu tiên khi hiển thị cùng các Category khác (Số càng nhỏ càng ưu tiên cao - Để trống tức là không ưu tiên)
            ">
                <i class="explainInput" data-feather='alert-circle'></i>
                <label class="form-label" for="ordering">Thứ tự</label>
            </span>
            <input type="number" min="0" id="ordering" class="form-control" name="ordering" value="{{ old('ordering') ?? $item->seo['ordering'] ?? '' }}">
        </div>
        <!-- One Row -->
        <div class="formBox_column2_item_row">
            <div class="form-check form-check-success">
                <input type="checkbox" class="form-check-input" id="status" name="status" {{ !empty($item->status) ? 'checked' : null }}>
                <label class="form-check-label" for="status">Cho phép hiển thị</label>
            </div>
        </div>
       
    </div>
</div>