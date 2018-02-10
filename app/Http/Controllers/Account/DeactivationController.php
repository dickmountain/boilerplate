<?php

namespace App\Http\Controllers\Account;

use App\Http\Requests\Account\DeactivateAccountRequest;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DeactivationController extends Controller
{
    public function index()
    {
		return view('account.deactivate.index');
    }

    public function store(DeactivateAccountRequest $request)
    {
	    if ($request->user()->subscribed('main')) {
	    	$request->user()->subscription('main')->cancel();
	    }

		$request->user()->delete();

		return redirect('/')->withSuccess('Your account has been deactivated.');
    }

}
