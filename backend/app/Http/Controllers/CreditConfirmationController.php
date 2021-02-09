<?php

namespace App\Http\Controllers;

use App\Http\Resources\Credit as CreditResource;
use App\Models\Credit;
use App\Models\User;

class CreditConfirmationController extends Controller
{
    public function byUser(User $user)
    {
        return CreditResource::collection($user->credits()->with(['confirmation'])->get());
    }

    public function confirm(User $user, Credit $credit)
    {
        $credit->status = 'Успiшно';
        $credit->save();
        $confirmation = $credit->confirmation()->first();
        $confirmation->is_confirmation = true;
        $confirmation->save();

        return response()->json([]);
    }
}
