<?php

namespace App\Http\Requests\TwoFactor;

use App\Rules\ValidTwoFactorToken;
use App\TwoFactor\TwoFactor;
use Illuminate\Foundation\Http\FormRequest;

class TwoFactorVerifyRequest extends FormRequest
{
	protected $twoFactor;

	public function __construct(TwoFactor $twoFactor)
	{
		$this->twoFactor = $twoFactor;
	}

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'token' => [
            	'required', new ValidTwoFactorToken($this->user(), $this->twoFactor)
            ]
        ];
    }
}
