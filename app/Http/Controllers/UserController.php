<?php

namespace App\Http\Controllers;

use App\Http\Requests\User\UserUpdateRequest;
use App\Models\User;

class UserController extends Controller
{
    public function edit(User $user)
    {
        return View('user.user.edit', compact('user'));
    }

    public function update(UserUpdateRequest $request, User $user)
    {
        $data = $request->validated();

        if (empty($data['password'])) {
            unset($data['password']);
        }

        $user->update($data);

        return redirect()
            ->route('users.edit', $user->id)
            ->with('success', 'Profile updated successfully.');
    }
}
