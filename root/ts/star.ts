'use strict';
import Config from './config';
import $ = require("jquery");
import Func from './func';

namespace Star {
    export class MyStar {

        constructor(
            //private evaluating: boolean = false,
            private boxWidth: number = 0,
            ){
            let self = this;

            if( $('.trigStar').length > 0 ){
                this.viewStars();
            }

            if( $('.trigEvaluate').length > 0 ){
                this.viewEvaluates();
                this.boxWidth = Number( $('.trigEvaluateStar').eq(0).width() );
            }

            $('.trigEvaluateStar').mousemove( function( e ){
                const num: number = Func.number( $(this).attr("data-num") );
                const itemId: string = $(this).parent('ul').attr("data-id");
                const position: number = e.offsetX;
                const percent = self.getPercent(num, position);
//                console.log( num, itemId, position, percent );
                self.setEvaluateStar(itemId, percent);
            });
        }

        public getPercent( num, position ): number {
            const positions: number = this.boxWidth * num + position;
            const boxesWidth: number = this.boxWidth * 5;
            const percent: number = Math.round( positions / boxesWidth * 1000 ) / 10;

            return percent;
        }

        public setEvaluateStar( itemId, percent ){
            const star: number = Math.round( percent / 2 ) / 10;
            //console.log(star);
            $('.paramEvaluateStar[data-id="'+itemId+'"]').html( "("+star.toFixed(1)+")" );
            $('#bulletEvaluateStarValue-'+itemId).val(star.toFixed(1));
            document.getElementById('bulletEvaluateStar-'+itemId).style.width = percent +'%';
        }

        public viewEvaluates(){
            for( let i: number = 0; i < $('.trigEvaluate').length; i++){
                const obj = $('.trigEvaluate').eq(i);
                this.viewEvaluate(obj);
            }
        }

        public viewEvaluate(obj){
            const star: number = parseFloat( obj.find('.paramEvaluate').html().replace('(', '').replace(')', '') );
            const val = Math.round( star / 5 * 100 );
            obj.find('.bulletEvaluate').animate(
                {width: val+'%'},
                1000
                );
        }

        public viewStars(){
            for( let i: number = 0; i < $('.trigStar').length; i++){
                const obj = $('.trigStar').eq(i);
                this.viewStar(obj);
            }
        }

        public viewStar(obj){
            const star: number = parseFloat( obj.find('.paramStar').html().replace('(', '').replace(')', '') );
            const val = Math.round( star / 5 * 100 );
            obj.find('.bulletStar').animate(
                {width: val+'%'},
                2000
                );
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
