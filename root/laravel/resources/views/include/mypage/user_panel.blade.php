
<div class="user-panel">
    <div class="pull-left image account-icon account-icon--01" style="background-image: url({!! \Func::myIcon() !!});"></div>
    <div class="pull-left info">
        <p>{!! \Auth::user()->sei.\Auth::user()->mei !!}さん</p>
        <!-- Status -->
        <a href="{{ url('') }}/mypage/account"><i class="fa fa-circle text-success"></i> Online</a>
    </div>
</div>
