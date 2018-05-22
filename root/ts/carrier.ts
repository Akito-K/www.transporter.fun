'use strict';
import $ = require("jquery");
import Func from './func';

//import Holiday from './holiday';
import Page from './page';
import Calendar from './calendar';
import Upload from './upload';
import Quote from './quote';
import Order from './order';
import Star from './star';
import Estimate from './estimate';
//import Board from './board';
//import Customer from './customer';
//import Model from './model';

$(() => {
//    Func.hoge();

    // 休日カレンダー
//    const HOLIDAY = new Holiday.calendar();
    // ページ全般
    const ATAG = new Page.aTag();
    // カレンダー
    const CALENDAR = new Calendar.MyCalendar();
    // ドラッグでアップロード
    const UPLOAD = new Upload.MyUpload();
    // 選択肢から引用
    const QUOTE = new Quote.MyQuote();
    // 案件情報
    const ORDER = new Order.MyOrder();
    // 評価★
    const STAR = new Star.MyStar();
    // 見積
    const ESTIMATE = new Estimate.MyEstimate(STAR);
    // コンタクトボード
//    const BOARD = new Board.MyBoard();
    // 顧客
//    const CUSTOMER = new Customer.MyCustomer();
});