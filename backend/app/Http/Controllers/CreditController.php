<?php

namespace App\Http\Controllers;

use App\Http\Resources\Credit as CreditResource;
use App\Models\User;
use Illuminate\Http\Request;

class CreditController extends Controller
{
    /**
     * @param User $user
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function byUser(User $user)
    {
        return CreditResource::collection($user->credits()->get());
    }

    /**
     * @param User $user
     * @param Request $request
     * @return CreditResource
     */
    public function store(User $user, Request $request)
    {
        $rate = $request->input('total') / 10 * 0.29;

        $credit = $user->credits()->create([
            'time' => '10',
            'rate' => $request->input('total') / 10 + $rate,
            'monthly_payment' => '2.9',
            'status' => 'В черзі',
            'total' => $request->input('total'),
        ]);

        $credit->confirmation()->create();

        return new CreditResource($credit);
    }
}
