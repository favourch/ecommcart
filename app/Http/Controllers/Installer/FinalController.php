<?php

namespace App\Http\Controllers\Installer;

use Illuminate\Routing\Controller;
use App\Http\Controllers\Installer\Helpers\DatabaseManager;
use App\Http\Controllers\Installer\Helpers\EnvironmentManager;
use App\Http\Controllers\Installer\Helpers\FinalInstallManager;
use App\Http\Controllers\Installer\Helpers\InstalledFileManager;

class FinalController extends Controller
{
    /**
     * Update installed file and display finished view.
     *
     * @param InstalledFileManager $fileManager
     * @return \Illuminate\View\View
     */
    public function final(FinalInstallManager $finalInstall, EnvironmentManager $environment)
    {
        $finalMessages = $finalInstall->runFinal();
        // $finalStatusMessage = $fileManager->update();
        $finalEnvFile = $environment->getEnvContent();

        return view('installer.finished', compact('finalMessages', 'finalEnvFile'));
    }

    /**
     * Seed the database.
     *
     * @return \Illuminate\View\View
     */
    public function seedDemo(DatabaseManager $databaseManager)
    {
        $response = $databaseManager->seedDemoData();

        return redirect()->route('Installer.finish');
    }

    /**
     * Update installed file and display finished view.
     *
     * @param InstalledFileManager $fileManager
     * @return \Illuminate\View\View
     */
    public function finish(InstalledFileManager $fileManager)
    {
        $finalStatusMessage = $fileManager->update();

        return redirect()->to(config('installer.redirectUrl'))->with('message', $finalStatusMessage);
    }
}
