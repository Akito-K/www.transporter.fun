'use strict';
import $ = require("jquery");
import Func from './func';

//import Holiday from './holiday';
import Page from './page';
import Calendar from './calendar';
import Upload from './upload';
import Quote from './quote';
import Star from './star';
import Board from './board';
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
    // 住所情報
    const QUOTE = new Quote.MyQuote();
    // 評価★
    const STAR = new Star.MyStar();
    // コンタクトボード
    const BOARD = new Board.MyBoard();
    // 顧客
//    const CUSTOMER = new Customer.MyCustomer();
});