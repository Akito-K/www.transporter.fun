@extends('layouts.admin')
@section('content')
@include('include.calendar')

    {!! MyHTML::errorMessage($errors) !!}
    {!! MyHTML::flashMessage() !!}

    <div class="box news">
        <div class="box-body news__block">
            <h2 class="page-header">評価項目登録</h2>

            {!! Form::open(['url' => 'admin/evaluation_item/insert']) !!}

                <table>
                    <tr>
                        <th>評価対象</th>
                        <td>{!! Form::select('target', $targets, old('target'), ['id' => 'input-name', 'class' => 'form-control']) !!}</td>
                    </tr>
                    <tr>
                        <th>項目名</th>
                        <td>{!! Form::text('name', old('name'), ['id' => 'input-name', 'class' => 'form-control', 'placeholder' => '']) !!}</td>
                    </tr>
                    <tr>
                        <th>有効期限</th>
                        <td>
                            <div class="date-input-wrap">
                                <div class="date-input trigShowCalendar" data-calendar="validated">
                                    {!! Form::text('validated_at', '', ['id' => 'validated_at', 'placeholder' => '開始日', 'class' => 'form-control', 'readonly' => 'readonly']) !!}
                                    {!! Form::hidden('hide_validated_at', '', ['id' => 'hide_validated_at']) !!}
                                    <i class="fa fa-calendar"></i>
                                </div>
                                <div class="date-input date-input--space">～</div>
                                <div class="date-input trigShowCalendar" data-calendar="period">
                                    {!! Form::text('period_at', '', ['id' => 'period_at', 'placeholder' => '最終日', 'class' => 'form-control', 'readonly' => 'readonly']) !!}
                                    {!! Form::hidden('hide_period_at', '', ['id' => 'hide_period_at']) !!}
                                    <i class="fa fa-calendar"></i>
                                </div>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <th>適用</th>
                        <td>{!! Form::checkbox('publish',1 , old('publish'), ['id' => 'input-publish']) !!} する</td>
                    </tr>

                </table>

                {!! Form::submit('この内容で登録する', ['class' => 'btn btn-block btn-warning btn-submit'] ) !!}

            {!! Form::close() !!}

        </div>
    </div>

    <a href="{{ url('') }}/admin/evaluation_item" class="btn btn-block btn-primary">戻る</a>
@endsection
