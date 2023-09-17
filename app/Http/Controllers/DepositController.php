<?php

namespace App\Http\Controllers;

use App\Enums\TransactionType;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Http\Request;
use Inertia\Inertia;

class DepositController extends Controller
{
    public function index()
    {
        return Inertia::render('Deposit/Index', [
            'deposits' => auth()->user()->transactions()->deposits()->get(),
        ]);
    }

    public function create()
    {
        return Inertia::render('Deposit/Create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'user_id' => ['required', 'exists:users,id'],
            'amount'  => ['required', 'numeric'],
        ]);

        Transaction::create([
            'user_id'          => $request->user_id,
            'amount'           => $request->amount,
            'transaction_type' => TransactionType::Deposit,
            'date'             => now(),
        ]);

        return redirect()->route('deposits.index');
    }
}
