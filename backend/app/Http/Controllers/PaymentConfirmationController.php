<?php

namespace App\Http\Controllers;

use App\Http\Resources\Payment as PaymentResource;
use App\Models\Payment;
use App\Models\User;

class PaymentConfirmationController extends Controller
{
    public function byUser(User $user)
    {
        return PaymentResource::collection($user->payments()->with(['fromCard', 'toCard'])->get());
    }

    public function confirm(User $user, Payment $payment)
    {
        $payment->status = 'Успiшно';
        $payment->save();
        $confirmation = $payment->confirmation()->first();
        $confirmation->is_confirmation = true;
        $confirmation->save();

        return response()->json([]);
    }
}
