<?php

namespace App\Http\Controllers;

use App\Http\Resources\Card;
use App\Models\User;

class CardController extends Controller
{
    /**
     * @param User $user
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function byUser(User $user)
    {
        return Card::collection($user->cards()->get());
    }
}
