<?php

namespace App\Listeners;

use App\Enums\TransactionType;
use App\Events\TransactionOccurred;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class UpdateUserBalance
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(TransactionOccurred $event): void
    {
        if ($event->transaction->transaction_type === TransactionType::Deposit) {
            User::query()->findOrFail($event->transaction->user_id)->increment('balance', $event->transaction->amount);
        }

        if ($event->transaction->transaction_type === TransactionType::Withdrawal) {
            User::query()->findOrFail($event->transaction->user_id)->decrement('balance', $event->transaction->amount + $event->transaction->fee);
        }
    }
}
