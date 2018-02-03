<?php

namespace App\Http\Controllers\Account\Subscription;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CardController extends Controller
{
	public function index()
	{
		return view('account.subscription.card.index');
	}
}
