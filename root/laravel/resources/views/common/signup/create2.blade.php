@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">無料会員登録</div>

                <div class="panel-body">
                    <form class="form-horizontal" method="POST" action="{{ url('') }}/signup/complete">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('zip_code') ? ' has-error' : '' }}">
                            <label for="zip_code" class="col-md-4 control-label">郵便番号</label>

                            <div class="col-md-6">
                                <input id="zip_code" type="text" class="form-control" name="zip_code" value="{{ old('zip_code') }}" required autofocus>

                                @if ($errors->has('zip_code'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('zip_code') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('pref_code') ? ' has-error' : '' }}">
                            <label for="pref_code" class="col-md-4 control-label">都道府県</label>

                            <div class="col-md-6">
                                <input id="pref_code" type="text" class="form-control" name="pref_code" value="{{ old('pref_code') }}" required autofocus>

                                @if ($errors->has('pref_code'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('pref_code') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('city') ? ' has-error' : '' }}">
                            <label for="city" class="col-md-4 control-label">市区郡</label>

                            <div class="col-md-6">
                                <input id="city" type="text" class="form-control" name="city" value="{{ old('city') }}" required autofocus>

                                @if ($errors->has('city'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('city') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('address') ? ' has-error' : '' }}">
                            <label for="address" class="col-md-4 control-label">以降の住所</label>

                            <div class="col-md-6">
                                <input id="address" type="text" class="form-control" name="address" value="{{ old('address') }}" required autofocus>

                                @if ($errors->has('address'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('address') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('sei') ? ' has-error' : '' }}">
                            <label for="sei" class="col-md-4 control-label">姓</label>

                            <div class="col-md-6">
                                <input id="sei" type="text" class="form-control" name="sei" value="{{ old('sei') }}" required autofocus>

                                @if ($errors->has('sei'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('sei') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('mei') ? ' has-error' : '' }}">
                            <label for="mei" class="col-md-4 control-label">名</label>

                            <div class="col-md-6">
                                <input id="mei" type="text" class="form-control" name="mei" value="{{ old('mei') }}" required autofocus>

                                @if ($errors->has('mei'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('mei') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <input type="hidden" name="hashed_id" value="{{ $hashed_id }}">

                        <div class="form-group">
                            <div class="col-md-8 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    トランスポーターの利用を開始する
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
