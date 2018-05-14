'use strict';
import Config from './config';
import $ = require("jquery");
import Func from './func';

namespace Quote {


    export class MyQuote {

        constructor(
            private ajaxing: boolean = false,
            ){
            let self = this;

            // アカウント情報を引用
            $('#trigQuoteUserAccount').click( () => {
                if( window.confirm('入力値を消してアカウント登録情報を使用しますか？') ){
                    const id = $('#trigQuoteUserAccount').data('id');
                    this.ajaxQuoteUserAccount(id);
                }else{
                    return false;
                }
            });

            // 選択肢から住所情報を引用
            $('.trigQuoteAddress').click( function(){
                if( window.confirm('入力値を消して選択の住所を使用しますか？') ){
                    const type = $(this).data('type');
                    const id = $('.paramQuoteAddress[data-type="'+type+'"] :selected').val();
//                    console.log(id);
                    self.ajaxQuoteAddress(id, type);
                }else{
                    return false;
                }
            });
        }

        public ajaxQuoteUserAccount(id): void{
            let self = this;
            self.ajaxing = true;
            const token: string = $('meta[name="csrf-token"]').attr('content');
            const D = {hashed_id: id};

            $.ajax({
                headers: {'X-CSRF-TOKEN': token},
                url: '/ajax/quote_user_account',
                type: 'post',
                data: D,
                dataType: 'json',
                beforeSend: function(){
                    // 実行中画面
                    $('#ajaxing-waiting').show();
                },
                success: function( data ){
                    //console.log(data);
                    $('#zip1').val( data.zip1 );
                    $('#zip2').val( data.zip2 );
                    $('#pref_code').val( data.pref_code );
                    $('#city').val( data.city );
                    $('#address').val( data.address );
                    $('#tels-1').val( data.tels[1] );
                    $('#tels-2').val( data.tels[2] );
                    $('#tels-3').val( data.tels[3] );
                },
                complete: function(){
                    // 実行中画面を消す
                    $('#ajaxing-waiting').hide();
                    self.ajaxing = false;
                }
            });
        }

        public ajaxQuoteAddress(id, type): void{
            let self = this;
            self.ajaxing = true;
            const token: string = $('meta[name="csrf-token"]').attr('content');
            const D = {address_id: id};

            $.ajax({
                headers: {'X-CSRF-TOKEN': token},
                url: '/ajax/quote_address',
                type: 'post',
                data: D,
                dataType: 'json',
                beforeSend: function(){
                    // 実行中画面
                    $('#ajaxing-waiting').show();
                },
                success: function( data ){
                    //console.log(data);
                    $('#'+type+'_sei').val( data.sei );
                    $('#'+type+'_mei').val( data.mei );
                    $('#'+type+'_zip1').val( data.zip1 );
                    $('#'+type+'_zip2').val( data.zip2 );
                    $('#'+type+'_pref_code').val( data.pref_code );
                    $('#'+type+'_city').val( data.city );
                    $('#'+type+'_address').val( data.address );
                    $('#'+type+'_tels-1').val( data.tels[1] );
                    $('#'+type+'_tels-2').val( data.tels[2] );
                    $('#'+type+'_tels-3').val( data.tels[3] );
                },
                complete: function(){
                    // 実行中画面を消す
                    $('#ajaxing-waiting').hide();
                    self.ajaxing = false;
                }
            });
        }

    }

}
export default Quote;
