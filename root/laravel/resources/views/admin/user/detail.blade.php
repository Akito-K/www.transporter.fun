@extends('layouts.admin')
@section('content')

    <div class="box">
        <div class="box-body">
            <h2 class="page-header">詳細</h2>

            <table class="user__table">
                <tr>
                    <th class="user__cell">ログインID</th>
                    <td class="user__cell">{{ $data->login_id }}</td>
                </tr>
                <tr>
                    <th class="user__cell">ログインパスワード</th>
                    <td class="user__cell">***</td>
                </tr>
                <tr>
                    <th>画像</th>
                    <td class="user__cell">
                        <span class="user__cell__img">
                            <span class="my-thumbnail">
                                <span class="my-thumbnail__img" style="background-image: url({!! \Func::getImage($data->icon_filepath) !!});"></span>
                            </span>
                        </span>
                    </td>
                </tr>
                <tr>
                    <th class="user__cell">表示名</th>
                    <td class="user__cell">{{ $data->name }}</td>
                </tr>

                <tr>
                    <th class="user__cell">しめい</th>
                    <td class="user__cell">{{ $data->sei_kana }} {{ $data->mei_kana }}</td>
                </tr>
                <tr>
                    <th class="user__cell">氏名</th>
                    <td class="user__cell">{{ $data->sei }} {{ $data->mei }}</td>
                </tr>

                <tr>
                    <th class="user__cell">荷主ID</th>
                    <td class="user__cell">{{ $data->owner_id }}</td>
                </tr>
                <tr>
                    <th class="user__cell">運送会社ID</th>
                    <td class="user__cell">{{ $data->carrier_id }}</td>
                </tr>

                <tr>
                    <th class="user__cell">メールアドレス</th>
                    <td class="user__cell">{{ $data->email }}</td>
                </tr>
                <tr>
                    <th class="user__cell">携帯番号</th>
                    <td class="user__cell">{{ $data->mobile }}</td>
                </tr>
                <tr>
                    <th class="user__cell">電話番号</th>
                    <td class="user__cell">{{ $data->tel }}</td>
                </tr>

                <tr>
                    <th class="user__cell">最終ログイン日時</th>
                    <td class="user__cell">{{ \Func::dateFormat($data->last_logined_at, 'Y/n/j(wday)') }} {{ \Func::dateFormat($data->last_logined_at, 'H:i:s') }}</td>
                </tr>
                <tr>
                    <th class="user__cell">BAN</th>
                    <td class="user__cell">{!! $data->banned_at? \Func::dateFormat($data->banned_at, 'Y/n/j(wday)'): '-' !!}</td>
                </tr>

            </table>

        </div>
    </div>

    <p><a href="{{ url('') }}/admin/user/{!! $data->hashed_id !!}/edit" class="btn btn-warning btn-block btn-lg">編集する</a></p>
    <p><a href="{{ url('') }}/admin/user/{!! $data->hashed_id !!}/delete" class="btn btn-danger btn-block btn-sm">削除する</a></p>
    <p><a href="{{ url('') }}/admin/user" class="btn btn-block btn-primary">一覧へ戻る</a></p>

@endsection
