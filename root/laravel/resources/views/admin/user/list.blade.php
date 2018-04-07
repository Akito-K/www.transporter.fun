@extends('layouts.admin')
@section('content')

<div class="box user">

    <div class="box-body user__block">
        <h2 class="page-header">メンバー一覧</h2>
        <a href="{{ url('') }}/admin/user/create" class="btn btn-block btn-warning">追加</a>
    </div>

    <div class="box-body user__block">
        <table class="user__table">
            <tr>
                <th class="user__cell user__cell--no">No.</th>
                <th class="user__cell user__cell--icon">画像</th>
                <th class="user__cell user__cell--name">表示名</th>
                <th class="user__cell user__cell--company">荷主ID</th>
                <th class="user__cell user__cell--company">運送会社ID</th>
                <th class="user__cell user__cell--action">操作</th>
            </tr>

            @foreach($users as $k => $data)
            <tr class="user__row @if($data->banned_at) user__row--banned @endif">
                <td class="user__cell user__cell--no">{!! $k+1 !!}</td>
                <td class="user__cell">
                    <span class="user__cell__img my-thumbnail">
                        <span class="my-thumbnail__img" style="background-image: url({!! \Func::getImage($data->icon_filepath) !!});"></span>
                    </span>
                </td>
                <td class="user__cell user__cell--company">{{ $data->name }}</td>
                <td class="user__cell user__cell--name">{{ $data->owner_id }}</td>
                <td class="user__cell user__cell--name">{{ $data->carrier_id }}</td>
                <td class="user__cell user__cell--action">
                    <a href="{{ url('') }}/admin/user/{{ $data->hashed_id }}/detail" class="btn btn-primary">詳細</a>
                    @if(!$data->banned_at)
                    <a href="{{ url('') }}/admin/user/{{ $data->hashed_id }}/edit" class="btn btn-warning">編集</a>
                    <a href="{{ url('') }}/admin/user/{{ $data->hashed_id }}/ban" class="btn btn-default">BAN</a>
                    @endif
                    <a href="{{ url('') }}/admin/user/{{ $data->hashed_id }}/delete" class="btn btn-danger">削除</a>
                </td>
            </tr>
            @endforeach

        </table>
    </div>

</div>

@endsection
