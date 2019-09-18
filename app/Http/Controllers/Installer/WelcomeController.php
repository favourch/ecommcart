<?php

namespace App\Http\Controllers\Installer;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Artisan;

class WelcomeController extends Controller
{

    /**
     * Display the installer welcome page.
     *
     * @return \Illuminate\Http\Response
     */
    public function welcome()
    {
        // Generate Symlink
        Artisan::call('storage:link');

        return view('installer.welcome');
    }

}
