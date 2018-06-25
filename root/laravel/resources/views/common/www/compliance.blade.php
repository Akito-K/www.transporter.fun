@extends('layouts.common.www')
@section('content')

<div class="header_about_service">
    <div class="container">
        <span>サービスについて</span>
    </div>
</div>

<div class="crumb">
    <div class="container">
        <ul>
            <li><a href="/">Home</a></li>
            <li><span>コンプライアンス輸送</span></li>
        </ul>
    </div>
</div>

<div class="page_all page_main page_col2">
    <div class="container">

        <article class="content">

            <h1 class="title_style03 mb25">コンプライアンス輸送</h1>
            <section class="sec">
                <div class="text_wrap">
                    <p>河野トラック株式会社では、一般公道で特殊大型重量品の運搬を行うために必要な特殊車両通行許可の申請を行っています。許可取得後、輸送計画に基づき作業員の確保、誘導車両の手配、当日の輸送まで、一貫して全ての作業を行います。車両サイズが下記一般的制限値のどれか1つでも越える車両が道路を通行するには「特殊車両通行許可」が必要になります。</p>
                </div>
            </section>
            <section class="sec">
                <h2 class="title_style02">「特殊車両通行許可」の申請基準</h2>
                <div class="text_wrap">
                    <img src="{{ env('www_url') }}/assets/images/compliance/standard.png" alt="" width="880" height="655" srcset="{{ env('www_url') }}/assets/images/compliance/standard.png 1x,{{ env('www_url') }}/assets/images/compliance/standard@2x.png 2x"></a>
                </div>
            </section>

        </article>

        @include('include.common.www.side_about_service')
    </div>
    <div class="totop"><a class="scroll" href="#wrapper"></a></div>

</div><!-- .page_main -->

@endsection
