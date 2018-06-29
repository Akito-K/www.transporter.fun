@extends('layouts.common.www')
@section('content')

<div class="crumb">
    <div class="container">
        <ul>
            <li><a href="/">Home</a></li>
            <li><span>空車情報一覧</span></li>
        </ul>
    </div>
</div>

<div class="page_request_search page_search page_main page_home">
    <div class="container">

        <article class="content">
            <section class="sec_empty">
                <div class="container">
                    <h2 class="title_style01"><span class="inner">運送可能・空き車両情報</span></h2>
                    <p class="description">空きトラック情報です。月間20,000以上の情報があります。</p>
                    <div class="table_wrap">
                        @include('include.common.www.trucks', ['empty_datas' => $empty_datas, '' => $car_datas, 'area_names' => $area_names])
                    </div>
                </div>
            </section>

        </article>

    </div>
    <div class="totop"><a class="scroll" href="#wrapper"></a></div>

</div><!-- .page_main -->

@endsection
