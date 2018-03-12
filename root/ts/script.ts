'use strict';
//import Func from './func';

import Page from './page';
import Order from './order';
//import Model from './model';
import $ = require("jquery");

$(() => {
//    Func.hoge();

    // ページ情報
    let page = new Page.Info();
    let aTag = new Page.aTag();

    // リンクボタン挙動
    $('a').click( (e) => {
        aTag.set( $(e.target) );
        if(aTag.disabled){
            return false;
        }else{
            return aTag.smoothScroll();
        }
    });

    // 定番商品を一覧で見る 開閉
    const standardList = new Order.standardList();

    // switch  - クリックで選択
    const wizardSwitch = new Order.wizardSwitch();

    // switchSize  - クリックで選択
    const wizardSwitchSize = new Order.size();

    // Item - 見積もり計算
    const wizardItem = new Order.item();

    // wizard - 次を表示
    const viewNext = new Order.viewNext();

    // +-ボタン
    let controlCounter = new Order.controlCounter();

    // 見積り表示欄がついて動く
    const board = new Order.board();

    // 数値入力欄
//    const counter = new Order.counter();



});