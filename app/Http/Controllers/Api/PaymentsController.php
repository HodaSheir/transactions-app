<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\PaymentRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Enums\UserTypes;
use App\Models\Payment;
use App\Models\Transaction;
use App\Helpers\Helpers;

class PaymentsController extends Controller
{
    public function store(PaymentRequest $request){
        $data = $request->validated();
        $user = Auth::user();
        if($user['user_type'] == UserTypes::ADMIN){ 
            // only admin can add payment
            $data['added_by'] = Auth::id();
            Payment::create($data);
            $transaction = Transaction::find($data['transaction_id']);
            if ($transaction) {
                // Update transaction status based on payments
                $status = Helpers::calculateTransactionStatus($transaction);
                $transaction->update(['status' => $status]);
                
                return $this->successResponse(__('Payment added successfully. Transaction status updated.'), __('Payment added successfully. Transaction status updated.'), 200);
            }
            
            return $this->errorResponse([__('Transaction not found')], __('Transaction not found'), 404);

        }
        return $this->errorResponse([__('only admin can add payment')], __('only admin can add payment'), 401);
    }
}
