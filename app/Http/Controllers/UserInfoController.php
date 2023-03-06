<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\UserInfo;
use Illuminate\Http\Request;

class UserInfoController extends Controller
{
    public function update()
    {
        request()->validate([
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:50000',
            'email' => 'required|email',
            'bio' => 'nullable',
            'name' => 'required'
        ]);
        $userId = auth()->user()->id;
        $user = User::find($userId);
        $imageName = null;
        if (request('image')) {
            $imageName = $userId . '.' . request('image')->extension();
            request('image')->storeAs(
                'avatars',
                $imageName,
                'public'
            );
        }

        if ($user->info === null) {
            $user->info()->save(new UserInfo(['image' => $imageName ?? 'default.png', 'bio' => request('bio') ?? '']));
        } else {
            $user->info->update(['image' => $imageName ?? 'default.png', 'bio' => request('bio') ?? '']);
        }

        $user->update(['name' => request('name'), 'email' => request('email')]);
        return back()->with('infoUpdated', true);
    }
}
