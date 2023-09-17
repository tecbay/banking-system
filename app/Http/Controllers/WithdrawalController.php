<?php

namespace App\Http\Controllers;

use App\Enums\TransactionType;
use App\Http\Requests\WithdrawalRequest;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Inertia\Inertia;

class WithdrawalController extends Controller
{
    public function index()
    {
        return Inertia::render('Withdrawal/Index', [
            'withdrawals' => auth()->user()->transactions()->withdrawal()->get(),
        ]);
    }

    public function create()
    {
        return Inertia::render('Withdrawal/Create');
    }

    public function store(WithdrawalRequest $request)
    {
        Transaction::create([
            'user_id'          => $request->user_id,
            'amount'           => $request->amount,
            'fee'              => $request->fee,
            'transaction_type' => TransactionType::Withdrawal,
            'date'             => now(),
        ]);

        return redirect()->route('withdrawals.index');
    }
}
