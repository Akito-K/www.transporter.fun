@extends('layouts.common.www')
@section('content')

<div class="page_home page_main">
    <article class="content">

        <section class="sec_visual">
            <div class="container">
                <div class="visual">
                    <div class="slider">
                        <div class="slider_box"><img src="{{ env('www_url') }}/assets/images/home/visual01.jpg" alt="" width="1200" height="431" srcset="{{ env('www_url') }}/assets/images/home/visual01.jpg 1x,{{ env('www_url') }}/assets/images/home/visual01@2x.jpg 2x"></div>
                        <div class="slider_box"><img src="{{ env('www_url') }}/assets/images/home/visual02.jpg" alt="" width="1200" height="431" srcset="{{ env('www_url') }}/assets/images/home/visual02.jpg 1x,{{ env('www_url') }}/assets/images/home/visual02@2x.jpg 2x"></div>
                        <div class="slider_box"><a href="{{ env('www_url') }}/campaign/"><img src="{{ env('www_url') }}/assets/images/home/visual03.jpg" alt="" width="1200" height="431" srcset="{{ env('www_url') }}/assets/images/home/visual03.jpg 1x,{{ env('www_url') }}/assets/images/home/visual03@2x.jpg 2x"></a></div>
                        <div class="slider_box"><img src="{{ env('www_url') }}/assets/images/home/visual04.jpg" alt="" width="1200" height="431" srcset="{{ env('www_url') }}/assets/images/home/visual04.jpg 1x,{{ env('www_url') }}/assets/images/home/visual04@2x.jpg 2x"></div>
                    </div>
                </div>
            </div>
        </section>

        <section class="sec_nav">
            <div class="container">
                <nav>
                    <ul class="nav_list col">
                        @include('include.common.www.carrier_classes', ['class_datas' => $class_datas])
                    </ul>
                </nav>

                <div class="title_style01">
                    <div class="inner">
                        <p class="catch">荷物を運搬して欲しい企業様が最適な運送会社が見つかる荷主と運送会社の</p>
                        <h1 class="sitetitle">運輸・輸送専門 <br class="sp">物流マッチングサイト</h1>
                    </div>
                </div>
            </div>
        </section>

        <section class="sec_service mb80">
            <div class="container">
                <h2 class="title_style01"><span class="inner">物流サービス情報</span></h2>
                <p class="description">現在、見積り受付中の物流案件です。</p>
                <ul class="list_service">
                    @include('include.common.www.delivery_services', ['order_datas' => $order_datas])
                </ul>
                <p class="alR pt10"><a href="/delivery_services" class="scroll textlink">すべての物流サービス情報を見る　→</a></p>
            </div>
        </section>

        <section class="sec_empty">
            <div class="container">
                <h2 class="title_style01"><span class="inner">運送可能・空き車両情報</span></h2>
                <p class="description">空きトラック情報です。月間20,000以上の情報があります。</p>
                <div class="table_wrap">
                    @include('include.common.www.trucks', ['empty_datas' => $empty_datas, '' => $car_datas, 'area_names' => $area_names])
                </div>
                <p class="alR pt10"><a href="/trucks" class="scroll textlink">すべての運送可能・空き車両情報を見る　→</a></p>
            </div>
        </section>

<?php /*
<a href="http://www.e-logit.com/loginews/" target="_blank"><strong>物流ニュース</strong></a><br><iframe title="物流ニュース" src="http://www.e-logit.com/loginews/loginews.php" frameBorder="0" width="100%" height="200"></iframe>
*/ ?>


    </article>
</div>
@endsection
