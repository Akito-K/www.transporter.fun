@extends('layouts.mypage')
@section('content')

{!! Form::hidden('', $your_data->hashed_id, ['id' => 'paramHashedId']) !!}

<div class="box">
    <div class="box-body board-area" id="board-area">

        <h2 class="page-header">コンタクトボード</h2>

        <div class="board__block">
            <div class="board__order">
                @include('include.board.you', ['data' => $your_data])
            </div>
            <!-- /.board__order -->

            <div class="board__content" id="board-content">
                <p class="board__content__bg"></p>

                <div class="board__content__button" id="bulletGetOver10Btn">
                    <button type="button" class="btn btn-success form-control--40" id="trigGetOver10">以前のメッセージを読み込む</button>
                </div>

                <div class="board__content__boxes board__content__boxes--over10" id="over10" data-board_id="{!! $board_id !!}">
                </div>

                <div class="board__content__boxes board__content__boxes--latest10" id="latest10">
                    @include('include.board.messages', ['messages' => $latest10, 'user' => $your_data])
                </div>

            </div>
            <!-- /.board__content -->

            <div class="board__input" id="board-input" data-user_hashed_id="{!! $your_data->hashed_id !!}">
                <ul class="board__input__lists">
                    <li class="board__input__list board__input__list--add">
                        <button type="button" class="board__input__list__add btn ajaxing__upload-box__btn-input trigAjaxingUploadingBtn"><i class="fa fa-plus"></i></button>
                    </li>
                    <li class="board__input__list board__input__list--input">
                        {!! \Form::textarea('new_message', '', ['class' => 'form-control board__input__list__input', 'id' => 'bulletMessage', 'placeholder' => 'ファイルをアップロードする場合、ファイル名を入力して下さい。']) !!}
                    </li>
                    <li class="board__input__list board__input__list--submit">
                        <button type="button" class="btn btn-primary form-control trigSubmitMessage" data-memo="0">送信</button>
                    </li>
                </ul>

                <input type="file" multiple="multiple" class="ajaxing__upload-box__fake-input" id="bulletFakeInput" data-type="all" data-target="board-file" data-ajaxing="0">
                {!! Form::hidden('uploaded_id', '', ['id' => 'uploaded_id']) !!}
            </div>
            <!-- /.board__input -->

        </div>
        <!-- /.board__block -->

    </div>
</div>
@endsection
