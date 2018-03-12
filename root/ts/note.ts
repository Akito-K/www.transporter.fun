'use strict';
import Config from './config';
import $ = require("jquery");
import Func from './func';

namespace Note {


    export class MyNote {
        public el: any;

        constructor(
            private ajaxing: boolean = false,
            ){

            let self = this;

            // フェイクのファイル選択ボタン
            $('.trigChangeNotesView').click( function(){
                self.el = $(this);
                self.changeNoteView();
            });

            // まとめて入力 から利用者を除外
            $('body').on('click', '.trigRemoveNoteCreates', function(){
                const hashedId = $(this).data('hashed_id');
                self.removeNoteCreates(hashedId);
            });

            // まとめて入力 に利用者を追加
            $('#trigAddNoteCreates').click( () => {
                const hashedId = $('#bulletAddNoteCreates').val();
                self.addNoteCreates(hashedId);
            });
        }

        public changeNoteView(){
            $('.trigChangeNotesView').removeClass("selected");
            this.el.addClass("selected");

            const num = this.el.data('key');
            $('.bulletNotesBox').removeClass("show").hide();
            $('.bulletNotesBox[data-key="'+num+'"]').addClass("show");
        }

        public removeNoteCreates(hashedId){
            $('.bulletRemoveNoteCreates[data-hashed_id="'+hashedId+'"]').remove();
            this.ajaxRemoveNoteCreates(hashedId);
        }

        public ajaxRemoveNoteCreates(hashedId): void{
            let self = this;
            self.ajaxing = true;
            const token: string = $('meta[name="csrf-token"]').attr('content');
            const D = {hashed_id: hashedId};

            $.ajax({
                headers: {'X-CSRF-TOKEN': token},
                url: '/mimamori/ajax/remove_note_creates',
                type: 'post',
                data: D,
                dataType: 'json',
                beforeSend: function(){
                    // 実行中画面
                    $('#ajaxing-waiting').show();
                },
                success: function( data ){
                    $('#bulletAddNoteCreates').append(data.view);
                },
                complete: function(){
                    // 実行中画面を消す
                    $('#ajaxing-waiting').hide();
                    self.ajaxing = false;
                }
            });
        }

        public addNoteCreates(hashedId){
            this.ajaxAddNoteCreates(hashedId);
        }

        public ajaxAddNoteCreates(hashedId): void{
            let self = this;
            self.ajaxing = true;
            const token: string = $('meta[name="csrf-token"]').attr('content');
            const D = {hashed_id: hashedId};

            $.ajax({
                headers: {'X-CSRF-TOKEN': token},
                url: '/mimamori/ajax/add_note_creates',
                type: 'post',
                data: D,
                dataType: 'json',
                beforeSend: function(){
                    // 実行中画面
                    $('#ajaxing-waiting').show();
                },
                success: function( data ){
                    //console.log(data.view);
                    $('#bulletNoteCreates').append(data.view);
                    $('#bulletAddNoteCreates option[value="'+hashedId+'"]').remove();
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
export default Note;


