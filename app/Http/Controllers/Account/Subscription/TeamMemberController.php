<?php

namespace App\Http\Controllers\Account\Subscription;

use App\Http\Requests\Account\SubscriptionTeamMemberStoreRequest;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TeamMemberController extends Controller
{
    public function store(SubscriptionTeamMemberStoreRequest $request)
    {
		if ($this->teamLimitReached($request)) {
			return back()->withError('You have reached limit of members');
		}

		$request->user()->team->users()->syncWithoutDetaching([
			User::where('email', $request->email)->first()->id
		]);

		return back()->withSuccess('Team member added.');
    }

	public function destroy()
	{

	}

	protected function teamLimitReached($request)
	{
		return $request->user()->team->users->count() === $request->user()->plan->teams_limit;
	}
}
