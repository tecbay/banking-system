<?php

namespace App\Models;

use App\Enums\TransactionType;
use App\Events\TransactionOccurred;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'amount',
        'transaction_type',
        'fee',
        'date',
    ];

    protected $casts = [
        'transaction_type' => TransactionType::class,
    ];

    protected $dispatchesEvents = [
        'created' => TransactionOccurred::class,
    ];

    public function scopeDeposits(Builder $builder)
    {
        $builder->where('transaction_type', TransactionType::Deposit);
    }

    public function scopeWithdrawal(Builder $builder)
    {
        $builder->where('transaction_type', TransactionType::Withdrawal);
    }

    public function scopeCurrentMonth(Builder $builder)
    {
        $builder->whereDate('date', '>=', today()->firstOfMonth())
            ->whereDate('date', '<=', today()->endOfMonth());
    }
}
