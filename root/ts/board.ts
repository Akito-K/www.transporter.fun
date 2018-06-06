'use strict';
import Config from './config';
import $ = require("jquery");
import Func from './func';

namespace Board {


    export class MyBoard {
        public el: any;
        public defaultTextareaHeight: number = 30;
        public defaultTextareaLineHeight: number = 20;

        constructor(
            private ajaxing: boolean = false,
            ){
            let self = this;

            if($('#board-input').length > 0){
                // メッセージの入力欄までスクロール
                Func.smoothScroll(this.getBottom(), true);

                // テキストエリアの高さ自動調整
                this.resizeTextareaInitialize('#bulletMessage');
                $('#bulletMessage').on("input", function(evt){
                    self.resizeTextarea(evt);
                });
            }

            // 以前のメッセージ読み込み
            $('#trigGetOver10').click( () => {
                const boardId = $('#over10').attr("data-board_id");
                this.ajaxGetOver10(boardId);
            });

            $('.trigSubmitMessage').click( () => {
                this.submitMessage();
            });

            /**
             *   38 ↑
             * 37 ←   → 39
             *   40 ↓
             * 32: space
             * 27: ESC
             */
            $(window).keydown( (e) => {
                if( $('#bulletMessage').is(':focus') ){
                    if( (e.ctrlKey || e.altKey) && e.keyCode == 13 ){
                        this.submitMessage();
                    }
                    if( e.ctrlKey && e.keyCode == 77 ){
                        this.changeFlagMemo();
                    }
                }
            });

            // ボードを常に更新
            if( $('#paramHashedId').length > 0 ){
                const hashedId = $('#paramHashedId').val();
                setInterval( () => {
                    self.refreshMessages(hashedId);
                }, 3000);
            }

            // 未読アイコンを常に更新
            if( $('.bulletUnreadCount').length > 0 ){
                setInterval( () => {
                    self.ajaxRefreshUnreadCount();
                }, 3000);
            }
        }

        public refreshMessages(hashedId): void {
            // 表示されている最新の message_id を取得 ->latest [JS]
            let messageId: string;
            for( let i: number=0; i<$('.paramMessageIds').length; i++){
                messageId = $('.paramMessageIds').eq(i).val();
            }

            this.ajaxRefreshMessages(hashedId, messageId);
                // 新しい順に message_id を取得 -> news [PHP]
                // news を評価して latest にあたれば終了
                // あたるまでの message_id を view に突っ込む
                // append [JS]
        }

        public getViewMessageIds(): any {
            let IDs = [];
            for( let i: number=0; i<$('.paramMessageIds').length; i++){
                IDs.push( $('.paramMessageIds').eq(i).val() );
            }

            return IDs;
        }

        public getBottom(): number {
            let y: number = 0;
            const contentTop: number = Number( $('#board-content').offset().top );
            const contentHeight: number = Number( $('#board-content').height() );
            const contentBotttom: number = contentTop + contentHeight;
            const inputHeight: number = Number( $('#board-input').outerHeight() ) | 0;
            y = contentBotttom - $(window).height() + inputHeight;

            return y;
        }

        public resizeTextareaInitialize(id){
            $(id).height(this.defaultTextareaHeight);//init
            $(id).css("lineHeight", this.defaultTextareaLineHeight + 'px');//init
        }

        public resizeTextarea(evt){
            const target = <HTMLElement>evt.target;
            const lineHeight = Number($(target).css("lineHeight").split("px")[0]);
            while (true){
                $(target).height($(target).height() - lineHeight);
                if( target.scrollHeight > 400){
                    $(target).height(400);
                }else if(target.scrollHeight > target.offsetHeight){
                    $(target).height(target.scrollHeight);
                }
                break;
            }
        }

        public ajaxGetOver10(boardId): void{
            let self = this;
            self.ajaxing = true;
            const token: string = $('meta[name="csrf-token"]').attr('content');
            const D = {board_id: boardId};

            $.ajax({
                headers: {'X-CSRF-TOKEN': token},
                url: '/ajax/get_over10',
                type: 'post',
                data: D,
                dataType: 'json',
                beforeSend: function(){
                    // 実行中画面
                    $('#ajaxing-waiting').show();
                },
                success: function( data ){
                    $('#over10').prepend(data.view);
                    if( Number(data.remain) === 0){
                        $('#bulletGetOver10Btn').remove();
                    }
                },
                complete: function(){
                    // 実行中画面を消す
                    $('#ajaxing-waiting').hide();
                    self.ajaxing = false;
                }
            });
        }

        public submitMessage(): void {
            const boardId = $('#over10').attr("data-board_id");
            const body = $('#bulletMessage').val();
            if(body.length > 0){
                this.ajaxPutMessage(boardId, body);
            }else{
                return;
            }
        }

        public ajaxPutMessage(boardId, body){
            let self = this;
            self.ajaxing = true;
            const token: string = $('meta[name="csrf-token"]').attr('content');
            const D = {board_id: boardId, body: body};

            $.ajax({
                headers: {'X-CSRF-TOKEN': token},
                url: '/ajax/put_message',
                type: 'post',
                data: D,
                dataType: 'json',
                beforeSend: function(){
                    // 実行中画面
                    $('#ajaxing-waiting').show();
                },
                success: function( data ){
//                    console.log(data);
                    if(data.result){
                        self.appendMessages(data.views);
                        $('#bulletMessage').val("").height(self.defaultTextareaHeight);
                    }
                },
                complete: function(){
                    // 実行中画面を消す
                    $('#ajaxing-waiting').hide();
                    self.ajaxing = false;
                }
            });
        }

        public appendMessages(views): void {
            const viewIDs = this.getViewMessageIds();
            $.each(views, function(id, body){
                if(!Func.inArray(id, viewIDs)){
                    $('#latest10').append(body);
                }
            });
        }

        public changeFlagMemo(): void {
            const flag: boolean = $('#flag_memo').prop("checked")? false: true;
            $('#flag_memo').prop("checked", flag);
        }

        public ajaxRefreshMessages(hashedId, messageId){
            // 新しい順に message_id を取得 -> news [PHP]
            // news を評価して latest にあたれば終了
            // あたるまでの message_id を view に突っ込む
            // append [JS]
            let self = this;
            self.ajaxing = true;
            const token: string = $('meta[name="csrf-token"]').attr('content');
            const D = {hashed_id: hashedId, message_id: messageId};

            $.ajax({
                headers: {'X-CSRF-TOKEN': token},
                url: '/ajax/refresh_messages',
                type: 'post',
                data: D,
                dataType: 'json',
                success: function( data ){
                    self.appendMessages(data.views);
                    $('.bulletUnreadCount').html(data.unread_count);
                }
            });
        }

        public ajaxRefreshUnreadCount(){
            let self = this;
            self.ajaxing = true;
            const token: string = $('meta[name="csrf-token"]').attr('content');

            $.ajax({
                headers: {'X-CSRF-TOKEN': token},
                url: '/ajax/get_unread_count',
                type: 'post',
                success: function( data ){
                    //console.log(data);
                    $('.bulletUnreadCount').html(data);
                }
            });
        }

    }

}
export default Board;
