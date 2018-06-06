'use strict';
import Config from './config';
import $ = require("jquery");
import Func from './func';

namespace EditCarrier {


    export class MyEditCarrier {
        public el: any;

        constructor(
            private ajaxing: boolean = false,
            private carDatas = {},
            ){

            let self = this;

            // 車両 項目削除
            $(document).on('click', '.trigRemoveEditCar', function(){
                if( window.confirm('この項目を消しますか？') ){
                    const num = $(this).attr('data-num');
                    $('.bulletRemoveEditCar[data-num="'+num+'"]').remove();
                }else{
                    return false;
                }
            });

            // 車両 項目追加
            $('#trigAddEditCar').click( () => {
                const num = Number( $('#trigAddEditCar').attr('data-num') );
                this.ajaxAddEditCar(num);
            });


            // 空車 項目削除
            $(document).on('click', '.trigRemoveEditEmpty', function(){
                if( window.confirm('この項目を消しますか？') ){
                    const num = $(this).attr('data-num');
                    $('.bulletRemoveEditEmpty[data-num="'+num+'"]').remove();
                }else{
                    return false;
                }
            });

            // 空車 項目追加
            $('#trigAddEditEmpty').click( () => {
                const num = Number( $('#trigAddEditEmpty').attr('data-num') );
                this.ajaxAddEditEmpty(num);
            });

            if( $('.paramCarData').length > 0 ){
                // 車サムネイル情報を保存
                for( let i=0; i<$('.paramCarData').length; i++){
                    let elm = $('.paramCarData').eq(i);
                    self.carDatas[ elm.data('id') ] = elm.data('filepath');
                }

                // 初期選択の車両画像を表示
                for( let i=0; i<$('.trigSelectEmptyCar').length; i++){
                    let elm = $('.trigSelectEmptyCar').eq(i);
                    const num = elm.attr('data-num');
                    const carId = elm.val();
                    $('.bulletSelectEmptyCar[data-num="'+num+'"]').css('background-image', 'url(' + self.carDatas[ carId ] +')');
                }

                // 空車車名選択でサムネイル画像を表示
                $(document).on('change', '.trigSelectEmptyCar', function(){
                    const num = $(this).attr('data-num');
                    const carId = $(this).val();
                    $('.bulletSelectEmptyCar[data-num="'+num+'"]').css('background-image', 'url(' + self.carDatas[ carId ] +')');
                });
            }
        }

        public ajaxAddEditCar(num): void{
            let self = this;
            self.ajaxing = true;
            const token: string = $('meta[name="csrf-token"]').attr('content');
            const D = {latest_num: num};

            $.ajax({
                headers: {'X-CSRF-TOKEN': token},
                url: '/ajax/add_edit_car',
                type: 'post',
                data: D,
                dataType: 'json',
                beforeSend: function(){
                    // 実行中画面
                    $('#ajaxing-waiting').show();
                },
                success: function( data ){
                    //console.log(data);
                    $('#bulletEditCars').append( data.view );
                    $('#trigAddEditCar').attr('data-num', data.new_num );
                },
                complete: function(){
                    // 実行中画面を消す
                    $('#ajaxing-waiting').hide();
                    self.ajaxing = false;
                }
            });
        }

        public ajaxAddEditEmpty(num): void{
            let self = this;
            self.ajaxing = true;
            const token: string = $('meta[name="csrf-token"]').attr('content');
            const D = {latest_num: num};

            $.ajax({
                headers: {'X-CSRF-TOKEN': token},
                url: '/ajax/add_edit_empty',
                type: 'post',
                data: D,
                dataType: 'json',
                beforeSend: function(){
                    // 実行中画面
                    $('#ajaxing-waiting').show();
                },
                success: function( data ){
                    //console.log(data);
                    $('#bulletEditEmpties').append( data.view );
                    $('#trigAddEditEmpty').attr('data-num', data.new_num );

                    // 初期選択の車両画像を表示
                    const carId = $('.trigSelectEmptyCar[data-num="'+data.new_num+'"]').val();
                    $('.bulletSelectEmptyCar[data-num="'+data.new_num+'"]').css('background-image', 'url(' + self.carDatas[ carId ] +')');
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
export default EditCarrier;


