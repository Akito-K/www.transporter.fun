'use strict';
import Config from './config';
import $ = require("jquery");
import Func from './func';

namespace Signup {
    export class MySignup {
        public el: any;

        constructor(
            private ajaxing: boolean = false,
            ){

            let self = this;

            // 選択状態切り替え
            $('.trigSelectType').click( function(){
                const checked = $(this).find('input').prop('checked');
                let value = checked? 1: 0;
                $(this).attr("data-select", value);

                self.checkNextBtn();
            });

            $('.trigCheckAccept').click( function(){
                const content = $(this).data('content');
                const checked = $(this).attr('data-checked');
                let value = checked == "0" ? "1": "0";
                $('.trigCheckAccept[data-content="'+content+'"]').attr("data-checked", value);
                if(value == "0"){
                    $('.trigCheckAccept[data-content="'+content+'"] .bulletCheckAccept').html('');
                }else{
                    $('.trigCheckAccept[data-content="'+content+'"] .bulletCheckAccept').html('<i class="fa fa-check"></i>');
                }

                self.checkNextBtnEpsilon();
            });
        }

        public checkNextBtn(): void {
            const flagOwner = $('input[name="flag_owner"]').prop('checked');
            const flagCarrier = $('input[name="flag_carrier"]').prop('checked');
            if( !flagOwner && !flagCarrier ){
                $('.bulletNextBtn').prop("disabled", true);
            }else{
                $('.bulletNextBtn').prop("disabled", false);
            }
        }

        public checkNextBtnEpsilon(): void {
            const checks = $('.trigCheckAccept');
            let flagError = false;
            for( let i=0; i<checks.length; i++){
                if( checks.eq(i).attr("data-checked") == "0" ){
                    flagError = true;
                }
                //console.log( checks.eq(i).attr("data-checked") );
            };

            if( flagError ){
                $('.bulletNextBtnEpsilon').attr("disabled", "disabled");
            }else{
                $('.bulletNextBtnEpsilon').removeAttr("disabled");
            }
        }
    }

}
export default Signup;


