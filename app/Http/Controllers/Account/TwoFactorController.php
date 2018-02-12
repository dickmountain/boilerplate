<?php

namespace App\Http\Controllers\Account;

use App\Http\Requests\TwoFactor\TwoFactorStoreRequest;
use App\Models\Country;
use App\TwoFactor\TwoFactor;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TwoFactorController extends Controller
{
	public function index()
	{
		$countries = Country::get();

		return view('account.twofactor.index', compact('countries'));
	}

	public function store(TwoFactorStoreRequest $request, TwoFactor $twoFactor)
	{
		$user = $request->user();

		$user->twoFactor()->create([
			'phone' => $request->phone_number,
			'dial_code' => $request->dial_code,
		]);

		if ($response = $twoFactor->register($user)) {
			$user->twoFactor()->update([
				'identifier' => $response->user->id
			]);
		}

		return back();
	}

	public function verify()
	{

	}
}
