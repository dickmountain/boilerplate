<?php

namespace App\Http\Controllers\Account\Subscription;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CancelController extends Controller
{
    public function index()
    {
		return view('account.subscription.cancel.index');
    }
}
