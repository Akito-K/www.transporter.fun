@extends('layouts.carrier')
@section('content')

{!! MyHTML::errorMessage($errors) !!}
{!! MyHTML::flashMessage() !!}

<div class="box news">
    <div class="box-body">
        <h2 class="page-header">見積用商品編集</h2>

        {!! Form::open(['url' => 'carrier/item/update', 'class' => 'item__block']) !!}
            {!! \Form::hidden('item_id', $data->item_id) !!}

            <div class="item__box">
                <ul class="lists">
                    <li class="list list-title">型番</li>
                    <li class="list list-value">
                        {!! \Form::text('code', old('code')?: $data->code, ['class' => 'form-control form-control--mini form-control--70']) !!}
                    </li>
                </ul>
                <ul class="lists">
                    <li class="list list-title">名称</li>
                    <li class="list list-value">
                        {!! \Form::text('name', old('name')?: $data->name, ['class' => 'form-control form-control--mini form-control--70']) !!}
                    </li>
                </ul>
                <ul class="lists">
                    <li class="list list-title">単価</li>
                    <li class="list list-value">
                        ￥ {!! \Form::number('amount', old('amount')?: $data->amount, ['class' => 'form-control form-control--mini form-control--70']) !!}
                    </li>
                </ul>
                <ul class="lists">
                    <li class="list list-title">特記事項</li>
                    <li class="list list-value">
                        {!! \Form::textarea('notes', old('notes')?: $data->notes, ['class' => 'form-control']) !!}
                    </li>
                </ul>

            </div>
            {!! Form::submit('この内容で登録する', ['class' => 'btn btn-block btn-warning btn-submit'] ) !!}

        {!! Form::close() !!}

    </div>
</div>

<a href="{{ url('') }}/carrier/item" class="btn btn-block btn-primary">一覧に戻る</a>

@endsection
