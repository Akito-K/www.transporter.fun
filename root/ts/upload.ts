'use strict';
import Config from './config';
import $ = require("jquery");
import Func from './func';

namespace Upload {


    export class MyUpload {
        public el: any;
        public uploadSizeLimitImage: number =   15000000;
        public enableExtensionsImage = ['jpg', 'jpeg', 'gif', 'png'];

        public uploadSizeLimitZip:   number = 1000000000;
        public enableExtensionsZip   = ['zip'];

        public uploadSizeLimitFree:  number = 1000000000;
        public enableExtensionsFree  = ['jpg', 'jpeg', 'gif', 'png', 'zip', 'rar', 'ai', 'eps', 'pdf', 'psd', 'doc', 'docx', 'xls', 'xlsx', 'ttp', 'ttpx', 'txt'];

        public uploadSizeLimitExcel: number = 1000000000;
        public enableExtensionsExcel = ['xls', 'xlsx'];

        private ext: string = 'jpg';

        constructor(
            private ajaxing: boolean = false,
            private multipleNumber: number = 0,
            ){

            let self = this;

            // フェイクのファイル選択ボタン
            $('.trigAjaxingUploadingBtn').click( () => {
                $('#bulletFakeInput').click();
                return false;
            });

            // ファイルをアップロード
            $('#bulletFakeInput').change( function(){
                // ファイル情報を取得
                const files = this.files;
                const type = $(this).data("type");
                const target = $(this).data("target");
                const checked = self.checkUploadFile(files, type);
                if(checked.result){
                    self.uploadFile(files[0], type, target);

//                    if( target == "image"){
/*
                    }else{
                        if(self.confirmFileInfo(files[0])){
                            self.uploadFile(files[0], target);
                        }else{
                            return false;
                        }
                    }
*/
                }else{
                    alert(checked.errorMessage);
                    return false;
                }
            });

            // 複数アップロード無効
            if( $('#flagMultipleUpload').length == 0 ){

                // ドラッグドロップからの入力
                $(window).bind("drop", function (e) {
                    // false を返してデフォルトの処理を実行しないようにする
                    return false;
                })
                .bind("dragenter", function () {
                    $('#ajaxing-drag-enter').show();
                    // false を返してデフォルトの処理を実行しないようにする
                    return false;
                })
                .bind("dragover", function () {
                    // false を返してデフォルトの処理を実行しないようにする
                    return false;
                })
                .bind("dragleave", function () {
                    // false を返してデフォルトの処理を実行しないようにする
                    return false;
                });

                // ドラッグドロップからの入力
                $('#ajaxing-drag-enter').bind("drop", function (event: JQueryEventObject) {
                    $('#ajaxing-drag-enter').hide();
                    // ドラッグされたファイル情報を取得
                    const dragEvent = <DragEvent>event.originalEvent,
                        dataTransfer = dragEvent.dataTransfer,
                        files = dataTransfer.files;
                    const type = $('#bulletFakeInput').data("type");
                    const target = $('#bulletFakeInput').data("target");
                    const checked = self.checkUploadFile(files, type);

                    if(checked.result){
                        self.uploadFile(files[0], type, target);
                    }else{
                        alert(checked.errorMessage);
                    }
                    // false を返してデフォルトの処理を実行しないようにする
                    return false;
                })
                .bind("dragenter", function () {
                    $('#ajaxing-drag-enter').show();
                    // false を返してデフォルトの処理を実行しないようにする
                    return false;
                })
                .bind("dragover", function () {
                    // false を返してデフォルトの処理を実行しないようにする
                    return false;
                })
                .bind("dragleave", function () {
                    $(this).hide();
                    // false を返してデフォルトの処理を実行しないようにする
                    return false;
                });

                $('#ajaxing-drag-enter').bind("mouseleave click", () => {
                    $('#ajaxing-drag-enter').hide();
                });

            }else{
            // 複数アップロード有効

                // ドラッグドロップからの入力
                $('.trigAjaxingUploadingArea').bind("drop", function (e) {
                    //$('.bulletAjaxingDragEnters').hide();
                    // false を返してデフォルトの処理を実行しないようにする
                    return false;
                })
                .bind("dragenter", function () {
                    self.multipleNumber = Func.number( $(this).attr('data-num') );
                    $('.bulletAjaxingDragEnters[data-num="'+ self.multipleNumber +'"]').show();
                    console.log( self.multipleNumber );
                    // false を返してデフォルトの処理を実行しないようにする
                    return false;
                })
                .bind("dragover", function () {
                    // false を返してデフォルトの処理を実行しないようにする
                    return false;
                })
                .bind("dragleave", function () {
                    // false を返してデフォルトの処理を実行しないようにする
                    return false;
                });

                // ドラッグドロップからの入力
                $('.bulletAjaxingDragEnters').bind("drop", function (event: JQueryEventObject) {
                    $('.bulletAjaxingDragEnters').hide();
                    // ドラッグされたファイル情報を取得
                    const dragEvent = <DragEvent>event.originalEvent,
                        dataTransfer = dragEvent.dataTransfer,
                        files = dataTransfer.files;
                    const type = $('.bulletFakeInput[data-num="'+ self.multipleNumber +'"]').attr("data-type");
                    const target = $('.bulletFakeInput[data-num="'+ self.multipleNumber +'"]').attr("data-target");
                    const checked = self.checkUploadFile(files, type);
                    console.log(files, type, target, checked);

                    if(checked.result){
                        self.uploadFile(files[0], type, target);
                    }else{
                        alert(checked.errorMessage);
                    }
                    // false を返してデフォルトの処理を実行しないようにする
                    return false;
                })
                .bind("dragenter", function () {
                    // false を返してデフォルトの処理を実行しないようにする
                    return false;
                })
                .bind("dragover", function () {
                    // false を返してデフォルトの処理を実行しないようにする
                    return false;
                })
                .bind("dragleave", function () {
                    $(this).hide();
                    // false を返してデフォルトの処理を実行しないようにする
                    return false;
                });
/*
                $('#ajaxing-drag-enter').bind("mouseleave click", () => {
                    $('#ajaxing-drag-enter').hide();
                });
*/
            }

/*
            // SUBMIT ボタン押した時に処理中画面表示
            $('.trigGoNext').click( () => {
                $('#ajaxing').show();
            });
*/
        }

        /**
         * @param obj {name, size, type, lastModified, lastModifiedDate}
         * @return boolean
         */
        public checkUploadFile(files, type): any {
            let result = true;
            let errorMessage = "";
            if(files.length == 0){
                result = false;
                errorMessage = "ファイルがありません";
            }else{
                files = files[0];
                this.ext = Func.getExtention(files.name);
                let extensions = [];
                let limit = 0;
                if( type == "image"){
                    extensions = this.enableExtensionsImage;
                    limit = this.uploadSizeLimitImage;

                }else if( type == "spreadsheet"){
                    extensions = this.enableExtensionsExcel;
                    limit = this.uploadSizeLimitExcel;

                }else if( type == "all"){
                    extensions = this.enableExtensionsFree;
                    limit = this.uploadSizeLimitFree;

                }else{
                    extensions = this.enableExtensionsZip;
                    limit = this.uploadSizeLimitZip;
                }

                if( !Func.inArray(this.ext, extensions)){
                    result = false;
                    errorMessage = "\"" + this.ext + "\" is invalid!\n使用できる拡張子は " + extensions.join("、") + " です";
                }else if(files.size > limit){
                    result = false;
                    errorMessage = "FIle size \""+ Func.unitFormat(files.size) +"\" is too large!\nファイルサイズは " + Func.unitFormat( limit ) + " 以内にして下さい";
                }
            }

            return {result: result, errorMessage: errorMessage};
        }

        /**
         * @param obj {name, size, type, lastModified, lastModifiedDate}
         * @param string
         * @return boolean
         */
        public uploadFile(files, type, target): void{
            let fd = new FormData();
            fd.append("file", files);
            //fd.append('upload_id', $('#uploadId').val());
            fd.append('ext', this.ext);
            fd.append('name', files.name);
            fd.append('type', type);
            fd.append('target', target);

            if(target === "board-file"){
                this.ajaxUploadFileAndPutBoardFile(fd, target, files.name);
            }else if(target === "cars"){
                this.ajaxUploadSomeFile(fd, files.name);
            }else{
                this.ajaxUploadFile(fd, target, files.name);
            }
        }


        public ajaxUploadSomeFile(fd, filename): void{
            let self = this;
            self.ajaxing = true;
            const token: string = $('meta[name="csrf-token"]').attr('content');
            //fd.append('multiple_number', self.multipleNumber);

            $.ajax({
                headers: {'X-CSRF-TOKEN': token},
                url: '/ajax/upload_some_file',
                type: 'post',
                data: fd,
                dataType: 'json',
                cache: false,
                processData: false,
                contentType: false,
                beforeSend: function(){
                    // 実行中画面
                    $('#ajaxing-uploading').show();
                },
                success: function( data ){
                    console.log(data);
                    $('.bulletUploadedImage[data-num="'+ self.multipleNumber +'"]').css('background-image', 'url(' + data.path + '/' + data.filename +')');
                    $('.bulletUploadId[data-num="'+ self.multipleNumber +'"]').val( data.upload_id );
                    $('.bulletUploadedFilepath[data-num="'+ self.multipleNumber +'"]').val( data.path + '/' + data.filename );
                },
                complete: function(){
                    // 実行中画面を消す
                    $('#ajaxing-uploading').hide();
                    self.ajaxing = false;
                }
            });
        }

        public ajaxUploadFile(fd, target, filename): void{
            let self = this;
            self.ajaxing = true;
            const token: string = $('meta[name="csrf-token"]').attr('content');

            $.ajax({
                headers: {'X-CSRF-TOKEN': token},
                url: '/ajax/upload_file',
                type: 'post',
                data: fd,
                dataType: 'json',
                cache: false,
                processData: false,
                contentType: false,
                beforeSend: function(){
                    // 実行中画面
                    $('#ajaxing-uploading').show();
                },
                success: function( data ){
                    console.log(data);
                    if(target == "pagemeta"){
                        $('#bulletUploadedImage').html(data.original_filename);
                        $('#upload_id').val( data.upload_id );
                        $('#filepath').val( data.path + '/' + data.filename );

                    }else{
                        $('#bulletUploadedImage').css('background-image', 'url(' + data.path + '/' + data.filename +')');
                        $('#upload_id').val( data.upload_id );
                        $('#filepath').val( data.path + '/' + data.filename );
                    }
/*
                    }else{
                        $('#bulletFakeInput').val("");
                        $('#originalFilename').val(filename);
                        $('#frm').submit();
                    }
*/
                },
                complete: function(){
                    // 実行中画面を消す
                    $('#ajaxing-uploading').hide();
                    self.ajaxing = false;
                }
            });
        }


        public ajaxUploadFileAndPutBoardFile(fd, target, filename): void {
            let self = this;
            self.ajaxing = true;
            const token: string = $('meta[name="csrf-token"]').attr('content');

            const boardId = $('#over10').attr("data-board_id");
            const body = $('#bulletMessage').val();
            fd.append('board_id', boardId);
            fd.append('body', body);

            $.ajax({
                headers: {'X-CSRF-TOKEN': token},
                url: '/ajax/upload_file_and_put_board_file',
                type: 'post',
                data: fd,
                dataType: 'json',
                cache: false,
                processData: false,
                contentType: false,
                beforeSend: function(){
                    // 実行中画面
                    $('#ajaxing-uploading').show();
                },
                success: function( data ){
//                    console.log(data);
                    if(data.result){
                        $('#latest10').append(data.view);
                    }
                },
                complete: function(){
                    // 実行中画面を消す
                    $('#ajaxing-uploading').hide();
                    self.ajaxing = false;
                }
            });



        }
/*
        public confirmFileInfo(files): boolean {
            let body = '';
            body += 'ファイル名：' + files.name + "\n";
            body += 'サイズ：' + Func.unitFormat(files.size);
            body += "\n";
            body += "このファイルでよろしければアップロードを行います";

            if( !window.confirm(body) ){
                return false;
            }else{
                return true;
            }
//            $('#bulletZipFileInfo').html(body);
        }
*/
    }

}
export default Upload;


