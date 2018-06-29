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
                        <li class="col5"><a href="{{ env('www_url') }}/delivery_services/Category/#001">
                            <img class="pc" src="{{ env('www_url') }}/assets/images/home/btn_weight01.jpg" alt="ウイング便（13t以下）" width="233" height="240" srcset="{{ env('www_url') }}/assets/images/home/btn_weight01.jpg 1x,{{ env('www_url') }}/assets/images/home/btn_weight01@2x.jpg 2x">
                            <img class="sp" src="{{ env('www_url') }}/assets/images/home/sp_btn_weight01.jpg" alt="ウイング便（13t以下）" width="460" height="140" srcset="{{ env('www_url') }}/assets/images/home/sp_btn_weight01.jpg 1x,{{ env('www_url') }}/assets/images/home/sp_btn_weight01@2x.jpg 2x"
                                 ></a></li>
                        <li class="col5"><a href="{{ env('www_url') }}/delivery_services/Category/#002">
                            <img class="pc" src="{{ env('www_url') }}/assets/images/home/btn_weight02.jpg" alt="平車（13t以下）" width="233" height="240" srcset="{{ env('www_url') }}/assets/images/home/btn_weight02.jpg 1x,{{ env('www_url') }}/assets/images/home/btn_weight02@2x.jpg 2x">
                            <img class="sp" src="{{ env('www_url') }}/assets/images/home/sp_btn_weight02.jpg" alt="平車（13t以下）" width="460" height="140" srcset="{{ env('www_url') }}/assets/images/home/sp_btn_weight02.jpg 1x,{{ env('www_url') }}/assets/images/home/sp_btn_weight02@2x.jpg 2x">
                            </a></li>
                        <li class="col5"><a href="{{ env('www_url') }}/delivery_services/Category/#003">
                            <img class="pc" class="pc" src="{{ env('www_url') }}/assets/images/home/btn_weight03.jpg" alt="トレーラー（32t以下）" width="233" height="240" srcset="{{ env('www_url') }}/assets/images/home/btn_weight03.jpg 1x,{{ env('www_url') }}/assets/images/home/btn_weight03@2x.jpg 2x">
                            <img class="sp" src="{{ env('www_url') }}/assets/images/home/sp_btn_weight03.jpg" alt="トレーラー（32t以下）" width="460" height="140" srcset="{{ env('www_url') }}/assets/images/home/sp_btn_weight03.jpg 1x,{{ env('www_url') }}/assets/images/home/sp_btn_weight03@2x.jpg 2x">
                            </a></li>
                        <li class="col5"><a href="{{ env('www_url') }}/delivery_services/Category/#004">
                            <img class="pc" src="{{ env('www_url') }}/assets/images/home/btn_weight04.jpg" alt="トレーラー（70t以下）" width="233" height="240" srcset="{{ env('www_url') }}/assets/images/home/btn_weight04.jpg 1x,{{ env('www_url') }}/assets/images/home/btn_weight04@2x.jpg 2x">
                            <img class="sp" src="{{ env('www_url') }}/assets/images/home/sp_btn_weight04.jpg" alt="トレーラー（70t以下）" width="460" height="140" srcset="{{ env('www_url') }}/assets/images/home/sp_btn_weight04.jpg 1x,{{ env('www_url') }}/assets/images/home/sp_btn_weight04@2x.jpg 2x">
                            </a></li>
                        <li class="col5"><a href="{{ env('www_url') }}/delivery_services/Category/#005">
                            <img class="pc" src="{{ env('www_url') }}/assets/images/home/btn_weight05.jpg" alt="重量物・その他大型特殊車両（200t以下）" width="233" height="240" srcset="{{ env('www_url') }}/assets/images/home/btn_weight05.jpg 1x,{{ env('www_url') }}/assets/images/home/btn_weight05@2x.jpg 2x">
                            <img class="sp" src="{{ env('www_url') }}/assets/images/home/sp_btn_weight05.jpg" alt="重量物・その他大型特殊車両（200t以下）" width="460" height="140" srcset="{{ env('www_url') }}/assets/images/home/sp_btn_weight05.jpg 1x,{{ env('www_url') }}/assets/images/home/sp_btn_weight05@2x.jpg 2x">
                            </a></li>

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

        <section class="sec_service mb50">
            <div class="container">
                <h2 class="title_style01"><span class="inner">物流サービス情報</span></h2>
                <p class="description">現在、見積り受付中の物流案件です。</p>
                <ul class="list_service">
                    @include('include.common.www.delivery_services', ['order_datas' => $order_datas])
                </ul>
            </div>
        </section>

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
@endsection
