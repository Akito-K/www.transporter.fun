<?php

namespace App\Http\Controllers\common;
use App\Http\Controllers\Controller;
use App\Http\Requests\MyContactRequest as MyRequest;

use Illuminate\Http\Request;
use App\Model\Pagemeta;
use App\Model\Contact;

use App\Mail\MailContact;
use Illuminate\Support\Facades\Mail;
use App\Http\Requests\SignupEmailRequest;

class contactController extends Controller
{
    public function create(){
        //Log::saveData( __METHOD__ , 'estimate_id', $estimate_id, true);
        $pagemeta = Pagemeta::getPagemeta('CM-CT-020');
        $type_names = Contact::getTypeNames();
        $subject_names_ary = Contact::getSubjectNamesAry();

        return view('common.contact.create', compact('pagemeta', 'type_names', 'subject_names_ary'));
    }

    public function confirm( MyRequest $request ){
//        $estimate_id = $request['estimate_id'];
        //Log::saveData( __METHOD__ , 'estimate_id', $estimate_id, true );
        $pagemeta = Pagemeta::getPagemeta('CM-CT-030');
        $contacts = Contact::$contacts;
        $request->flash();

        return view('common.contact.confirm', compact('pagemeta', 'contacts'));
    }

    public function execute( Request $request ){
        //Log::saveData( __METHOD__ , 'estimate_id', $estimate_id, true );

        $request_data = $request->all();
        Contact::saveData( $request_data );

        // メール送信
        Mail::to( $request_data['email'] )
            ->send(new MailContact($request_data));

        return redirect('contact/complete');
    }

    public function complete() {
        //Log::saveData( __METHOD__ , 'estimate_id', $estimate_id, true);
        $pagemeta = Pagemeta::getPagemeta('CM-CT-040');

        return view('common.contact.complete', compact('pagemeta'));
    }

}
