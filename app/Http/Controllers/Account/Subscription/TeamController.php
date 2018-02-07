<?php

namespace App\Http\Controllers\Account\Subscription;

use App\Http\Requests\Account\SubscriptionTeamUpdateRequest;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TeamController extends Controller
{
	public function index()
	{
		$team = auth()->user()->team;
		return view('account.subscription.team.index', compact('team'));
	}

	public function update(SubscriptionTeamUpdateRequest $request)
	{
		$request->user()->team()->update($request->only(['name']));

		return back()->withSuccess('Team name updated');
	}
}
