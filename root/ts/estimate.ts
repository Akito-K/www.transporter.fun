'use strict';
import Config from './config';
import $ = require("jquery");
import Func from './func';

namespace Estimate {


    export class MyEstimate {

        constructor(
            private ajaxing: boolean = false,
            private htmlOptions: string = '',
            ){
            let self = this;

            if( $('.paramQuoteItem').length > 0 ){
                this.htmlOptions = $('.paramQuoteItem').eq(0).html();
            }

            // 項目削除
            $(document).on('click', '.trigRemoveItem', function(){
                if( window.confirm('この項目を消しますか？') ){
                    const num = $(this).attr('data-num');
                    $('.bulletItem[data-num="'+num+'"]').remove();
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

        }

        public refreshSubTotal(num): void{
                const amount = Func.number( $('.paramAmount[data-num="'+num+'"]').val() );
                const count  = Func.number( $('.paramCount[data-num="'+num+'"]').val() );
                $('.bulletSubTotal[data-num="'+num+'"]').val( Func.numberFormat(amount * count) );
        }

        public refreshTotal(): void{
            if( $('.paramSubtotal').length > 0 ){
                let total = 0;
                for( let i = 0; i < $('.paramSubtotal').length; i++){
                    total += Func.number( $('.paramSubtotal').eq(i).val() );
                }
                $('#bulletTotal').val( Func.numberFormat(total) );
            }
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
