<?php

namespace App\Http\Controllers;

use App\Models\Card;
use App\Models\Payment;
use App\Models\PaymentConfirmation;
use App\Models\User;
use App\Http\Resources\Payment as PaymentResource;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    /**
     * @param User $user
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function byUser(User $user)
    {
        return PaymentResource::collection($user->payments()->with(['fromCard', 'toCard'])->get());
    }

    /**
     * @param Request $request
     * @return mixed
     */
    public function store(Request $request)
    {
        $fromCard = Card::find($request->input('fromCardId'));
        $toCard = Card::where('number', $request->input('toCard'))->first();

        if ($fromCard->total < $request->input('total')) {
            return response()->json([
                'errors' => [
                    'total' => [
                        'Перевищення ліміту'
                    ]
                ]
            ], 422);
        }

        $payment = Payment::create([
            'from_card_id' => $fromCard->id,
            'to_card_id' => $toCard->id,
            'description' => $request->input('description'),
            'status' => 'В черзі',
            'total' => $request->input('total'),
        ]);

        if ($fromCard->id !== $toCard->id) {
            $fromCard->total = $fromCard->total - $request->input('total');
            $fromCard->save();
            $toCard->total = $toCard->total + $request->input('total');
            $toCard->save();
        }

        $payment->confirmation()->create();

        return $payment;
    }
}
