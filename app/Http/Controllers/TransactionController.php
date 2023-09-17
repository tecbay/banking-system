<?php

namespace App\Http\Controllers;

use Inertia\Inertia;

class TransactionController extends Controller
{
    public function __invoke()
    {
        return Inertia::render('Transactions', [
            'transactions' => auth()->user()->transactions,
            'balance'      => auth()->user()->balance,
        ]);
    }
}
