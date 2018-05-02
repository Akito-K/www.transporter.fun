<?php

namespace App\Http\Controllers\common;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use App\Model\Pagemeta;
use App\Model\Signup;
use App\Model\MyUser;
use App\Model\Address;
use App\Model\UserToAddress;
use App\Model\Log;
use App\Model\Pref;
use App\Model\Carrier;
use App\Model\Owner;

use App\Mail\MailSignup;
use Illuminate\Support\Facades\Mail;
use App\Http\Requests\SignupEmailRequest;

class epsilonController extends Controller
{
    public function entry (Request $request){

    }

    public function error (Request $request){

    }

    public function result (Request $request){

    }

}
