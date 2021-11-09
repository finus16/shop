<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UsersService
{
    public function create(array $data): bool
    {
        $user = new User();
        $user->name = $data['name'];
        $user->email = $data['email'];
        $user->password = Hash::make($data['password']);

        return $user->save();
    }

    public function update(User &$user, $data): bool
    {
        if (isset($data['password'])) {
            $data['password'] = Hash::make($data['password']);
        }

        $user->update($data);

        return $user->save();
    }
}
