<?php

namespace App\Http\Requests;

use App\Actions\CalculateWithdrawalFeeAction;
use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;

class WithdrawalRequest extends FormRequest
{
    public readonly float $fee;

    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        /** @var User $user */
        $user = User::query()->findOrFail($this->user_id);

        $this->fee = (new CalculateWithdrawalFeeAction($user, $this->amount))->execute();

        return $user->balance > ($this->amount + $this->fee);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'user_id' => ['required', 'exists:users,id'],
            'amount'  => ['required', 'numeric'],
        ];
    }

}
