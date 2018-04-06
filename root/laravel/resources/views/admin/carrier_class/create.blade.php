@extends('layouts.admin')
@section('content')

    {!! MyHTML::errorMessage($errors) !!}
    {!! MyHTML::flashMessage() !!}

    <div class="box news">
        <div class="box-body news__block">
            <h2 class="page-header">運送業者クラス登録</h2>

            {!! Form::open(['url' => 'admin/carrier_class/insert']) !!}

                <table>
                    <tr>
                        <th>名称</th>
                        <td>{!! Form::text('name', old('name'), ['id' => 'input-name', 'class' => 'form-control', 'placeholder' => '']) !!}</td>
                    </tr>
                    <tr>
                        <th>月額</th>
                        <td>{!! Form::number('amount', old('amount'), ['id' => 'input-amount', 'class' => 'form-control', 'placeholder' => '10000']) !!}</td>
                    </tr>

                </table>

                {!! Form::submit('この内容で登録する', ['class' => 'btn btn-block btn-warning btn-submit'] ) !!}

            {!! Form::close() !!}

        </div>
    </div>

    <a href="{{ url('') }}/admin/carrier_class" class="btn btn-block btn-primary">戻る</a>
@endsection
