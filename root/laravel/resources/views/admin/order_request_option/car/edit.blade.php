@extends('layouts.admin')
@section('content')

    {!! MyHTML::errorMessage($errors) !!}
    {!! MyHTML::flashMessage() !!}

    <div class="box news">
        <div class="box-body news__block">
            <h2 class="page-header">希望車種編集</h2>

            {!! Form::open(['url' => 'admin/order_request_option/car/update']) !!}
                {!! Form::hidden('option_id', $data->option_id) !!}

                <table>
                    <tr>
                        <th>クラス</th>
                        <td>{!! Form::text('class', $data->class, ['id' => 'input-class', 'class' => 'form-control', 'placeholder' => '']) !!}</td>
                    </tr>
                    <tr>
                        <th>名称</th>
                        <td>{!! Form::text('name', $data->name, ['id' => 'input-name', 'class' => 'form-control', 'placeholder' => '']) !!}</td>
                    </tr>
                </table>

                {!! Form::submit('この内容で登録する', ['class' => 'btn btn-block btn-warning btn-submit'] ) !!}

            {!! Form::close() !!}

        </div>
    </div>

    <a href="{{ url('') }}/admin/order_request_option/car" class="btn btn-block btn-primary">戻る</a>


@endsection
