'use strict';
import Config from './config';
import $ = require("jquery");
import Func from './func';

namespace Estimate {

    export class MyEstimate {

        private MyStar;

        constructor(
            STAR,
            private ajaxing: boolean = false,
            private htmlOptions: string = '',
            ){
            let self = this;
            this.MyStar = STAR;

            if( $('#paramQuoteItem').length > 0 ){
                this.htmlOptions = $('#paramQuoteItem').html();
            }

            // 項目削除
            $(document).on('click', '.trigRemoveItem', function(){
                if( window.confirm('この項目を消しますか？') ){
                    const num = $(this).attr('data-num');
                    $('.bulletRemoveItem[data-num="'+num+'"]').remove();
                    self.refreshTotal();
                }else{
                    return false;
                }
            });

            // 項目追加
            $('#trigAddItem').click( () => {
                const num = Number( $('#trigAddItem').attr('data-num') );
                this.ajaxAddItem(num);
            });

            // 計算
            $(document).on('keyup', '.trigCalculateSubTotal', function(){
                const num = Number( $(this).attr('data-num') );
                self.refreshSubTotal(num);
                self.refreshTotal();
            });

            // 選択肢から商品情報を引用
            $(document).on('click', '.trigQuoteItem', function(){
                const num = $(this).data('num');
                const itemId = $('.paramQuoteItem[data-num="'+num+'"] :selected').val();
                if( itemId != '0'){
                    if( window.confirm('入力値を消して選択の商品を使用しますか？') ){
                        self.ajaxQuoteItem(itemId, num);
                    }else{
                        return false;
                    }
                }
            });

            // 選択肢から見積対象の案件情報を引用
            $('#trigQuoteOrder').click( () => {
                const orderId = $('#paramQuoteOrder :selected').val();
                self.ajaxQuoteOrder(orderId);
            });

        }

        public refreshSubTotal(num): void{
                const amount = Func.number( $('.paramAmount[data-num="'+num+'"]').val() );
                const count  = Func.number( $('.paramCount[data-num="'+num+'"]').val() );
                $('.bulletSubTotal[data-num="'+num+'"]').val( Func.numberFormat(amount * count) );
        }

        public refreshTotal(): void{
            let total = 0;
            if( $('.paramSubtotal').length > 0 ){
                for( let i = 0; i < $('.paramSubtotal').length; i++){
                    total += Func.number( $('.paramSubtotal').eq(i).val() );
                }
            }
            $('#bulletTotal').val( Func.numberFormat(total) );
        }

        public ajaxAddItem(num): void{
            let self = this;
            self.ajaxing = true;
            const token: string = $('meta[name="csrf-token"]').attr('content');
            const D = {latest_num: num, html_options: self.htmlOptions};

            $.ajax({
                headers: {'X-CSRF-TOKEN': token},
                url: '/ajax/add_estimate_item',
                type: 'post',
                data: D,
                dataType: 'json',
                beforeSend: function(){
                    // 実行中画面
                    $('#ajaxing-waiting').show();
                },
                success: function( data ){
                    //console.log(data);
                    $('#bulletItems').append( data.view );
                    $('#trigAddItem').attr('data-num', data.new_num );
                    $('.paramQuoteItem[data-num="'+data.new_num+'"]').html(self.htmlOptions);
                },
                complete: function(){
                    // 実行中画面を消す
                    $('#ajaxing-waiting').hide();
                    self.ajaxing = false;
                }
            });
        }

        public ajaxQuoteItem(itemId, num): void{
            let self = this;
            self.ajaxing = true;
            const token: string = $('meta[name="csrf-token"]').attr('content');
            const D = {item_id: itemId, num: num};

            $.ajax({
                headers: {'X-CSRF-TOKEN': token},
                url: '/ajax/quote_item',
                type: 'post',
                data: D,
                dataType: 'json',
                beforeSend: function(){
                    // 実行中画面
                    $('#ajaxing-waiting').show();
                },
                success: function( data ){
                    //console.log(data);
                    $('#code_'+num).val( data.code );
                    $('#name_'+num).val( data.name );
                    $('#amount_'+num).val( data.amount );
                    $('#notes_'+num).val( data.notes );
                    // 再計算
                    self.refreshSubTotal(num);
                    self.refreshTotal();
                },
                complete: function(){
                    // 実行中画面を消す
                    $('#ajaxing-waiting').hide();
                    self.ajaxing = false;
                }
            });
        }

        public ajaxQuoteOrder(orderId): void{
            let self = this;
            self.ajaxing = true;
            const token: string = $('meta[name="csrf-token"]').attr('content');
            const D = {order_id: orderId};

            $.ajax({
                headers: {'X-CSRF-TOKEN': token},
                url: '/ajax/quote_order',
                type: 'post',
                data: D,
                dataType: 'json',
                beforeSend: function(){
                    // 実行中画面
                    $('#ajaxing-waiting').show();
                },
                success: function( data ){
                    //console.log(data);
                    $('#bulletQuoteOrder').html( data.view );
                    $('#bulletQuoteOrderOwner').html( data.owner );
                    $('#bulletQuoteOrderName').html( data.name );
                    if( $('.trigStar').length > 0 ){
                        self.MyStar.viewStars();
                    }
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
export default Estimate;
