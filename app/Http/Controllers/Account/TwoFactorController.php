<?php

namespace App\Http\Controllers\Account;

use App\Models\Country;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TwoFactorController extends Controller
{
	public function index()
	{
		$countries = Country::get();

		return view('account.twofactor.index', compact('countries'));
	}

	public function store(Request $request)
	{
		dd($request);
	}
}
