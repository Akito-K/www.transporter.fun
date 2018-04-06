@extends('layouts.admin')
@section('content')

    {!! MyHTML::errorMessage($errors) !!}
    {!! MyHTML::flashMessage() !!}

    <div class="box news">
        <div class="box-body news__block">
            <h2 class="page-header">運送業者クラス編集</h2>

            {!! Form::open(['url' => 'admin/carrier_class/update']) !!}
                {!! Form::hidden('class_id', $data->class_id) !!}

                <table>
                    <tr>
                        <th>名称</th>
                        <td>{!! Form::text('name', $data->name, ['id' => 'input-name', 'class' => 'form-control', 'placeholder' => '']) !!}</td>
                    </tr>
                    <tr>
                        <th>FAX</th>
                        <td>{!! Form::number('amount', $data->amount, ['id' => 'input-amount', 'class' => 'form-control', 'placeholder' => '']) !!}</td>
                    </tr>

                </table>

                {!! Form::submit('この内容で登録する', ['class' => 'btn btn-block btn-warning btn-submit'] ) !!}

            {!! Form::close() !!}

        </div>
    </div>

    <a href="{{ url('') }}/admin/carrier_class" class="btn btn-block btn-primary">戻る</a>


@endsection
