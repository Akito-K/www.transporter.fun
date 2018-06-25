@extends('layouts.common.www')
@section('content')

<div class="crumb">
    <div class="container">
        <ul>
            <li><a href="/">Home</a></li>
            <li><span>物流サービス情報一覧</span></li>
        </ul>
    </div>
</div>

<div class="page_request_search page_search page_main page_home">
    <div class="container">

        <article class="content">
            <section class="sec_service">
                <div class="container">
                    <h2 class="title_style01"><span class="inner">物流サービス情報</span></h2>
                    <p class="description">現在、見積り受付中の物流案件です。</p>
                    <ul class="list_service">
                        <li><a href="#">
                            <div class="date">2018/01/15<span class="icon">本日まで！</span></div>
                            <p class="text">新橋から事務所移転→三田→東向島→大森</p>
                            <p class="more">詳しく見る ＞</p>
                        </a></li>
                        <li><a href="#">
                            <div class="date">2018/01/15<span class="icon">本日まで！</span></div>
                            <p class="text">新橋から事務所移転→三田→東向島→大森</p>
                            <p class="more">詳しく見る ＞</p>
                        </a></li>
                        <li><a href="#">
                            <div class="date">2018/01/15<span class="icon">本日まで！</span></div>
                            <p class="text">新橋から事務所移転→三田→東向島→大森</p>
                            <p class="more">詳しく見る ＞</p>
                        </a></li>
                        <li><a href="#">
                            <div class="date">2018/01/15<span class="icon">本日まで！</span></div>
                            <p class="text">新橋から事務所移転→三田→東向島→大森</p>
                            <p class="more">詳しく見る ＞</p>
                        </a></li>
                        <li><a href="#">
                            <div class="date">2018/01/15<span class="icon">本日まで！</span></div>
                            <p class="text">新橋から事務所移転→三田→東向島→大森</p>
                            <p class="more">詳しく見る ＞</p>
                        </a></li>
                        <li><a href="#">
                            <div class="date">2018/01/15<span class="icon">本日まで！</span></div>
                            <p class="text">新橋から事務所移転→三田→東向島→大森</p>
                            <p class="more">詳しく見る ＞</p>
                        </a></li>
                        <li><a href="#">
                            <div class="date">2018/01/15<span class="icon">本日まで！</span></div>
                            <p class="text">新橋から事務所移転→三田→東向島→大森</p>
                            <p class="more">詳しく見る ＞</p>
                        </a></li>
                        <li><a href="#">
                            <div class="date">2018/01/15<span class="icon">本日まで！</span></div>
                            <p class="text">新橋から事務所移転→三田→東向島→大森</p>
                            <p class="more">詳しく見る ＞</p>
                        </a></li>
                        <li><a href="#">
                            <div class="date">2018/01/15<span class="icon">本日まで！</span></div>
                            <p class="text">新橋から事務所移転→三田→東向島→大森</p>
                            <p class="more">詳しく見る ＞</p>
                        </a></li>
                        <li><a href="#">
                            <div class="date">2018/01/15<span class="icon">本日まで！</span></div>
                            <p class="text">新橋から事務所移転→三田→東向島→大森</p>
                            <p class="more">詳しく見る ＞</p>
                        </a></li>
                    </ul>
                </div>
            </section>
        </article>

    </div>
    <div class="totop"><a class="scroll" href="#wrapper"></a></div>

</div><!-- .page_main -->

@endsection

@section('script')
<script>
    $(function(){

        // 要素を選んだら閉じ、.btn_select に data('value') をセット
        $('.btn_select_value [data-value]').on('click',function(){
            var $this = $(this);
            var $sel = $this.parents('.btn_select_value');
            var dataVal = $this.data('value');
            if (dataVal) {
                $sel.data('value', dataVal);
                $sel.find('.label').addClass('selected').removeClass('active').text($this.text());
            } else {
                $sel.data('value', dataVal);
                $sel.find('.label').removeClass('selected').removeClass('active').text($sel.data('def-label'));
            }
            $sel.find('.child_wrap').removeClass('open').height(0);
        });

        // checkbox にチェックしたら「現在の検索条件」に表示
        $('.search_checkboxes [type="checkbox"]').on('change', function(){
            var $this = $(this);
            var $checks = $this.parents('.search_checkboxes');
            var strs = [];
            $checks.find('[type="checkbox"]:checked').each(function() {
                strs.push(this.parentElement.textContent);
            });
            $checks.find('.sel_checks').text(strs.join(' '));

        });

    });
</script>
@endsection
