<?php
namespace App\Http\Controllers\owner;
use App\Http\Controllers\ownerController;
use Illuminate\Http\Request;
use App\Http\Requests\MyOwnerRequest as MyRequest;

use App\Model\Owner;
use App\Model\Pref;
use App\Model\Pagemeta;
use App\Model\Log;

class accountController extends ownerController
{
    public function showDetail(){
        Log::saveData( __METHOD__ );
        $pagemeta = Pagemeta::getPagemeta('OW-AC-020');
        $owner_id = \Auth::user()->owner_id;
        $owner_data = Owner::getData($owner_id);
        $owner_data->star = view('include.star', ['star' => $owner_data->star])->render();
        $prefs = Pref::getNames();

        return view('owner.account.detail', compact('pagemeta', 'owner_data', 'prefs'));
    }

    public function editBase(){
        Log::saveData( __METHOD__ );
        $pagemeta = Pagemeta::getPagemeta('OW-AC-030');
        $owner_id = \Auth::user()->owner_id;
        $owner_data = Owner::getOwner($owner_id);
        $prefs = Pref::getNames();

        return view('owner.account.edit_base', compact('pagemeta', 'owner_data', 'prefs'));
    }

    public function updateBase( MyRequest $request ){
        $request_data = $request->all();
        $owner_id = \Auth::user()->owner_id;
        Owner::updateData($owner_id, $request_data);

        return redirect('owner/account');
    }
}
