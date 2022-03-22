<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{

    public function edit(User $user)
    {
        $this->authorize('view', $user);

        return view('profile.edit', compact('user'));
    }

    public function update(Request $request, User $user)
    {
        $this->authorize('update', $user);

        $data = $request->validate([
            'name' => 'required|string',
            'email' => 'required|email|unique:users,email,' . auth()->id(),
            'password' => 'nullable|min:8|confirmed'
        ]);

        $user->update([
            'name' => $data['name'],
            'email' => $data['email'],
        ]);

        if($request->password)
        {
            $user->update([
                'password' => Hash::make($data['password']),
            ]);
        }

        return back()->with('success', 'Profile Updated');
    }


}
