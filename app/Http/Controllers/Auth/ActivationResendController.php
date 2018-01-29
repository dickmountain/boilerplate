<?php

namespace App\Http\Controllers\Auth;

use App\Events\Auth\UserRequestedActivationEmail;
use App\Http\Requests\Auth\ActivateResendRequest;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ActivationResendController extends Controller
{
    public function index()
    {
    	return view('auth.activation.resend.index');
    }

	public function store(ActivateResendRequest $request)
	{
		$user = User::where('email', $request->email)->first();
		if (optional($user)->hasNotActivated()) {
			event(new UserRequestedActivationEmail($user));
		}else{
			return redirect()->route('login')->withError('This email could not be reactivated');
		}

		return redirect()->route('login')->withSuccess('An activation email has been sent');
	}
}
