<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use App\Http\Resources\User as UserResource;

class UserController extends Controller
{
    /**
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     */
    public function index() {
        $user = User::whereHas('roles', function (Builder $query) {
           $query->where('title', 'User');
        })->get();

        return UserResource::collection($user);
    }

    /**
     * @param User $user
     * @return mixed
     */
    public function show(User $user)
    {
        return new UserResource($user);
    }
}
