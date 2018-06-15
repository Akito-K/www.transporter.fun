@extends('layouts.admin')
@section('content')

<div class="box log">

    <div class="box-body log__block">
        <h2 class="page-header">操作ログ</h2>
    </div>

    <div class="box-body log__block">
        {!! \MyHTML::pagenation($pages, '/admin/log', ['trigger' => 'trigPageSelect']) !!}

        <table class="log__table">
            <tr>
                <th class="log__cell">No.</th>
                <th class="log__cell">日時</th>
                <th class="log__cell" colspan="2">ユーザー</th>
                <th class="log__cell">アクション</th>
                <th class="log__cell">ターゲット</th>
                <th class="log__cell">結果</th>
            </tr>

            @foreach($datas as $k => $data)
            <tr>
                <td class="log__cell">{!! $k + $start_number !!}</td>
                <td class="log__cell">
                    {!! \Func::dateFormat($data->created_at, 'Y-m-d') !!}<br />
                    {!! \Func::dateFormat($data->created_at, ' H:i') !!}
                </td>
                <td class="log__cell log__cell--icon log__cell--icon--log">
                    @if( $data->user_id != 'cron' )
                    <span class="log__cell__img my-thumbnail">
                        <span class="my-thumbnail__img" style="background-image: url({!! \Func::getImage( $user_datas[$data->user_id]->icon_filepath) !!});"></span>
                    </span>
                    @endif
                </td>
                <td class="log__cell">
                    {{ $data->user_id }}<br />
                    @if( $data->user_id != 'cron' )
                    {{ $user_datas[ $data->user_id ]->sei }} {{ $user_datas[ $data->user_id ]->mei }}
                    @endif
                </td>
                <td class="log__cell">{{ $data->controller }}</td>
                <td class="log__cell">
                    @if($data->target)
                    {{ $data->target }} =<br />
                    {{ $data->value }}
                    @endif
                </td>
                <td class="log__cell">
                    @if($data->result !== NULL)
                    @if($data->result)
                    SUCCESS
                    @else
                    FALSE
                    @endif
                    @endif
                </td>
            </tr>
            <tr>
            </tr>
            @endforeach

        </table>

        {!! \MyHTML::pagenation($pages, '/admin/log', ['trigger' => 'trigPageSelect']) !!}
    </div>
</div>

@endsection
