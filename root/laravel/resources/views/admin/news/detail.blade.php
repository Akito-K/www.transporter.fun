@extends('layouts.admin')
@section('content')

    <div class="box news">
        <div class="box-body news__block">
            <h2 class="page-header">更新情報詳細</h2>

            <table>
                <tr>
                    <th>日付</th>
                    <td>{!! $data->date_at->format('Y/n/j') !!}</td>
                </tr>
                <tr>
                    <th>タイトル</th>
                    <td>{!! $data->title !!}</td>
                </tr>
                <tr>
                    <th>本文</th>
                    <td>{!! \Func::N2BR($data->body) !!}</td>
                </tr>
                <tr>
                    <th>掲載期間</th>
                    <td>{!! \Func::dateFormat($data->publish_start_at) !!} ～ {!! \Func::dateFormat($data->publish_close_at) !!}
                    </td>
                </tr>
            </table>

        </div>
    </div>

    @if( \Func::isManager() )
    <a href="{{ url('') }}/admin/news/{!! $data->news_id !!}/edit" class="btn btn-block btn-warning">編集する</a>
    @endif
    <a href="{!! URL::previous() !!}" class="btn btn-block btn-primary">戻る</a>


@endsection
