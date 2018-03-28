@extends('layouts.admin')
@section('content')

    <div class="box">
        <div class="box-body">
            <h2 class="page-header">利用者一覧</h2>

            @if( !empty($datas))
            <div class="customer__boxes">
                @foreach($datas as $data)
                <a href="{{ url('') }}/admin/board/{!! $data->hashed_id !!}" class="customer__box customer__box--board">
                    {!! \MyHTML::unread($data->unread) !!}
                    <ul class="customer__box__lists">
                        <li class="customer__box__list customer__box__list--img"><span class="customer__box__list__img" style="background-image: url({!! \Func::getImage($data->icon_filepath) !!});"></span></li>
                        <li class="customer__box__list customer__box__list--info">
                            <p class="customer__box__list__name">{!! $data->sei !!} {!! $data->mei !!}<span class="customer__box__list__name__san"> さん</span></p>
                            <p class="customer__box__list__age">{!! \Func::getAge($data->birth_at) !!}歳（{!! \Func::dateFormat( new \Datetime($data->birth_at), 'Y/n/j') !!} 生）</p>
                            <p class="customer__box__list__facility">{!! $facility_names[$data->facility_id] !!}</p>
                        </li>
                    </ul>
                </a>
                @endforeach
            </div>
            @endif

        </div>
    </div>

@endsection
