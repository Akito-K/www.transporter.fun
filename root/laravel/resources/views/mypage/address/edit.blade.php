@extends('layouts.mypage')
@section('content')

    {!! MyHTML::errorMessage($errors) !!}
    {!! MyHTML::flashMessage() !!}

    <div class="box">
        <div class="box-body">
            <h2 class="page-header">住所情報</h2>

            {!! Form::open(['url' => 'mypage/address/update']) !!}

                <div class="address__block">
                    <div class="address__boxes">
                        @if(!empty($datas))
                        @foreach($datas as $k => $data)
                        <div class="address__box">
                            <h5 class="address__box__title">住所情報 {!! $k+1 !!}</h5>
                            <div class="address__box-wrap">
                                <ul class="address__lists">
                                    <li class="address__list address__list--title">登録名</li>
                                    <li class="address__list address__list--value">
                                        {!! \Form::text('name['.$k.']', $data->name, ['class' => 'form-control']) !!}
                                    </li>
                                </ul>
                                <ul class="address__lists">
                                    <li class="address__list address__list--title">氏名</li>
                                    <li class="address__list address__list--value">
                                        {!! \Form::text('sei['.$k.']', $data->sei, ['class' => 'form-control form-control--mini form-control--40']) !!}
                                        {!! \Form::text('mei['.$k.']', $data->mei, ['class' => 'form-control form-control--mini form-control--40']) !!}
                                        <span class="address__list__ate">宛</span>
                                    </li>
                                </ul>
                                <ul class="address__lists">
                                    <li class="address__list address__list--title">郵便番号</li>
                                    <li class="address__list address__list--value">
                                        〒{!! \Form::text('zip1['.$k.']', $data->zip1, ['class' => 'form-control form-control--mini form-control--30']) !!}
                                        {!! \Form::text('zip2['.$k.']', $data->zip2, ['class' => 'form-control form-control--mini form-control--40']) !!}
                                    </li>
                                </ul>
                                <ul class="address__lists">
                                    <li class="address__list address__list--title">都道府県</li>
                                    <li class="address__list address__list--value">
                                        {!! \Form::select('pref_code['.$k.']', $pref_names, $data->pref_code, ['class' => 'form-control']) !!}
                                    </li>
                                </ul>
                                <ul class="address__lists">
                                    <li class="address__list address__list--title">市区町</li>
                                    <li class="address__list address__list--value">
                                        {!! \Form::text('city['.$k.']', $data->city, ['class' => 'form-control']) !!}
                                    </li>
                                </ul>
                                <ul class="address__lists">
                                    <li class="address__list address__list--title">以降の住所</li>
                                    <li class="address__list address__list--value">
                                        {!! \Form::textarea('address['.$k.']', $data->address, ['class' => 'form-control']) !!}
                                    </li>
                                </ul>
                            </div>
                        </div>
                        @endforeach
                        @endif
                    </div>
                </div>

                {!! Form::submit('この内容で更新する', ['class' => 'btn btn-block btn-warning btn-submit'] ) !!}
            {!! \Form::close() !!}

        </div>
    </div>

    <p><a href="{{ url('') }}/mypage/address" class="btn btn-block btn-primary">一覧へ戻る</a></p>

@endsection
