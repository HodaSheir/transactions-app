<?php

namespace App\Helpers;

use App\Enums\TransactionStatus;
use Carbon\Carbon;

class Helpers
{
  public static function calculateTransactionStatus($transaction){
    $currentDate = Carbon::now();
    $dueDate = Carbon::parse($transaction->due_on);

    if ($currentDate->gt($dueDate)) {
        if ($transaction->payments->sum('amount') >= $transaction->amount) {
            return TransactionStatus::PAID;
        }
        return TransactionStatus::OVERDUE;
    }

    if ($transaction->payments->sum('amount') >= $transaction->amount) {
        return TransactionStatus::PAID;
    }
    
    return TransactionStatus::OUTSTANDING;
  }
 
}
