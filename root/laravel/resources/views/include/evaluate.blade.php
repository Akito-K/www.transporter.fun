<div class="evaluates-wrap trigEvaluate">
    <div class="evaluates">
        <div class="evaluate @if($editable) evaluate--editable @endif">
            <ul class="evaluate__lists" data-id="{{ $item_id }}">
                <li class="evaluate__list @if($editable) trigEvaluateStar @endif" data-num="0">★</li>
                <li class="evaluate__list @if($editable) trigEvaluateStar @endif" data-num="1">★</li>
                <li class="evaluate__list @if($editable) trigEvaluateStar @endif" data-num="2">★</li>
                <li class="evaluate__list @if($editable) trigEvaluateStar @endif" data-num="3">★</li>
                <li class="evaluate__list @if($editable) trigEvaluateStar @endif" data-num="4">★</li>
            </ul>
        </div>
        <div class="evaluate @if($editable) evaluate--editable @endif evaluate--after bulletEvaluateStar bulletEvaluate" data-id="{{ $item_id }}" id="bulletEvaluateStar-{{ $item_id }}">
            <ul class="evaluate__lists" data-id="{{ $item_id }}">
                <li class="evaluate__list @if($editable) trigEvaluateStar @endif" data-num="0">★</li>
                <li class="evaluate__list @if($editable) trigEvaluateStar @endif" data-num="1">★</li>
                <li class="evaluate__list @if($editable) trigEvaluateStar @endif" data-num="2">★</li>
                <li class="evaluate__list @if($editable) trigEvaluateStar @endif" data-num="3">★</li>
                <li class="evaluate__list @if($editable) trigEvaluateStar @endif" data-num="4">★</li>
            </ul>
        </div>
    </div>

    @if($editable)
    {!! \Form::text('evaluates['.$item_id.']', old('evaluates.'.$item_id)?: '5.0', ['id' => 'bulletEvaluateStarValue-'.$item_id, 'class' => 'form-control']) !!}
    <div class="evaluates--val paramEvaluateStar paramEvaluate evaluates--val--hide" data-id="{{ $item_id }}">({{ $star }})</div>
    @else
    {!! \Form::hidden('evaluates['.$item_id.']', old('evaluates.'.$item_id)) !!}
    <div class="evaluates--val paramEvaluateStar paramEvaluate" data-id="{{ $item_id }}">({{ $star }})</div>
    @endif
</div>
