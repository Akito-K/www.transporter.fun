<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines contain the default error messages used by
    | the validator class. Some of these rules have multiple versions such
    | as the size rules. Feel free to tweak each of these messages here.
    |
    */

    'accepted'             => ':attribute に同意頂く必要があります。',
    'active_url'           => ':attribute は有効な URL ではありません。',
    'after'                => ':attribute は :date より未来である必要があります。',
    'after_or_equal'       => ':attribute は :date 以降である必要があります。',
    'array'                => ':attribute は配列である必要があります。',
    'before'               => ':attribute は :date より過去である必要があります。',
    'before_or_equal'      => ':attribute :date 以前である必要があります。',
    'between'              => [
        'numeric' => ':attribute must be between :min and :max。',
        'file'    => ':attribute must be between :min and :max kilobytes。',
        'string'  => ':attribute must be between :min and :max characters。',
        'array'   => ':attribute must have between :min and :max items。',
    ],
    'boolean'              => ':attribute field must be true or false。',
    'confirmed'            => ':attribute が一致しません。',
    'date'                 => ':attribute は無効な日付です。',
    'date_format'          => ':attribute does not match the format :format。',
    'different'            => ':attribute and :other must be different。',
    'digits'               => ':attribute must be :digits digits。',
    'digits_between'       => ':attribute must be between :min and :max digits。',
    'dimensions'           => ':attribute has invalid image dimensions。',
    'distinct'             => ':attribute field has a duplicate value。',
    'email'                => ':attribute は無効なメールアドレスのようです。',
    'exists'               => '選択の :attribute は無効です。',
    'file'                 => ':attribute must be a file。',
    'filled'               => ':attribute field must have a value。',
    'image'                => ':attribute must be an image。',
    'in'                   => 'The selected :attribute is invalid。',
    'in_array'             => ':attribute field does not exist in :other。',
    'integer'              => ':attribute は数値である必要があります。',
    'ip'                   => ':attribute must be a valid IP address。',
    'ipv4'                 => ':attribute must be a valid IPv4 address。',
    'ipv6'                 => ':attribute must be a valid IPv6 address。',
    'json'                 => ':attribute must be a valid JSON string。',
    'max'                  => [
        'numeric' => ':attribute は :max より小さい数値でなくてはなりません。',
        'file'    => ':attribute は :max キロバイトより小さくなくてはなりません。',
        'string'  => ':attribute は :max 文字以内でなくてはなりませんcharacters。',
        'array'   => ':attribute may not have more than :max items。',
    ],
    'mimes'                => ':attribute must be a file of type: :values。',
    'mimetypes'            => ':attribute must be a file of type: :values。',
    'min'                  => [
        'numeric' => ':attribute は少なくとも :min でなくてはなりません。',
        'file'    => ':attribute は少なくとも :min キロバイトはなくてはなりません。',
        'string'  => ':attribute は少なくとも :min 文字なければなりません。',
        'array'   => ':attribute must have at least :min items。',
    ],
    'not_in'               => 'The selected :attribute is invalid。',
    'numeric'              => ':attribute は数値である必要があります。',
    'present'              => ':attribute field must be present。',
    'regex'                => ':attribute format is invalid。',
    'required'             => ':attribute が空白です。',
    'required_if'          => ':attribute field is required when :other is :value。',
    'required_unless'      => ':attribute field is required unless :other is in :values。',
    'required_with'        => ':attribute field is required when :values is present。',
    'required_with_all'    => ':attribute field is required when :values is present。',
    'required_without'     => ':attribute field is required when :values is not present。',
    'required_without_all' => ':attribute field is required when none of :values are present。',
    'same'                 => ':attribute and :other must match。',
    'size'                 => [
        'numeric' => ':attribute must be :size。',
        'file'    => ':attribute must be :size kilobytes。',
        'string'  => ':attribute must be :size characters。',
        'array'   => ':attribute must contain :size items。',
    ],
    'string'               => ':attribute は文字列でなければなりません。',
    'timezone'             => ':attribute は無効なタイムゾーンです。',
    'unique'               => ':attribute はすでに使われています。',
    'uploaded'             => ':attribute failed to upload。',
    'url'                  => ':attribute の形式が無効なようです。',

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | Here you may specify custom validation messages for attributes using the
    | convention "attribute.rule" to name the lines. This makes it quick to
    | specify a specific custom language line for a given attribute rule.
    |
    */

    'custom' => [
        'attribute-name' => [
            'rule-name' => 'custom-message',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Attributes
    |--------------------------------------------------------------------------
    |
    | The following language lines are used to swap attribute place-holders
    | with something more reader friendly such as E-Mail Address instead
    | of "email". This simply helps us make messages a little cleaner.
    |
    */

    'attributes' => [],

];
