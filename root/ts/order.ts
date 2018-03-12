'use strict';
import Config from './config';
import $ = require("jquery");

namespace Order {

    // 定番商品を一覧で見る 開閉
    export class standardList {
        public el: any;

        constructor(){
            this.el = $('#standard-list-title');
            this.el.click( () => {
                this.view();
            });
        }

        public view(): void {
            if( this.el.attr("data-open") == 0 ){
                this.el.addClass("open").attr("data-open", 1);
                $('#standard-all').show();
            }else{
                this.el.removeClass("open").attr("data-open", 0);
                $('#standard-all').hide();
            }
        }
    }




    // wizard 次を表示
    export class viewNext {
        constructor() {
            let self = this;
            $('.view-next').click( function(){
                self.next( $(this) );
            });
        }

        public next(el): void {
            const key = el.data("key");
            Func.next(key);
        }
    }




    // switch クリックで選択
    export class wizardSwitch {
        public el: any;
        public id: string = '';
        public val: string = '';
        public valFace: {old: string, new: string} = {old: '', new: ''};

        constructor() {
            $('#item_name').focus();

            let self = this;
            $('.trigWizardSwitch').click( function(){
                self.el = $(this);
                self.setEl();
                self.setInputValue();
                self.style();
                self.viewColors();
                self.next();
                self.result();
            });
        }

        public setEl(): void {
            this.id = this.el.data("input-id");
            this.val = this.el.data("val");
            if(this.id === "face_code"){
                this.valFace.old = this.valFace.new;
                this.valFace.new = this.val;
            }
        }

        // inputタグに値を入れる
        public setInputValue(): void {
            $('#' + this.id).val(this.val);
            if(this.id === "face_code"){
                if(this.valFace.old != this.valFace.new){
                    $('#color_code').val("");
                    Func.flushWizardEstimate();
                    Func.flushWizardItems();
                }
            }
        }

        // 選択状態の CSS を操作する
        public style(): void {
            this.el.parent('ul').children('li').removeClass("selected");
            this.el.addClass("selected");
        }

        // 印刷面変更で色数選択肢変化
        public viewColors(): void {
            if(this.id === "face_code"){
                if(this.valFace.old != this.valFace.new){
                    if(this.val == "2"){
                        $('.wizard__switch.color').hide().removeClass("selected");
                        $('.wizard__switch.color.44').show();
                        $('.wizard__switch.color.41').show();
                        $('.wizard__switch.color.11').show();
                    }else{
                        $('.wizard__switch.color').hide().removeClass("selected");
                        $('.wizard__switch.color.40').show();
                        $('.wizard__switch.color.10').show();
                    }
                }
            }
        }

        // 次の項目を開く
        public next(): void {
            const key = $('.view-next--' + this.id).attr("data-key");
            Func.next(key);
        }

        // 結果エリアに結果を表示
        public result(): void {
            const answer = this.el.html().replace('<br>', "／");
            $('#result--' + this.id).html(answer);
        }
    }




    // switchSize クリックで選択
    export class size {
        public el: any;
        public inputId: string = '';
        public val: string = '';
        public large: string = '';
        public wizardType: string = '';
        public length: {
            old: {long: number, short: number},
            new: {long: number, short: number},
        } = {
            old: {long: 0, short: 0},
            new: {long: 0, short: 0},
        };

        constructor() {
            let self = this;

            // サイズのボタン
            $('.trigWizardSwitchSize').click( function(){
                self.el = $(this);
                self.setEl();
                self.setLength();
                self.style();
                self.setInputValue();
                self.view();
                self.next();
                self.viewSize();
                self.result();
            });

            // サイズホバーでヒント表示
            $('.trigWizardSwitchSize').mousemove( function(e){
                self.mouseMove(e);
            });
            // サイズホバーでヒント表示 - 値を入れる
            $('.trigWizardSwitchSize').hover( function(){
                self.mouseOn(this);
            }, function(){
                self.mouseOff();
            });

            // 寸法編集前のデータを一時保存
            $('.trigWizardSizeCounter').mouseover( () => {
                this.setOldFreeLength();
            });

            // 寸法からサイズを決める
            $('.trigWizardSizeCounter').mouseleave( () => {
                this.setNewFreeLength();
                if(this.checkUpdateSize()){
                    this.getPaperSize();
                }
            });
        }

        public setEl(): void {
            this.val = this.el.data("val");
            this.inputId = this.el.data("input-id");
            this.wizardType = $('#wizard_type').val();
            this.large = this.el.data("lg");
        }

        public setLength(): void {
            this.length.new.long  = Number($(this.el).data("long"));
            this.length.new.short = Number($(this.el).data("short"));
        }

        public setOldFreeLength(): void {
            this.length.old.long  = this.length.new.long;
            this.length.old.short = this.length.new.short;
        }

        public setNewFreeLength(): void {
            this.length.new.long  = Number($('#long_length').val());
            this.length.new.short = Number($('#short_length').val());

            if(this.length.new.short > this.length.new.long){
                const len = this.length.new.long;
                this.length.new.long = this.length.new.short;
                this.length.new.short = len;
            }
        }

        // サイズ数値の更新があったかどうか
        public checkUpdateSize():boolean {
//            console.log(this.length);
            if(this.length.new.long != this.length.old.long ||
                this.length.new.short != this.length.old.short){
                return true;
            }else{
                return false;
            }
        }

        // 選択状態の CSS を操作する
        public style(): void {
            $('.trigWizardSwitchSize').removeClass("selected");
            $(this.el).addClass("selected");
        }

        // inputタグに値を入れる
        public setInputValue(): void {
            $('#size_code').val(this.val);
            $('#long_length').val(this.length.new.long);
            $('#short_length').val(this.length.new.short);
            $('#atypical').val("0");

            if(this.large == "1"){
                $('#paper_code').val("1");
                $('#film_code').val('N');
                $('#face_code').val('1');
                $('#color_code').val('40');
                $('#process_fold').val('0');
            }else{
                $('#paper_code').val("2");
            }
        }

        public view(): void {
            if(this.large == "1"){
                // film: N
                $('.wizard__switch.film').hide().removeClass("selected");
                $('.wizard__switch.film.N').show().addClass("selected");
                // face: 1
                $('.wizard__switch.face').hide().removeClass("selected");
                $('.wizard__switch.face.1').show().addClass("selected");
                // color: 40
                $('.wizard__switch.color').hide().removeClass("selected");
                $('.wizard__switch.color.40').show().addClass("selected");
                // fold: 00
                $('.wizard__switch.fold').hide().removeClass("selected");
                $('.wizard__switch.fold.0').show().addClass("selected");
                // line: 0
                $('#process_line').attr('disabled', 'disabled');
                // hole: 0
                $('#process_hole').attr('disabled', 'disabled');
            }else{
                // film: Full
                $('.wizard__switch.film').show();
                // face: Full
                $('.wizard__switch.face').show();
                // color: 40 10
                $('.wizard__switch.color.40').show();
                $('.wizard__switch.color.10').show();
                // fold: 00
                $('.wizard__switch.fold').show();
                // line: 0
                $('#process_line').removeAttr('disabled');
                // hole: 0
                $('#process_hole').removeAttr('disabled');
            }
        }

        // 次の項目を開く
        public next(): void {
            const key = $('.view-next--' + this.inputId).attr("data-key");
            Func.next(key);
        }

        // 選択中のサイズ欄を更新
        public viewSize(): void {
            const sizeName = $(this.el).data("name");
            $('#size_result').html(sizeName);
        }

        // 結果エリアに結果を表示
        public result(): void {
            const answer = this.el.html().replace('<br>', "／");
            $('#result--size_code').html(answer);
        }

        // サイズホバーでヒント表示
        public mouseMove(e): void {
            $('#hint-size').css("top", e.clientY - 5).css("left", e.clientX + 30).show();
        }

        // サイズホバーでヒント表示 - ヒントの値を取得
        public mouseOn(__this): void {
            const long  = $(__this).data("long");
            const short = $(__this).data("short");
            $('#hint-long').html(long);
            $('#hint-short').html(short);
            $('#hint-size').show();
        }
        public mouseOff(): void {
            $('#hint-size').hide();
        }

        // 寸法からサイズを決める
        public getPaperSize(): void {
            if( this.length.new.long === 0 || this.length.new.short === 0 ){
                // 選択中のサイズをリセット
                $('#size_result').html("-");
                $('.trigWizardSwitchSize').removeClass("selected");
                $('#size_code').val("");
            }else if( (this.length.new.long < 10 || this.length.new.short < 10) || (this.length.new.long < 20 && this.length.new.short < 20) ){
                // 小さすぎる時も選択中のサイズをリセット
                $('#size_result').html('<span class="wizard__size-result__error">極小サイズはお問い合わせください。</span>');
                $('.trigWizardSwitchSize').removeClass("selected");
                $('#size_code').val("");
            }else{
                Ajax.getPaperSize(this.length.new);
            }
        }
    }





    // +- ボタン
    export class controlCounter {
        public el: any;
        private target: string = '';
        private add: number = 1;
        private val: number = 0;

        // マウスダウン継続時間
        private clicking: number = 0;
        // 繰り返し実行するカウンター操作ファンクション
        private countIntervalFunc: any;
        // 繰り返し実行するマウスダウン継続時間計測ファンクション
        private mouseIntervalFunc: any;

        constructor() {
            let self = this;

            $(document).on('mousedown', '.trigCounterButtons', function(e){
                self.setEl(e, this);
                self.addInputCount();

                // ボタン押しっぱなし機能
                self.clickingButton();
            });

            // ボタン押しっぱなし機能 終了
            $(document).on('mouseup', '.trigCounterButtons', function(){
                clearInterval( self.countIntervalFunc );
                clearInterval( self.mouseIntervalFunc );
                self.clicking = 0;
            });

            // 複数デザイン時 数値を直接編集した時に計算を実行
            $('#designs_count, #bydesign_count').keyup(function(){
                self.viewResultMultiplication();
            });
        }

        public setEl(e, el): void {
            this.target = $(el).data("target");
            this.el = $(e.target);
            this.add = Number(this.el.data("add"));
        }

        // ターゲットの数値を変える
        public addInputCount(): void{
            const disabled = $('#' + this.target).attr("disabled");
            if( disabled !== "disabled"){
                const current: number = Number( $('#' + this.target).val() );
                this.val = current + this.add;
                if(this.val <= 0 || this.val == NaN){
                    this.val = 0;
                }
                $('#' + this.target).val(this.val);
                this.viewResultControl();
            }
        }

        // 数値の増減を結果エリアに反映
        public viewResultControl(): void{
            if(this.target === 'designs_count' || this.target === 'bydesign_count'){
                $('#result--' + this.target).html( this.val.toString() );
                this.viewResultMultiplication();
            }else{
                $('#result--' + this.target).html( this.val.toString() );
            }
        }

        // 枚数掛け算結果を表示
        public viewResultMultiplication(): void {
            const designs = Number($('#designs_count').val());
            const bydesign = Number($('#bydesign_count').val());
            const multi =  designs * bydesign;
            $('#designs-sum-designs').html(designs.toString());
            $('#designs-sum-bydesign').html(bydesign.toString());
            $('#designs-sum-sum').html(multi.toString());
        }

        // ボタン押しっぱなし機能
        public clickingButton(): void {
            // 継続時間計測
            this.mouseIntervalFunc = setInterval( () => {
                this.clicking += 10;
            }, 10);

            // 連続カウント操作
            this.countIntervalFunc = setInterval( () => {
                if(this.clicking > 500){
                    this.addInputCount();
                }
            }, 50);
        }
    }




    // 見積り表示欄がついて動く
    export class board {
        private top: number = 0;
        private width: number = 0;
        private sc: number = 0;

        constructor() {
            if(document.getElementById('wizard') !== null){
                this.top = Math.ceil( $('#wizard').position().top );
                this.width = Number( $('#estimate').width() );

                // スクロールイベント
                $(window).scroll( () => {
                    this.scroll();
                });
            }
        }

        public scroll(): void {
            this.sc = Number($(window).scrollTop());
            if(this.sc > this.top){
                $('#estimate').addClass("fixed").css("width", this.width);
            }else{
                $('#estimate').removeClass("fixed").css("width", "auto");
            }
        }
    }




    // Item
    export class item {
        public vals: {
            wizardType: string,
//            name: string,
            bookCode: string,
            sizeCode: string,
            length: {
                long: number,
                short: number,
            }
            paperCode: string,
            atypical: number,
            faceCode: number,
            colorCode: number,
            filmCode: string,
            counts: {
                simple: number,
                designs: number,
                bydesign: number
            },
            process: {
                fold: number,
                line: number,
                hole: number
            },
//            memo: string,
            designsFlag: number,
        };
        public valsOld: any;

        constructor() {
            let self = this;
            this.setParam();

            $('#item_name').keyup(() => {
                this.viewNameResult();
                this.next('item_name');
            });

            $('#memo').keyup(() => {
                this.viewMemoResult();
            });

            // スイッチで変更したらセット・再計算
            $('.trigItemSwitch').click( () => {
                this.setParam();
                this.estimate();
            });

            // 数値入力欄を離れたらセット・再計算
            $(document).on('mouseleave', '.trigCounter', () => {
                this.setParam();
                this.estimate();
            });

            // 入稿データ チェックボックスの振る舞い
            $('.trigWizardCheckData').click( function(){
                console.log("hoge");
                self.viewCheckData($(this));
                self.setParam();
                self.estimate();
            });

            // サイズを変更したらセット・再計算
            $('.trigWizardSwitchSize').click( () => {
                this.setParam();
                this.estimate();
            });

        }

        // 結果表示欄に値を入れる - name
        public viewNameResult(): void {
            const val:string = $('#item_name').val();
            $('#result--item_name').html(val);
        }

        // 結果表示欄に値を入れる - memo
        public viewMemoResult(): void {
            const val: string = $('#memo').val();
            $('#result--memo').html( val.replace(/\n/g, '<br />') );
        }

        // 次の項目を開く
        public next(id: string): void {
            const key = $('.view-next--' + id).attr("data-key");
            Func.next(key);
        }

        // チェックボックスの振る舞い
        public viewCheckData(el): void {
            const id = el.attr("data-id");
            const val = $('#' + id).val();
            if(val === "1"){
                $('#' + id).val("0");
                $('#check-' + id).html('');
            }else{
                $('#' + id).val("1");
                $('#check-' + id).html('<i class="fa fa-check"></i>');
            }

            if(id === "designs_flag"){
                this.showDesigns(val);
            }else if(id === "data_check"){
                this.showDataCheck(val);
            }else if(id === "data_edit"){
                this.showDataEdit(val);
            }

        }

        // 複数デザインパターン有り無し
        public showDesigns(checked): void {
            if(checked == "1"){
                $('#simple_count').removeAttr("disabled").focus();
                $('#designs_count, #bydesign_count').attr("disabled", "disabled");
                $('.wizard__count--more').slideUp();
            }else{
                $('#simple_count').attr("disabled", "disabled");
                $('#designs_count, #bydesign_count').removeAttr("disabled");
                $('.wizard__count--more').slideDown();
                $('#designs_count').focus();
            }
        }

        // データチェックを行う
        public showDataCheck(checked): void {
            if(checked == "1"){
                $('.wizard__data__edit').slideUp();
            }else{
                $('.wizard__data__edit').slideDown();
            }
        }

        // お任せデータ修正を利用する
        public showDataEdit(checked): void {
            if(checked == "1"){
                $('.wizard__data__edit__cource, .wizard__data__edit__pay').slideUp();
            }else{
                $('.wizard__data__edit__cource, .wizard__data__edit__pay').slideDown();
            }
        }

        public setParam(): void {
            this.valsOld = this.vals;
            this.vals = {
                wizardType: $('#wizard_type').val(),
//                name: $('#item_name').val(),
                bookCode: $('#book_code').val(),
                sizeCode: $('#size_code').val(),
                length: {
                    long: Number( $('#long_length').val() ),
                    short: Number( $('#short_length').val() ),
                },
                paperCode: $('#paper_code').val(),
                atypical: Number( $('#atypical').val() ),
                faceCode: Number( $('#face_code').val() ),
                colorCode: Number( $('#color_code').val() ),
                filmCode: $('#film_code').val(),

                counts: {
                    simple: Number( $('#simple_count').val() ),
                    designs: Number( $('#designs_count').val() ),
                    bydesign: Number( $('#bydesign_count').val() ),
                },
                process: {
                    fold: Number( $('#process_fold').val() ),
                    line: Number( $('#process_line').val() ),
                    hole: Number( $('#process_hole').val() ),
                },
//                memo: $('#memo').val(),
                designsFlag: Number( $('#designs_flag').val() ),
            };
        }

        public estimate(): any {
            if(!Func.checkObjectDiff(this.vals, this.valsOld)){
                if( Func.checkPreEstimate(this.vals) ){
                    // 正常作動
                    Ajax.estimateItem(this.vals);
                    Func.next( Func.getNextKey('count') );
                }
            }
        }

    }












    class Func {
        // wizard - 次の項目のキーを取得
        static getNextKey(id: string): string {
            return $('.view-next--' + id).data("key");
        }

        // wizard - 次の項目を開く
        static next(key: string): void {
            const target = $('.wizard__block--' + key);
            if(target.attr("data-open") !== "1"){
                target.slideDown().attr("data-open", 1);
            }
        }

        // 数値3ケタごとにコンマを挟む
        static number_format(num: any): string {
            if(num > 0){
                return num.toString().replace(/([0-9]+?)(?=(?:[0-9]{3})+$)/g , '$1,')
            }else{
                return "0";
            }
        }

        // 見積もり前に選択を満たしているかチェック
        static checkPreEstimate(vals): boolean {
            let flagDoAction: boolean = true;

            if(vals.wizardType === 'laminate'){
                const simple = $('#simple_count').val();

                if( !vals.sizeCode ||
                    !vals.filmCode ||
                    simple === ""){
                    flagDoAction = false;
                }

            }else{
                if( !vals.faceCode ||
                    !vals.paperCode ||
                    !vals.sizeCode ||
                    !vals.filmCode ||
                    !vals.colorCode){
                    flagDoAction = false;
                }

                const simple = $('#simple_count').val();
                const bydesign = $('#bydesign_count').val();
                const designs = $('#designs_count').val();

                if(vals.designsFlag === 0){
                    if(simple === ""){
                        flagDoAction = false;
                    }
                }
            }


            return flagDoAction;
        }

        // 見積もり結果をリセット
        static flushWizardEstimate(): void{
            $('#estimate-item, #estimate-process, #estimate-adjust, #estimate-tax, #estimate-sum, #estimate-per-simple, #estimate-per-designs, #estimate-due').html("-");
            $('#submit_cartin').attr("disabled", "disabled");
        }
        // 入力値をリセット
        static flushWizardItems(): void{
            $('#input-estimate-item, #input-estimate-process, #input-estimate-adjust, #input-estimate-tax, #input-estimate-sum, #input-estimate-due').val("");
        }

        static in_array(needle: string|number, haystack: string[]): boolean {
            let result: boolean = false;
            for(var i = 0, l = haystack.length; i < l; i++){
                if(haystack[i] == needle){
                    result = true;
                }
            }

            return result;
        }

        static checkObjectDiff(obj1: any, obj2: any): boolean {
            return JSON.stringify(obj1) === JSON.stringify(obj2);
        }
    }




    class Ajax {
        // wizard - 次の項目を開く
        static estimateItem(items): any {
            const token: string = $('meta[name="csrf-token"]').attr('content');
            $.ajax({
                headers: {'X-CSRF-TOKEN': token},
                type: "POST",
                url: "/ajax/get_estimate",
                data: items,
                dataType: "json",
                cache: false,
                beforeSend: function(){
                    // アップロード中画面
                    $('#area-ajax-uploading').show();
                },
                success: function(data){
//                    console.log(data);
                    if(data.error){
                        Func.flushWizardEstimate();
                        Func.flushWizardItems();
                    }else{
                        $('#estimate-item').html( Func.number_format(data.prices.item) );
                        $('#estimate-process').html( Func.number_format(data.prices.process) );
                        $('#estimate-adjust').html( Func.number_format(data.prices.adjust) );
                        $('#estimate-tax').html( Func.number_format(data.prices.tax) );
                        $('#estimate-sum').html( Func.number_format(data.prices.sum) );
                        $('#estimate-per-simple').html( Func.number_format(data.prices.per.simple) );
                        $('#estimate-per-designs').html( Func.number_format(data.prices.per.designs) );
                        $('#estimate-due').html( Func.number_format(data.due) );

                        $('#input-estimate-item').val(data.prices.item);
                        $('#input-estimate-process').val(data.prices.process);
                        $('#input-estimate-adjust').val(data.prices.adjust);
                        $('#input-estimate-tax').val(data.prices.tax);
                        $('#input-estimate-sum').val(data.prices.sum);
                        $('#input-estimate-due').val(data.due);
                        $('#submit_cartin').removeAttr("disabled");
                    }
                },
                complete: function(){
                    // アップロード中画面を消す
                    $('#area-ajax-uploading').hide();
                }
            });
        }

        // wizard - 次の項目を開く
        static getPaperSize(length): any {
            const token: string = $('meta[name="csrf-token"]').attr('content');

            $.ajax({
                headers: {'X-CSRF-TOKEN': token},
                type: "POST",
                url: "/ajax/get_size",
                data: length,
                dataType: "json",
                cache: false,
                beforeSend: function(){
                    // アップロード中画面
                    $('#area-ajax-size').show();
                },
                success: function(data){
                    $('.trigWizardSwitchSize').removeClass("selected");

                    if(!data.matched){
                        const error = '特大サイズはお問い合わせください。';

                        $('#size_code, #atypical').val("");
                        $('#size_result').html('<span class="wizard__size-result__error">' + error + '</span>');
                    }else{
                        $('.wizard__switch--size.'+data.code).addClass("selected");
                        $('#size_code').val(data.code);
                        $('#atypical').val(data.atypical);
                        if(data.atypical == 1){
                            data.name += '（変形）';
                        }
                        $('#size_result').html(data.name);
                    }
                },
                complete: function(){
                    // アップロード中画面を消す
                    $('#area-ajax-size').hide();
                }
            });
        }
    }
}
export default Order;


