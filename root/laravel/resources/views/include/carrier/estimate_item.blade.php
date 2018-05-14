<?php
/**
 * $num
 * $html_options
 */
?>
<tr class="estimate__table__margin-top bulletRemoveItem" data-num="{{ $num }}">
    <td class="estimate__table__cell estimate__table__cell--quote" colspan="3">
        <select class="form-control form-control--mini form-control--60 form-control--xxsm paramQuoteItem" data-num="{{ $num }}" name="">
            {{ $html_options }}
        </select>
        <button type="button" class="btn btn-default btn-xsm trigQuoteItem" data-num="{{ $num }}">入力</button>
    </td>
    <td class="estimate__table__cell align-right" colspan="3">
        <div class="estimate__table__buttons">
            <span class="trigRemoveItem estimate__table__button estimate__table__button--remove" data-num="{{ $num }}"><i class="fa fa-minus"></i></span>
        </div>
    </td>
</tr>
<tr class="bulletRemoveItem" data-num="{{ $num }}">
    <td class="estimate__table__cell estimate__table__cell--line">
        {!! Form::text('code['.$num.']', '', ['class' => 'form-control  form-control--xsm', 'data-num' => $num, 'id' => 'code_'.$num ]) !!}
    </td>
    <td class="estimate__table__cell estimate__table__cell--line" colspan="2">
        {!! Form::text('name['.$num.']', '', ['class' => 'form-control  form-control--xsm', 'data-num' => $num, 'id' => 'name_'.$num ]) !!}
    </td>
    <td class="estimate__table__cell estimate__table__cell--line">
        {!! Form::number('amount['.$num.']', '', ['class' => 'form-control  form-control--xsm trigCalculateSubTotal paramAmount', 'data-num' => $num, 'id' => 'amount_'.$num ]) !!}
    </td>
    <td class="estimate__table__cell estimate__table__cell--line">
        {!! Form::number('count['.$num.']', '', ['class' => 'form-control  form-control--xsm trigCalculateSubTotal paramCount', 'data-num' => $num ]) !!}
    </td>
    <td class="estimate__table__cell estimate__table__cell--line">
        {!! Form::text('subtotal['.$num.']', '', ['class' => 'form-control  form-control--xsm paramSubtotal bulletSubTotal readonly', 'readonly' => 'readonly', 'data-num' => $num ]) !!}
    </td>
</tr>
<tr class="estimate__table__margin-bottom bulletRemoveItem" data-num="{{ $num }}">
    <td class="estimate__table__cell estimate__table__cell--sm-title estimate__table__cell--line align-right" colspan="3">
        特記事項
    </td>
    <td class="estimate__table__cell estimate__table__cell--notes estimate__table__cell--line" colspan="3">
        {!! Form::textarea('notes['.$num.']', '', ['class' => 'form-control form-control--xsm paramNote bulletNotes', 'data-num' => $num, 'id' => 'notes_'.$num, 'placeholder' => '' ]) !!}
    </td>
</tr>
