<?php

namespace RachidLaasri\LaravelInstaller\Controllers;

use Illuminate\Routing\Controller;
use RachidLaasri\LaravelInstaller\Helpers\DatabaseManager;
// use RachidLaasri\LaravelInstaller\Helpers\InstalledFileManager;

class DatabaseController extends Controller
{

    /**
     * @var DatabaseManager
     */
    private $databaseManager;
    // private $fileManager;

    /**
     * @param DatabaseManager $databaseManager
     */
    public function __construct(DatabaseManager $databaseManager)
    {
        $this->databaseManager = $databaseManager;
        // $this->fileManager = $fileManager;
    }

    /**
     * Migrate and seed the database.
     *
     * @return \Illuminate\View\View
     */
    public function database()
    {
        $re = route('LaravelInstaller::final');

        $response = $this->databaseManager->migrateAndSeed();

        // $this->fileManager->update();

        // return view('vendor.installer.finished', [
        //     'message' => $response,
        // ]);

        return redirect($re);
    }
}
