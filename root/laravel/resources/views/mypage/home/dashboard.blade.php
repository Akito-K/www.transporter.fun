@extends('layouts.mypage')
@section('content')

    <div class="box">
        <div class="box-body">
            <h2 class="page-header">ダッシュボード</h2>

            <div class="dashboard__block">
                <h3 class="dashboard__title">更新情報</h3>
                <div class="dashboard__box">

                    @if(!empty($news))
                    @foreach($news as $new)
                    <ul class="dashboard__lists">
                        <li class="dashboard__list dashboard__list--title">{!! \Func::dateFormat($new->date_at, 'Y.m.d') !!}</li>
                        <li class="dashboard__list dashboard__list--value"><a href="{{ url('') }}/admin/news/{{$new->news_id}}/detail">{{ $new->title }}</a></li>
                    </ul>
                    @endforeach
                    @else
                    <p class="dashboard__null">更新情報はありません。</p>
                    @endif

                </div>
            </div>

            <div class="dashboard__block">
                <div class="dashboard__buttons">
                    @if( !$me->owner_id )
                    <a href="{{ url('') }}/mypage/owner" class="dashboard__button btn btn-danger">荷主として利用開始する</a>
                    @else
                    <a href="{{ url('') }}/owner" class="dashboard__button btn btn-danger">荷主ページへ</a>
                    @endif

                    @if( !$me->carrier_id )
                    <a href="{{ url('') }}/mypage/transporter" class="dashboard__button btn btn-primary">運送会社として利用開始する</a>
                    @else
                    <a href="{{ url('') }}/carrier" class="dashboard__button btn btn-primary">運送会社として利用開始する</a>
                    @endif
                </div>
            </div>

            <div class="dashboard__block">
                <div class="dashboard__buttons--sm">
                    <a href="{{ url('') }}/mypage/account" class="dashboard__button dashboard__button--sm btn btn-warning">アカウント情報</a>
                    <a href="{{ url('') }}/mypage/address" class="dashboard__button dashboard__button--sm btn btn-warning">住所情報</a>
                </div>
            </div>
        </div>
    </div>

@endsection
