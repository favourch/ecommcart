<?php

namespace App\Http\Controllers\Installer;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Routing\Controller;
// use App\Http\Controllers\Installer\Helpers\DatabaseManager;

class ActivateController extends Controller
{
    /**
     * @var DatabaseManager
     */
    // private $databaseManager;

    /**
     * @param DatabaseManager $databaseManager
     */
    // public function __construct(DatabaseManager $databaseManager)
    // {
    //     $this->databaseManager = $databaseManager;
    // }

    /**
     * Migrate and seed the database.
     *
     * @return \Illuminate\View\View
     */
    public function activate()
    {
        if ( ! $this->checkDatabaseConnection() ) {
            return redirect()->back()->withErrors([
                'database_connection' => trans('installer_messages.environment.wizard.form.db_connection_failed'),
            ]);
        }

        return view('installer.activate');
    }

    public function verify(Request $request)
    {
        $mysqli_connection = getMysqliConnection();

        if ( ! $mysqli_connection )
            return redirect()->route('Installer.activate')->with(['failed' => trans('responses.database_connection_failed')])->withInput($request->all());

        $purchase_verification = aplVerifyEnvatoPurchase($request->purchase_code);
        if (!empty($purchase_verification)) //protected script can't connect to your licensing server
            return redirect()->route('Installer.activate')->with(['failed' => 'Connection to remote server can\'t be established'])->withInput($request->all());

        $license_notifications_array = incevioVerify($request->root_url, $request->email_address, $request->purchase_code, $mysqli_connection);

        if ($license_notifications_array['notification_case'] == "notification_license_ok")
            return view('installer.install', compact('license_notifications_array'));

        if ($license_notifications_array['notification_case'] == "notification_already_installed") {
            $license_notifications_array = incevioAutoloadHelpers($mysqli_connection, 1);

            if ($license_notifications_array['notification_case'] == "notification_license_ok")
                return view('installer.install', compact('license_notifications_array'));
        }

        return redirect()->route('Installer.activate')->with(['failed' => $license_notifications_array['notification_text']])->withInput($request->all());
    }

    /**
     * Validate database connection with user credentials (Form Wizard).
     *
     * @return boolean
     */
    private function checkDatabaseConnection()
    {
        try {
            DB::connection()->getPdo();
            return true;
        } catch (Exception $e) {
            return false;
        }
    }

    /**
     * Return a formatted error messages.
     *
     * @param $message
     * @param string $status
     * @return array
     */
    private function response($message, $status = 'danger')
    {
        return [
            'status' => $status,
            'message' => $message,
        ];
    }
}
