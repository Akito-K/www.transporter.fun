<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Contact extends Model
{
    use softDeletes;
    protected $table = 'contacts';
    protected $dates = ['created_at', 'updated_at', 'deleted_at'];
    protected $guarded = ['id'];
/*
    public static $types = [
        1 => '会員登録・登録情報・ログイン等について',
        2 => '荷主様向け：ご注文（見積依頼・運送・キャンセル等について）',
        3 => '運送会社様向け：登録・受注(見積提出・運送・キャンセル等について)',
        4 => '一括見積・指定見積について',
        5 => 'システムの不具合について',
        6 => 'その他について',
    ];
*/
    public static $contacts = [
        1 => [
            'type' => '会員登録・登録情報・ログイン等について',
            'subjects' => [
                1 => '新規登録ができない',
                2 => 'ログインができない',
                3 => 'パスワードの再設定ができない',
                4 => 'メールアドレスを変更したい',
                5 => '物流サービスの案件登録について',
                6 => 'クレジットカード情報について',
                7 => '登録情報の変更・退会について',
            ],
        ],
        2 => [
            'type' => '荷主様向け：ご注文（見積依頼・運送・キャンセル等について）',
            'subjects' => [
                1 => 'お支払いについて',
                2 => '見積依頼・発注手続き・カードエラーについて',
                3 => '運送・運送後について',
                4 => 'キャンセル・返金について',
                5 => 'その他',
            ],
        ],
        3 => [
            'type' => '運送会社様向け：登録・受注(見積提出・運送・キャンセル等について)',
            'subjects' => [
                1 => '基本情報登録',
                2 => '車両・空車情報登録',
                3 => '見積提出・受注手続き等について',
                4 => '受注から運送・配送まで',
                5 => '運送・配送から取引完了まで',
                6 => 'キャンセル・返金について',
                7 => 'その他',
            ],
        ],
        4 => [
            'type' => '一括見積・指定見積について',
            'subjects' => [
                1 => '案件登録前',
                2 => '見積依頼前',
                3 => '見積依頼中',
            ],
        ],
        5 => [
            'type' => 'システムの不具合について',
            'subjects' => [
                1 => '-',
            ],
        ],
        6 => [
            'type' => 'その他について',
            'subjects' => [
                1 => 'ご意見・ご要望',
                2 => 'カテゴリ・特集のご要望',
                3 => '通報',
                4 => 'その他',
            ],
        ],
    ];


    public static function getNewId(){
        $date_at = new \Datetime();
        $new_id = 'CTT-'.$date_at->format('ymd-His-').\Func::getRandStr("Aa0", 5);

        return $new_id;
    }

    public static function getTypeNames(){
        $ary = ['' => '選択してください'];
        $contacts = Contact::$contacts;
        foreach($contacts as $k => $data){
            $ary[$k] = $data['type'];
        }

        return $ary;
    }

    public static function getSubjectNamesAry(){
        $ary = [];
        $contacts = Contact::$contacts;
        foreach($contacts as $type_id => $data){
                $ary[$type_id] = ['' => '選択してください'];
            foreach($data['subjects'] as $subject_id => $subject_str){
                $ary[$type_id][$subject_id] = $subject_str;
            }
        }

        return $ary;
    }

    public static function saveData( $request_data ){
        $request_data = (object) $request_data;

        $contact_id = Contact::getNewId();
        $data = new Contact;
        $data->contact_id = $contact_id;
        $data->type_id = $request_data->type_id;
        $data->subject_id = $request_data->subject_id;
        $data->company = $request_data->company;
        $data->section = $request_data->section;
        $data->sei = $request_data->sei;
        $data->mei = $request_data->mei;
        $data->email = $request_data->email;
        $data->tel = $request_data->tel;
        $data->body = $request_data->body;
        $data->save();
    }

}
