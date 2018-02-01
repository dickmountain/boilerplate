<?php

namespace App\Http\Controllers\Subscription;

use App\Http\Requests\Subscription\SubscriptionStoreRequest;
use App\Models\Plan;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SubscriptionController extends Controller
{
    public function index()
    {
    	$plans = Plan::active()->get();

    	return view('subscription.index', compact('plans'));
    }

	public function store(SubscriptionStoreRequest $request)
	{
		$request->user()->newSubscription('main', $request->plan)->create($request->token);

		return redirect('/')->withSuccess('Thank you for becoming a subscriber.');
	}
}
