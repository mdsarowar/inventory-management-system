<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class RemoveFiles extends Command
{
    protected $signature = 'files:remove {path}';
    protected $description = 'Remove files or directories from the Laravel project';

    public function __construct()
    {
        parent::__construct();
    }
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
//    protected $signature = 'app:remove-files';

    /**
     * The console command description.
     *
     * @var string
     */
//    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $path = $this->argument('path');
        $fullPath = base_path($path);

        if (File::exists($fullPath)) {
            if (File::isDirectory($fullPath)) {
                File::deleteDirectory($fullPath);
                $this->info("Directory removed: $fullPath");
            } else {
                File::delete($fullPath);
                $this->info("File removed: $fullPath");
            }
        } else {
            $this->error("The path does not exist: $fullPath");
        }
    }

}
