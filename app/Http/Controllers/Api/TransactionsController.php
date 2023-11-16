<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\TransactionsRequest;
use Illuminate\Support\Facades\Auth;
use App\Enums\UserTypes;
use App\Models\Transaction;
use Illuminate\Http\Request;
use App\Helpers\Helpers;
use App\Http\Resources\Api\TransactionResource;


class TransactionsController extends Controller
{
    public function index(){
        $user = Auth::user();
        if ($user['user_type'] == UserTypes::ADMIN) {
            $transactions = Transaction::with(['addedBy', 'customer','payments'])->get();
        } else {
            $transactions = Transaction::with(['addedBy', 'customer' ,'payments'])->where('customer_id', $user->id)->get();
        }
    
        return $this->successResponse(TransactionResource::collection($transactions), __('available transactions'), 200);
    }
    public function store(TransactionsRequest $request){
        $data = $request->validated();
        $user = Auth::user();
        if($user['user_type'] == UserTypes::ADMIN){ 
            // only admin can add transaction
            $data['added_by'] =  $user->id;
            $transaction = Transaction::create($data);
            $status =  Helpers::calculateTransactionStatus($transaction);
            $transaction->update(['status' => $status]);
            return $this->successResponse(__('Transaction created successfully'), __('Transaction created successfully'), 200);

        }
        return $this->errorResponse([__('only admin can add transaction')], __('only admin can add transaction'), 401);
        
    }
}
