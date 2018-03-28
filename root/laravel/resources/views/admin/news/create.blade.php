@extends('layouts.admin')
@section('content')
@include('include.calendar')

    {!! MyHTML::errorMessage($errors) !!}
    {!! MyHTML::flashMessage() !!}

    <div class="box news">
        <div class="box-body news__block">
            <h2 class="page-header">更新情報登録</h2>

            {!! Form::open(['url' => 'admin/news/insert']) !!}
                <table>
                    <tr>
                        <th>日付</th>
                        <td>
                            <div class="date-input trigShowCalendar" data-calendar="date">
                                {!! Form::text('date_at', '', ['id' => 'date_at', 'placeholder' => '日付', 'class' => 'form-control', 'readonly' => 'readonly']) !!}
                                {!! Form::hidden('hide_date_at', '', ['id' => 'hide_date_at']) !!}
                                <i class="fa fa-calendar"></i>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <th>タイトル</th>
                        <td>{!! Form::text('title', old('title'), ['id' => 'input-title', 'class' => 'form-control', 'placeholder' => 'タイトル']) !!}</td>
                    </tr>
                    <tr>
                        <th>本文</th>
                        <td>{!! Form::textarea('body', old('body'), ['id' => 'input-body', 'class' => 'form-control', 'placeholder' => '本文']) !!}</td>
                    </tr>
                    <tr>
                        <th>掲載期間</th>
                        <td>
                            <div class="date-input-wrap">
                                <div class="date-input trigShowCalendar" data-calendar="publish_start">
                                    {!! Form::text('publish_start_at', '', ['id' => 'publish_start_at', 'placeholder' => '掲載開始日', 'class' => 'form-control', 'readonly' => 'readonly']) !!}
                                    {!! Form::hidden('hide_publish_start_at', '', ['id' => 'hide_publish_start_at']) !!}
                                    <i class="fa fa-calendar"></i>
                                </div>
                                <div class="date-input date-input--space">～</div>
                                <div class="date-input trigShowCalendar" data-calendar="publish_close">
                                    {!! Form::text('publish_close_at', '', ['id' => 'publish_close_at', 'placeholder' => '掲載最終日', 'class' => 'form-control', 'readonly' => 'readonly']) !!}
                                    {!! Form::hidden('hide_publish_close_at', '', ['id' => 'hide_publish_close_at']) !!}
                                    <i class="fa fa-calendar"></i>
                                </div>
                            </div>
                        </td>
                    </tr>
                </table>

                {!! Form::submit('この内容で登録する', ['class' => 'btn btn-block btn-warning btn-submit'] ) !!}

            {!! Form::close() !!}

            </div>
            </div>

            <a href="{{ url('') }}/admin/news" class="btn btn-block btn-primary">戻る</a>

@endsection
