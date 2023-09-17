<?php


namespace App\Actions;

use App\Enums\UserType;
use App\Models\User;

final class CalculateWithdrawalFeeAction
{
    const BASE_INDIVIDUAL_RATE = 0.00015;
    const BASE_BUSINESS_RATE = 0.00025;

    public function __construct(protected User $user, protected float $amount)
    {
    }

    public function execute()
    {
        return $this->getWithdrawalFee();
    }

    private function getWithdrawalFee(): float
    {
        return match ($this->user->account_type) {
            UserType::Business => $this->getWithdrawalFeeForBusiness(),
            UserType::Individual => $this->getWithdrawalFeeForIndividual(),
        };
    }

    private function getWithdrawalFeeForIndividual(): float
    {

        if (today()->isFriday()) {
            return 0.0;
        }

        $totalCurrentMonthWithdrawal = $this->user->transactions()->withdrawal()->currentMonth()->sum('amount');

        if ($totalCurrentMonthWithdrawal < 5000) {
            return 0.0;
        }

        if ($this->amount > 1000) {
            return ($this->amount - 1000) * self::BASE_INDIVIDUAL_RATE;
        }

        return $this->amount * self::BASE_INDIVIDUAL_RATE;
    }

    private function getWithdrawalFeeForBusiness(): float
    {
        if ($this->user->transactions()->withdrawal()->sum('amount') > 50000) {
            return $this->amount * 0.00015;
        }

        return $this->amount * self::BASE_BUSINESS_RATE;
    }
}
