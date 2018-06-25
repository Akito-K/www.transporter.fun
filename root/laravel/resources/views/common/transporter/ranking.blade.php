@extends('layouts.common.www')
@section('content')
<section class="sec_visual">
    <div class="container">
        <div class="visual_wrap">
            <div class="visual_thumb"><img src="{{ env('www_url') }}/assets/images/transporter/visual.jpg" alt="" width="1200" height="140" srcset="{{ env('www_url') }}/assets/images/transporter/visual.jpg 1x,{{ env('www_url') }}/assets/images/transporter/visual@2x.jpg 2x"></div>
            <h1 class="visual_title">トランスポーターとは</h1>
        </div>
    </div>
</section>

<div class="crumb">
    <div class="container">
        <ul>
            <li><a href="/">Home</a></li>
            <li><a href="{{ env('www_url') }}/transporter/">Transporterとは</a></li>
            <li><span>人気パーソナルポーター＆プレミアムポーターランキング</span></li>
        </ul>
    </div>
</div>


<div class="page_transporter page_transporter_ranking page_main page_col2">
    <div class="container">

        <article class="content">
            
            <section class="sec sec_transporter_ranking">
                <h1 class="title_style03">人気パーソナルポーター＆プレミアムポーターランキング</h1>
                <div class="btn_select btn_select_value mb50" data-value="1">
                    <a class="label">すべてのカテゴリー</a>
                    <div class="child_wrap">
                        <ul class="child">
                            <li data-value="1" data-label="すべてのカテゴリー">すべてのカテゴリー</li>
                            <li data-value="2" data-label="13ｔ以下 ウイング車"><img src="{{ env('www_url') }}/assets/images/transporter/ranking/truck_wing.png" alt="" width="270" height="80" srcset="{{ env('www_url') }}/assets/images/transporter/ranking/truck_wing.png 1x,{{ env('www_url') }}/assets/images/transporter/ranking/truck_wing@2x.png 2x"></li>
                            <li data-value="3" data-label="13ｔ以下 平車"><img src="{{ env('www_url') }}/assets/images/transporter/ranking/truck_flat.png" alt="" width="270" height="80" srcset="{{ env('www_url') }}/assets/images/transporter/ranking/truck_flat.png 1x,{{ env('www_url') }}/assets/images/transporter/ranking/truck_flat@2x.png 2x"></li>
                            <li data-value="4" data-label="32ｔ以下 トレーラー"><img src="{{ env('www_url') }}/assets/images/transporter/ranking/truck_trailer_32t.png" alt="" width="270" height="80" srcset="{{ env('www_url') }}/assets/images/transporter/ranking/truck_trailer_32t.png 1x,{{ env('www_url') }}/assets/images/transporter/ranking/truck_trailer_32t@2x.png 2x"></li>
                            <li data-value="5" data-label="70ｔ以下 トレーラー"><img src="{{ env('www_url') }}/assets/images/transporter/ranking/truck_trailer_70t.png" alt="" width="270" height="80" srcset="{{ env('www_url') }}/assets/images/transporter/ranking/truck_trailer_70t.png 1x,{{ env('www_url') }}/assets/images/transporter/ranking/truck_trailer_70t@2x.png 2x"></li>
                            <li data-value="6" data-label="重量物・その他大型特殊車両"><img src="{{ env('www_url') }}/assets/images/transporter/ranking/truck_special.png" alt="" width="270" height="80" srcset="{{ env('www_url') }}/assets/images/transporter/ranking/truck_special.png 1x,{{ env('www_url') }}/assets/images/transporter/ranking/truck_special@2x.png 2x"></li>
                        </ul>
                    </div>
                </div>
                <p class="alR">集計更新日：2018/05/02</p>
                <div class="btns_radio mb30">
                    <div class="btn_radio"><a data-value="1">パーソナルポーターランキング</a></div>
                    <div class="btn_radio"><a data-value="2">プレミアムポーターランキング</a></div>
                </div>

                <div class="ranking_wrap">
                <div class="ranking">
                    <div class="ranking_box">
                        <div class="ranking_header ranking_up ranking_first">
                            <span class="ranking_title">トランスポーター株式会社</span>
                            <a class="ranking_link_btn" href="#">PORTER PAGE</a>
                        </div>
                        <div class="ranking_content">
                            <img class="ranking_img" src="{{ env('www_url') }}/assets/images/transporter/ranking/sample.png" alt="" width="150" height="113" srcset="{{ env('www_url') }}/assets/images/transporter/ranking/sample.png 1x,{{ env('www_url') }}/assets/images/transporter/ranking/sample@2x.png 2x">
                            <ul>
                                <li><a class="textlink" href="#">案件タイトル名1案件タイトル名1 →</a></li>
                                <li><a class="textlink" href="#">案件タイトル名2案件タイトル名2 →</a></li>
                                <li><a class="textlink" href="#">案件タイトル名3案件タイトル名3 →</a></li>
                                <li><a class="textlink" href="#">案件タイトル名4案件タイトル名4 →</a></li>
                                <li><a class="textlink" href="#">案件タイトル名5案件タイトル名5 →</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="ranking_box">
                        <div class="ranking_header ranking_stay ranking_second">
                            <span class="ranking_title">トランスポーター株式会社</span>
                            <a class="ranking_link_btn" href="#">PORTER PAGE</a>
                        </div>
                        <div class="ranking_content">
                            <img class="ranking_img" src="{{ env('www_url') }}/assets/images/transporter/ranking/sample.png" alt="" width="150" height="113" srcset="{{ env('www_url') }}/assets/images/transporter/ranking/sample.png 1x,{{ env('www_url') }}/assets/images/transporter/ranking/sample@2x.png 2x">
                            <ul>
                                <li><a class="textlink" href="#">案件タイトル名1案件タイトル名1 →</a></li>
                                <li><a class="textlink" href="#">案件タイトル名2案件タイトル名2 →</a></li>
                                <li><a class="textlink" href="#">案件タイトル名3案件タイトル名3 →</a></li>
                                <li><a class="textlink" href="#">案件タイトル名4案件タイトル名4 →</a></li>
                                <li><a class="textlink" href="#">案件タイトル名5案件タイトル名5 →</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="ranking_box">
                        <div class="ranking_header ranking_down ranking_third">
                            <span class="ranking_title">トランスポーター株式会社</span>
                            <a class="ranking_link_btn" href="#">PORTER PAGE</a>
                        </div>
                        <div class="ranking_content">
                            <img class="ranking_img" src="{{ env('www_url') }}/assets/images/transporter/ranking/sample.png" alt="" width="150" height="113" srcset="{{ env('www_url') }}/assets/images/transporter/ranking/sample.png 1x,{{ env('www_url') }}/assets/images/transporter/ranking/sample@2x.png 2x">
                            <ul>
                                <li><a class="textlink" href="#">案件タイトル名1案件タイトル名1 →</a></li>
                                <li><a class="textlink" href="#">案件タイトル名2案件タイトル名2 →</a></li>
                                <li><a class="textlink" href="#">案件タイトル名3案件タイトル名3 →</a></li>
                                <li><a class="textlink" href="#">案件タイトル名4案件タイトル名4 →</a></li>
                                <li><a class="textlink" href="#">案件タイトル名5案件タイトル名5 →</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="ranking clearfix">
                    <div class="ranking_box ranking_wrap_half">
                        <div class="ranking_header ranking_up">
                            <span class="ranking_rank">第4位</span><span class="ranking_title">トランスポーター株式会社</span>
                        </div>
                        <div class="ranking_content">
                            <img class="ranking_img" src="{{ env('www_url') }}/assets/images/transporter/ranking/sample.png" alt="" width="150" height="113" srcset="{{ env('www_url') }}/assets/images/transporter/ranking/sample.png 1x,{{ env('www_url') }}/assets/images/transporter/ranking/sample@2x.png 2x">
                            <ul>
                                <li><a class="textlink" href="#">案件タイトル名1案件タイトル名1 →</a></li>
                                <li><a class="textlink" href="#">案件タイトル名2案件タイトル名2 →</a></li>
                            </ul>
                            <a class="textlink fl_right" href="#">PORTER PAGE →</a>
                        </div>
                    </div>
                    <div class="ranking_box ranking_wrap_half">
                        <div class="ranking_header ranking_stay">
                            <span class="ranking_rank">第5位</span><span class="ranking_title">トランスポーター株式会社</span>
                        </div>
                        <div class="ranking_content">
                            <img class="ranking_img" src="{{ env('www_url') }}/assets/images/transporter/ranking/sample.png" alt="" width="150" height="113" srcset="{{ env('www_url') }}/assets/images/transporter/ranking/sample.png 1x,{{ env('www_url') }}/assets/images/transporter/ranking/sample@2x.png 2x">
                            <ul>
                                <li><a class="textlink" href="#">案件タイトル名1案件タイトル名1 →</a></li>
                                <li><a class="textlink" href="#">案件タイトル名2案件タイトル名2 →</a></li>
                            </ul>
                            <a class="textlink fl_right" href="#">PORTER PAGE →</a>
                        </div>
                    </div>
                </div>
                <ol class="ranking_list">
                    <li class="ranking_up">
                        <span class="ranking_rank">第6位</span><span class="ranking_title">トランスポーター株式会社</span>
                        <img class="ranking_img" src="{{ env('www_url') }}/assets/images/transporter/ranking/sample.png" alt="" width="40" height="30" srcset="{{ env('www_url') }}/assets/images/transporter/ranking/sample.png 1x,{{ env('www_url') }}/assets/images/transporter/ranking/sample@2x.png 2x">
                        <a class="textlink ranking_link" href="#">PORTER PAGE →</a>
                    </li>
                    <li class="ranking_stay">
                        <span class="ranking_rank">第7位</span><span class="ranking_title">トランスポーター株式会社</span>
                        <img class="ranking_img" src="{{ env('www_url') }}/assets/images/transporter/ranking/sample.png" alt="" width="40" height="30" srcset="{{ env('www_url') }}/assets/images/transporter/ranking/sample.png 1x,{{ env('www_url') }}/assets/images/transporter/ranking/sample@2x.png 2x">
                        <a class="textlink ranking_link" href="#">PORTER PAGE →</a>
                    </li>
                    <li class="ranking_up">
                        <span class="ranking_rank">第8位</span><span class="ranking_title">トランスポーター株式会社</span>
                        <img class="ranking_img" src="{{ env('www_url') }}/assets/images/transporter/ranking/sample.png" alt="" width="40" height="30" srcset="{{ env('www_url') }}/assets/images/transporter/ranking/sample.png 1x,{{ env('www_url') }}/assets/images/transporter/ranking/sample@2x.png 2x">
                        <a class="textlink ranking_link" href="#">PORTER PAGE →</a>
                    </li>
                    <li class="ranking_down">
                        <span class="ranking_rank">第9位</span><span class="ranking_title">トランスポーター株式会社</span>
                        <img class="ranking_img" src="{{ env('www_url') }}/assets/images/transporter/ranking/sample.png" alt="" width="40" height="30" srcset="{{ env('www_url') }}/assets/images/transporter/ranking/sample.png 1x,{{ env('www_url') }}/assets/images/transporter/ranking/sample@2x.png 2x">
                        <a class="textlink ranking_link" href="#">PORTER PAGE →</a>
                    </li>
                    <li class="ranking_down">
                        <span class="ranking_rank">第10位</span><span class="ranking_title">トランスポーター株式会社</span>
                        <img class="ranking_img" src="{{ env('www_url') }}/assets/images/transporter/ranking/sample.png" alt="" width="40" height="30" srcset="{{ env('www_url') }}/assets/images/transporter/ranking/sample.png 1x,{{ env('www_url') }}/assets/images/transporter/ranking/sample@2x.png 2x">
                        <a class="textlink ranking_link" href="#">PORTER PAGE →</a>
                    </li>
                    <li class="ranking_stay">
                        <span class="ranking_rank">第11位</span><span class="ranking_title">トランスポーター株式会社</span>
                        <img class="ranking_img" src="{{ env('www_url') }}/assets/images/transporter/ranking/sample.png" alt="" width="40" height="30" srcset="{{ env('www_url') }}/assets/images/transporter/ranking/sample.png 1x,{{ env('www_url') }}/assets/images/transporter/ranking/sample@2x.png 2x">
                        <a class="textlink ranking_link" href="#">PORTER PAGE →</a>
                    </li>
                    <li class="ranking_up">
                        <span class="ranking_rank">第12位</span><span class="ranking_title">トランスポーター株式会社</span>
                        <img class="ranking_img" src="{{ env('www_url') }}/assets/images/transporter/ranking/sample.png" alt="" width="40" height="30" srcset="{{ env('www_url') }}/assets/images/transporter/ranking/sample.png 1x,{{ env('www_url') }}/assets/images/transporter/ranking/sample@2x.png 2x">
                        <a class="textlink ranking_link" href="#">PORTER PAGE →</a>
                    </li>
                    <li class="ranking_stay">
                        <span class="ranking_rank">第13位</span><span class="ranking_title">トランスポーター株式会社</span>
                        <img class="ranking_img" src="{{ env('www_url') }}/assets/images/transporter/ranking/sample.png" alt="" width="40" height="30" srcset="{{ env('www_url') }}/assets/images/transporter/ranking/sample.png 1x,{{ env('www_url') }}/assets/images/transporter/ranking/sample@2x.png 2x">
                        <a class="textlink ranking_link" href="#">PORTER PAGE →</a>
                    </li>
                    <li class="ranking_up">
                        <span class="ranking_rank">第14位</span><span class="ranking_title">トランスポーター株式会社</span>
                        <img class="ranking_img" src="{{ env('www_url') }}/assets/images/transporter/ranking/sample.png" alt="" width="40" height="30" srcset="{{ env('www_url') }}/assets/images/transporter/ranking/sample.png 1x,{{ env('www_url') }}/assets/images/transporter/ranking/sample@2x.png 2x">
                        <a class="textlink ranking_link" href="#">PORTER PAGE →</a>
                    </li>
                    <li class="ranking_down">
                        <span class="ranking_rank">第15位</span><span class="ranking_title">トランスポーター株式会社</span>
                        <img class="ranking_img" src="{{ env('www_url') }}/assets/images/transporter/ranking/sample.png" alt="" width="40" height="30" srcset="{{ env('www_url') }}/assets/images/transporter/ranking/sample.png 1x,{{ env('www_url') }}/assets/images/transporter/ranking/sample@2x.png 2x">
                        <a class="textlink ranking_link" href="#">PORTER PAGE →</a>
                    </li>
                    <li class="ranking_up">
                        <span class="ranking_rank">第16位</span><span class="ranking_title">トランスポーター株式会社</span>
                        <img class="ranking_img" src="{{ env('www_url') }}/assets/images/transporter/ranking/sample.png" alt="" width="40" height="30" srcset="{{ env('www_url') }}/assets/images/transporter/ranking/sample.png 1x,{{ env('www_url') }}/assets/images/transporter/ranking/sample@2x.png 2x">
                        <a class="textlink ranking_link" href="#">PORTER PAGE →</a>
                    </li>
                    <li class="ranking_stay">
                        <span class="ranking_rank">第17位</span><span class="ranking_title">トランスポーター株式会社</span>
                        <img class="ranking_img" src="{{ env('www_url') }}/assets/images/transporter/ranking/sample.png" alt="" width="40" height="30" srcset="{{ env('www_url') }}/assets/images/transporter/ranking/sample.png 1x,{{ env('www_url') }}/assets/images/transporter/ranking/sample@2x.png 2x">
                        <a class="textlink ranking_link" href="#">PORTER PAGE →</a>
                    </li>
                    <li class="ranking_up">
                        <span class="ranking_rank">第18位</span><span class="ranking_title">トランスポーター株式会社</span>
                        <img class="ranking_img" src="{{ env('www_url') }}/assets/images/transporter/ranking/sample.png" alt="" width="40" height="30" srcset="{{ env('www_url') }}/assets/images/transporter/ranking/sample.png 1x,{{ env('www_url') }}/assets/images/transporter/ranking/sample@2x.png 2x">
                        <a class="textlink ranking_link" href="#">PORTER PAGE →</a>
                    </li>
                    <li class="ranking_down">
                        <span class="ranking_rank">第19位</span><span class="ranking_title">トランスポーター株式会社</span>
                        <img class="ranking_img" src="{{ env('www_url') }}/assets/images/transporter/ranking/sample.png" alt="" width="40" height="30" srcset="{{ env('www_url') }}/assets/images/transporter/ranking/sample.png 1x,{{ env('www_url') }}/assets/images/transporter/ranking/sample@2x.png 2x">
                        <a class="textlink ranking_link" href="#">PORTER PAGE →</a>
                    </li>
                    <li class="ranking_stay">
                        <span class="ranking_rank">第20位</span><span class="ranking_title">トランスポーター株式会社</span>
                        <img class="ranking_img" src="{{ env('www_url') }}/assets/images/transporter/ranking/sample.png" alt="" width="40" height="30" srcset="{{ env('www_url') }}/assets/images/transporter/ranking/sample.png 1x,{{ env('www_url') }}/assets/images/transporter/ranking/sample@2x.png 2x">
                        <a class="textlink ranking_link" href="#">PORTER PAGE →</a>
                    </li>
                </ol>
            </section>
            
            <section class="sec sec_transporter_ranking">
                <div class="radius_box border_blue">
                    <div class="radius_box_title">最近チェックしたPORTER＆案件</div>
                    <div class="radius_box_content">
                        <ul>
                            <li><a class="textlink" href="#">運送会社名　案件タイトル名  →</a></li>
                            <li><a class="textlink" href="#">運送会社名　案件タイトル名  →</a></li>
                            <li><a class="textlink" href="#">運送会社名　案件タイトル名  →</a></li>
                            <li><a class="textlink" href="#">運送会社名　案件タイトル名  →</a></li>
                            <li><a class="textlink" href="#">運送会社名　案件タイトル名  →</a></li>
                        </ul>
                    </div>
                </div>
            </section>
        </article>

        @include('include.common.www.side_transporter')

    </div>

    <div class="totop"><a class="scroll" href="#wrapper"></a></div>

</div><!-- .page_main -->

@endsection

@section('script')
<script>
    $(function(){
        var prev = [];
        var showRanking = function() {
            var categ = $('.btn_select_value').data('value');
            var rank = $('.btns_radio').data('value');
            var $ranking = $('.ranking_wrap');
            if ((categ && rank) && (categ !== prev.categ || rank !== prev.rank)) {
                $ranking.hide();
                // ランキング表示切り替え処理
                $ranking.fadeIn();
            }
            prev.categ = categ;
            prev.rank = rank;
        };

        // 要素を選んだら閉じ、.btn_select に data('value') をセット
        $('.btn_select_value [data-value]').on('click',function(){
            var $this = $(this);
            var $sel = $this.parents('.btn_select_value');
            $sel.data('value', $this.data('value'));
            $sel.find('.label').removeClass('active').text($this.data('label'));
            $sel.find('.child_wrap').removeClass('open').height(0);
            showRanking();
        });

        // ランキングの種類切り替え .btns_radio に data('value') をセット
        $('.btns_radio [data-value]').on('click',function(){
            var $this = $(this);
            var $btns = $this.parents('.btns_radio');
            $btns.data('value', $this.data('value'));
            $btns.find('[data-value]').removeClass('selected');
            $this.addClass('selected');
            showRanking();
        });
    });
</script>
@endsection
