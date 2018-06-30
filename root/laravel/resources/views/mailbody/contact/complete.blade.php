<div class="box">
    <div class="box-body">
        <h2 class="page-header">お問い合わせをありがとうございました。</h2>
        <p>完了の確認メールを、ご入力頂いたメールアドレス宛に送信しています。<br />
            いただいた内容に関しましては、後日ご回答させていただきますのでお待ちくださいませ。</p>

        <h3 class="page-header">ご入力内容</h2>

        <p class="conf_text">{{ $contacts[ $request_data['type_id'] ]['type'] }}</p>
        <p class="conf_text">{{ $contacts[ $request_data['type_id'] ]['subjects'][ $request_data['subject_id'] ] }}</p>
        <p class="conf_text">{{ $request_data['company'] }}</p>
        <p class="conf_text">{{ $request_data['section'] }}</p>
        <p class="conf_text">{{ $request_data['sei'] }} {{ $request_data['mei'] }} 様</p>
        <p class="conf_text">{{ $request_data['email'] }}</p>
        <p class="conf_text">{{ $request_data['tel'] }}</p>
        <p class="conf_text">{!! \Func::N2BR( $request_data['body'] ) !!}</p>

    </div>
</div>

