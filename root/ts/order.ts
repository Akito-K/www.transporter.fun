'use strict';
import Config from './config';
import $ = require("jquery");
import Func from './func';

namespace Order {


    export class MyOrder {

        constructor(
            private ajaxing: boolean = false,
            ){
            let self = this;

            $('.trigAccordOrderBox').click( function(){
                const elm = this;
                const open = $(this).attr('data-open');
                $(this).next('.bulletAccordOrderBox').removeClass('initial-close');
                if(open == "1"){
                    $(this).next('.bulletAccordOrderBox').slideUp(300, function(){
                        $(elm).attr('data-open', "0");
                    });
                }else{
                    $(this).next('.bulletAccordOrderBox').slideDown(300, function(){
                        $(elm).attr('data-open', "1");
                    });
                }
            });

            $('.trigTotalWeight').keyup( () => {
                const count: number = Number($('#paramCount').val());
                const weight: number = Number($('#paramWeight').val());
                const total = count * weight;
                $('span.bulletTotalWeight').html( Func.numberFormat(total) );
                $('input.bulletTotalWeight').val( total );
            });

        }
/*
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
*/
    }

}
export default Order;
