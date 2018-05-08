'use strict';
import $ = require("jquery");
import Func from './func';

//import Holiday from './holiday';
import Calendar from './calendar';
import Upload from './upload';
import Quote from './quote';
import Order from './order';
//import Board from './board';
//import Customer from './customer';
//import Model from './model';

$(() => {
//    Func.hoge();

    // 休日カレンダー
//    const HOLIDAY = new Holiday.calendar();
    // カレンダー
    const CALENDAR = new Calendar.MyCalendar();
    // ドラッグでアップロード
    const UPLOAD = new Upload.MyUpload();
    // 住所情報
    const QUOTE = new Quote.MyQuote();
    // 案件情報
    const ORDER = new Order.MyOrder();
    // コンタクトボード
//    const BOARD = new Board.MyBoard();
    // 顧客
//    const CUSTOMER = new Customer.MyCustomer();
});