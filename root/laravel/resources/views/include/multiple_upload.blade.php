{!! Form::hidden('filepathes['.$number.']', $data->filepath, ['class' => 'bulletUploadedFilepath', 'data-num' => $number]) !!}
<div class="params params-top">
    <div class="param param-40 param-mr-sm">
        {!! \MyHTML::ThumbnailSquare( $data->filepath, ['class' => 'bulletUploadedImage', 'data-num' => $number] ) !!}
    </div>

    <div class="param param-60 ajaxing__upload-box">
        <div class="ajaxing__upload-box__drag-area trigAjaxingUploadingArea" data-num="{{ $number }}">
            ここにファイルをドラッグしてください。
            <span class="ajaxing__upload-box__drag-enter bulletAjaxingDragEnters" data-num="{{ $number }}">
                <span class="ajaxing__upload-box__body">ここにファイルをドラッグしてください</span>
                <span class="ajaxing__upload-box__icon"><i class="fa fa-arrow-circle-o-down"></i></span>
            </span>
            <div class="ajaxing__upload-box__drag-cover bulletAjaxingDragEnters" data-num="{{ $number }}">
            </div>
        </div>

        <button type="button" class="btn ajaxing__upload-box__btn-input trigAjaxingUploadingBtn">ファイル</button>
        <input type="file" multiple="multiple" class="ajaxing__upload-box__fake-input bulletFakeInput" data-type="image" data-target="{{ $target }}" data-ajaxing="0" data-num="{{ $number }}">
        {!! Form::hidden('upload_ids['.$number.']', '', ['class' => 'bulletUploadId', 'data-num' => $number]) !!}
    </div>
</div>
