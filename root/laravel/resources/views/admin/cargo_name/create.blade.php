@extends('layouts.admin')
@section('content')

    {!! MyHTML::errorMessage($errors) !!}
    {!! MyHTML::flashMessage() !!}

    <div class="box news">
        <div class="box-body news__block">
            <h2 class="page-header">荷物品名登録</h2>

            {!! Form::open(['url' => 'admin/cargo_name/insert']) !!}

                <table>
                    <tr>
                        <th>名称</th>
                        <td>{!! Form::text('name', old('name'), ['id' => 'input-name', 'class' => 'form-control', 'placeholder' => '']) !!}</td>
                    </tr>

                </table>

                {!! Form::submit('この内容で登録する', ['class' => 'btn btn-block btn-warning btn-submit'] ) !!}

            {!! Form::close() !!}

        </div>
    </div>

    <a href="{{ url('') }}/admin/cargo_name" class="btn btn-block btn-primary">戻る</a>
@endsection
