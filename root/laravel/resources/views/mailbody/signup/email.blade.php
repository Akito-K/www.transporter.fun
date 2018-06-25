    <div class="box">
        <div class="box-body">
            <h2 class="page-header">入力されたメールアドレス宛てに登録用メールを送りました。</h2>
            <p>これより {!! env('AUTHORIZATION_LIMIT_HOURS', 24) !!} 時間以内に認証</p>
            <p>URLはメールに載ってる</p>
            <p>URLが途切れてるときはコピペしてね</p>
            <p><a href="http://www.transporter.fun/signup/{{ $key }}/create">こちら</a></p>
        </div>
    </div>

