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
            <li><span>各種運送規約約款</span></li>
        </ul>
    </div>
</div>

<div class="page_all page_main page_col2">
    <div class="container">

        <article class="content">

            <h1 class="title_style03 mb25">各種運送規約約款</h1>
            <section class="sec">
                <div class="text_wrap">
                    <p><a class="textlink" href="#<?php /*{{ env('www_url') }}/assets/pdfs/stipulation.pdf" download="標準貨物自動車利用運送約款*/ ?>">標準貨物自動車利用運送約款  →
                        <img src="{{ env('www_url') }}/assets/images/top/transportation/pdf_icon.png" alt="" width="30" height="34" srcset="{{ env('www_url') }}/assets/images/top/transportation/pdf_icon.png 1x,{{ env('www_url') }}/assets/images/top/transportation/pdf_icon@2x.png 2x"></a>
                    </p>
                </div>
            </section>

        </article>

        @include('include.common.www.side_about_service')
    </div>
    <div class="totop"><a class="scroll" href="#wrapper"></a></div>

</div><!-- .page_main -->

@endsection
