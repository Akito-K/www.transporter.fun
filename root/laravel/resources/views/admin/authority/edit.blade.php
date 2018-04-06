@extends('layouts.admin')
@section('content')

    {!! MyHTML::errorMessage($errors) !!}
    {!! MyHTML::flashMessage() !!}

    <div class="box">
        <div class="box-body">
            <h2 class="page-header">編集</h2>

            {!! Form::open(['url' => 'admin/authority/update']) !!}
                {!! Form::hidden('authority_id', $data->authority_id) !!}

                <table class="staff__table staff__table--edit">
                    {!! Form::hidden('id', $data->id) !!}
                    <tr>
                        <th>権限ID</th>
                        <td>{!! Form::text('authority_id', $data->authority_id, ['class' => 'form-control form-control--mini form-control--40']) !!}</td>
                    </tr>
                    <tr>
                        <th>権限名</th>
                        <td>{!! Form::text('name', $data->name, ['class' => 'form-control form-control--mini form-control--40']) !!}</td>
                    </tr>
                </table>

                {!! Form::submit('この内容で登録する', ['class' => 'btn btn-block btn-warning btn-submit'] ) !!}
            {!! Form::close() !!}

        </div>
    </div>

    <a href="{{ url('') }}/admin/authority" class="btn btn-block btn-primary">一覧へ戻る</a>

@endsection
