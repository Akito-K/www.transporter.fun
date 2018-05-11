'use strict';
import Config from './config';
import $ = require("jquery");
import Func from './func';

namespace Star {
    export class MyStar {

        constructor(
            //private ajaxing: boolean = false,
            ){
            //let self = this;

            if( $('.trigStar').length > 0 ){
                for( let i: number = 0; i < $('.trigStar').length; i++){
                    const obj = $('.trigStar').eq(i);
                    const star: number = parseFloat( obj.find('.paramStar').html().replace('(', '').replace(')', '') );
                    const val = Math.round( star / 5 * 100 );
                    obj.find('.bulletStar').animate(
                        {width: val+'%'},
                        2000
                        );
                }
            }

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
export default Star;
