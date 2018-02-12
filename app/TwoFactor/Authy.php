<?php

namespace App\TwoFactor;

use App\Models\User;
use App\TwoFactor\TwoFactor;

use Exception;
use GuzzleHttp\Client;

class Authy implements TwoFactor
{
	protected $client;

	public function __construct(Client $client)
	{
		$this->client = $client;
	}

	public function register(User $user)
	{
		try {
			$response = $this->client->request(
				'POST', 'http://api.authy.com/protected/json/users/new?api_key='.config('services.authy.secret'), [
					'form_params' => [
						'user' => $this->getTwoFactorRegDetails($user)
					]
				]
			);
		} catch (Exception $e) {
			return false;
		}

		return json_decode($response->getBody());
	}

	public function validateToken(User $user, $token)
	{

	}

	public function delete(User $user)
	{

	}

	protected function getTwoFactorRegDetails(User $user)
	{
		return [
			'email' => $user->email,
			'cellphone' => $user->twoFactor->phone,
			'country_code' => $user->twoFactor->dial_code
		];
	}

}