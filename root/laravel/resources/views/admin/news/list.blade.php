@extends('layouts.admin')
@section('content')

    <div class="box news">
        <div class="box-body news__block">
            <h2 class="page-header">更新情報一覧</h2>

            @if( !empty($datas))
            <table>
                <tr>
                    <th class="news__list__date">日付</th>
                    <th class="news__list__title">タイトル</th>
                    <th class="news__list__body">本文</th>
                    <th class="news__list__publish text-center">掲載期間</th>
                    <th class="text-center auth-hide">表示</th>
                    <th class="text-center auth-hide">編集</th>
                    <th class="text-center auth-hide">削除</th>
                </tr>

                @foreach($datas as $data)
                <tr>
                    <td class="">{!! \Func::dateFormat( $data->date_at, 'Y/n/j(wday)' ) !!}</td>
                    <td class="" class="">{!! $data->title !!}</td>
                    <td class="" class="">{!! \Func::N2BR($data->body) !!}</td>
                    <td class="text-center">
                        @if ($data->publish_start_at)
                        {!! \Func::dateFormat( $data->publish_start_at, 'Y/n/j(wday)') !!}
                        @endif
                        ～
                        @if ($data->publish_close_at)
                        {!! \Func::dateFormat( $data->publish_close_at, 'Y/n/j(wday)') !!}
                        @endif
                    </td>
                    <td class="text-center auth-hide">
                        <a href="{{ url('') }}/admin/news/{!! $data->news_id !!}/unpublish">
                            @if($data->flag_unpublish)
                            <i class="fa fa-close"></i>
                             @else
                            <i class="fa fa-circle-o"></i>
                             @endif
                        </a>
                    </td>
                    <td class="text-center auth-hide">
                        <a href="{{ url('') }}/admin/news/{!! $data->news_id !!}/edit">編集</a>
                    </td>
                    <td class="text-center auth-hide">
                        <a href="{{ url('') }}/admin/news/{!! $data->news_id !!}/delete">削除</a>
                    </td>
                </tr>
                @endforeach
            </table>
            @endif

            <p class="auth-hide">
                <a href="{{ url('') }}/admin/news/create" class="btn btn-block btn-warning">新規作成</a>
            </p>

        </div>
    </div>
@endsection
