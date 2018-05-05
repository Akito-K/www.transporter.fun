'use strict';
import Config from './config';
import $ = require("jquery");
import Func from './func';

namespace Address {


    export class MyAddress {
//        public el: any;
//        public defaultTextareaHeight: number = 30;
//        public defaultTextareaLineHeight: number = 20;

        constructor(
            private ajaxing: boolean = false,
            ){
            let self = this;
/*
            // 以前のメッセージ読み込み
            $('#trigAddAddress').click( () => {
                const k = Number( $('#trigAddAddress').attr("data-k") );
                this.ajaxAddAddress(k);
            });
*/
        }
/*
        public ajaxAddAddress(k): void{
            let self = this;
            self.ajaxing = true;
            const token: string = $('meta[name="csrf-token"]').attr('content');
            const D = {k: k};

            $.ajax({
                headers: {'X-CSRF-TOKEN': token},
                url: '/ajax/add_address',
                type: 'post',
                data: D,
                dataType: 'json',
                beforeSend: function(){
                    // 実行中画面
                    $('#ajaxing-waiting').show();
                },
                success: function( data ){
                    $('#bulletAddressBoxes').append(data.view);
                    $('#trigAddAddress').attr("data-k", data.k2)
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
export default Address;
