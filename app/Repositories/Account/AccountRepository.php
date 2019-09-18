<?php

namespace App\Repositories\Account;

use Illuminate\Http\Request;

interface AccountRepository
{
    public function profile();

    public function updateProfile(Request $request);

    public function updatePhoto(Request $request);

    public function deletePhoto(Request $request);

    public function updatePassword(Request $request);
}