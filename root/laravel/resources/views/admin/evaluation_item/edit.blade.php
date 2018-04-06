@extends('layouts.admin')
@section('content')
@include('include.calendar')

    {!! MyHTML::errorMessage($errors) !!}
    {!! MyHTML::flashMessage() !!}

    <div class="box news">
        <div class="box-body news__block">
            <h2 class="page-header">評価項目編集</h2>

            {!! Form::open(['url' => 'admin/evaluation_item/update']) !!}
                {!! Form::hidden('item_id', $data->item_id) !!}

                <table>
                    <tr>
                        <th>評価対象</th>
                        <td>{!! Form::select('target', $targets, $data->target, ['id' => 'input-name', 'class' => 'form-control']) !!}</td>
                    </tr>
                    <tr>
                        <th>項目名</th>
                        <td>{!! Form::text('name', $data->name, ['id' => 'input-name', 'class' => 'form-control', 'placeholder' => '']) !!}</td>
                    </tr>
                    <tr>
                        <th>掲載期間</th>
                        <td>
                            <div class="date-input-wrap">
                                <div class="date-input trigShowCalendar" data-calendar="validated">
                                    {!! Form::text('validated_at', \Func::dateFormat($data->validated_at, 'Y/n/j(wday)'), ['id' => 'validated_at', 'placeholder' => '開始日', 'class' => 'form-control', 'readonly' => 'readonly']) !!}
                                    {!! Form::hidden('hide_validated_at', \Func::dateFormat($data->validated_at), ['id' => 'hide_validated_at']) !!}
                                    <i class="fa fa-calendar"></i>
                                </div>
                                <div class="date-input date-input--space">～</div>
                                <div class="date-input trigShowCalendar" data-calendar="period">
                                    {!! Form::text('period_at', \Func::dateFormat($data->period_at, 'Y/n/j(wday)'), ['id' => 'period_at', 'placeholder' => '最終日', 'class' => 'form-control', 'readonly' => 'readonly']) !!}
                                    {!! Form::hidden('hide_period_at', \Func::dateFormat($data->period_at), ['id' => 'hide_period_at']) !!}
                                    <i class="fa fa-calendar"></i>
                                </div>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <th>適用</th>
                        <td>{!! Form::checkbox('publish', 1, $data->published_at? true: false, ['id' => 'input-publish']) !!} <label for="input-publish">する</label></td>
                    </tr>

                </table>

                {!! Form::submit('この内容で登録する', ['class' => 'btn btn-block btn-warning btn-submit'] ) !!}

            {!! Form::close() !!}

        </div>
    </div>

    <a href="{{ url('') }}/admin/evaluation_item" class="btn btn-block btn-primary">戻る</a>


@endsection
