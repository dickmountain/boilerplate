<?php

namespace App\Http\Controllers\Account;

use App\Http\Requests\Account\ProfileStoreRequest;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProfileController extends Controller
{
	public function index()
	{
		return view('account.profile.index');
	}

	public function store(ProfileStoreRequest $request)
	{
		$request->user()->update($request->only(['email', 'name']));

		return back();
	}
}
