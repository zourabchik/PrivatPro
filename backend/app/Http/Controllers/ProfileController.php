<?php

namespace App\Http\Controllers;

use App\Http\Requests\Profile\Update;
use App\Models\User;
use \App\Http\Resources\User as UserResource;

class ProfileController extends Controller
{
    /**
     * @param Update $request
     * @return \App\Http\Resources\User
     */
    public function update(Update $request)
    {
        $user = User::findOrFail($request->input('userId'));
        $user->update([
            'first_name' => $request->input('firstName'),
            'last_name' => $request->input('lastName'),
            'middle_name' => $request->input('middleName'),
            'phone' => $request->input('phone'),
            'email' => $request->input('email')
        ]);

        return new UserResource($user);
    }
}
