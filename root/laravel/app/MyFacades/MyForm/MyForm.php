<?php

namespace MyFacade;

use Illuminate\Support\Facades\DB;

class MyForm
{
    // ラジオボタン
    public static function radioChild($name, $key, $flag_hecked, $option=[]){
        $body = '<input type="radio" name="'.$name.'" value="'.$key.'"';
        foreach($option as $k => $v){
            $body .= ' '.$k.'="'.$v.'"';
        }
        if($flag_hecked){
            $body .= ' checked="checked"';
        }
        $body .= '>';

        return $body;
    }

    // ラジオボタンのセット
    public static function radio($name, $values, $checked_value=NULL, $options=[], $delimitter=NULL){
        $body = "";

        $bodies = [];
        if(!empty($values)){
            foreach($values as $key => $val){
                $option = $options;
                $option['id'] = isset($options['id'])? $options['id'].'-'.$key: 'radio-'.$name.'-'.$key;
                $str = \MyForm::radioChild($name, $key, $key === $checked_value, $option);
                $str .= ' <label for="'.$option['id'].'">'.$val.'</label>';
                $bodies[] = $str;
            }

            switch($delimitter){
                case 'flex':
                    $body .= '<ul class="radiobox radiobox--flex">';
                    foreach($bodies as $str){
                        $body .= '<li>'.$str.'</li>';
                    }
                    $body .= '</ul>';
                    break;

                case 'span':
                    $body .= '<div class="radiobox radiobox--span">';
                    foreach($bodies as $str){
                        $body .= '<span>'.$str.'</span>';
                    }
                    $body .= '</div>';
                    break;

                default:
                    $body = implode($delimitter, $bodies);
                    break;
            }
        }

        return $body;
    }


    // 年選択肢
    public static function selectYear($selected){
        $body = '';
        for($i=1900; $i<=date("Y"); $i++){
            $sel = ($i == $selected)? " selected": "";
            $body .= '<option value="'.$i.'"'.$sel.'>'.$i.\Func::jpnYear($i).'</option>';
        }

        return $body;
    }

    // 月選択肢
    public static function selectMonth($selected){
        $body = '';
        for($i=1; $i<=12; $i++){
            $sel = ($i == $selected)? " selected": "";
            $body .= '<option value="'.$i.'"'.$sel.'>'.$i.'</option>';
        }

        return $body;
    }

    // 日選択肢
    public static function selectDay($selected){
        $body = '';
        for($i=1; $i<=31; $i++){
            $sel = ($i == $selected)? " selected": "";
            $body .= '<option value="'.$i.'"'.$sel.'>'.$i.'</option>';
        }

        return $body;
    }

    // 時間選択肢
    public static function selectHour($selected=''){
        $body = '';
        for($i=0; $i<=23; $i++){
            $sel = ($i == $selected)? " selected": "";
            $body .= '<option value="'.$i.'"'.$sel.'>'.$i.'</option>';
        }

        return $body;
    }

    // 分選択肢
    public static function selectMinutes($selected=''){
        $body = '';
        for($j=0; $j<=3; $j++){
            $i = $j * 15;
            $sel = ($i == $selected)? " selected": "";
            $body .= '<option value="'.$i.'"'.$sel.'>'.$i.'</option>';
        }

        return $body;
    }

    /**
     * @param array (
     *     'url': string,
     *     'values': array (
     *          name:string => value:string,
     *     ),
     *     'button': array (
     *         'text':string,
     *         'class': string,
     *     ),
     * )
     * @return string
     */
    public static function a ($options){
        $body = '';
        $body .= \Form::open(['url' => $options['url']]);
        if(!empty($options['values'])){
            foreach($options['values'] as $key => $value){
                $body .= \Form::hidden($key, $value);
            }
        }
        $body .= '<button type="submit" class="'.$options['button']['class'].'">'.$options['button']['text'].'</button>';
        $body .= \Form::close();

        return $body;
    }


    /**
     * string Laravel.Form::input の引数
     * string Laravel.Form::input の引数
     * string Laravel.Form::input の引数
     * ary    Laravel.Form::input の引数
     * ary    datalist の option 値
     */
/*
    public static function Form__inputAutoComplete($type, $name, $value, $options, $datalists){
        $body = \Form::input($type, $name, $value, $options);
        if(!empty($datalists)){
            $body .= '<datalist id="'.$options['list'].'">';
            foreach($datalists as $datalist){
                $body .= '<option value="'.$datalist.'">';
            }
            $body .= '</datalist>';
        }

        return $body;
    }
*/
}
