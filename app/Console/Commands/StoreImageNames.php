<?php

namespace App\Console\Commands;

use App\Models\AdultTeeth;
use App\Models\ChildTeeth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Console\Command;

class StoreImageNames extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:store-image';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Store image in the database using artisan command';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $folderPath = storage_path('app/public/child');
        $files = Storage::files('public/child');
        foreach ($files as $file) {
            $fileName = basename($file);
            $teethNumber = pathinfo($fileName, PATHINFO_FILENAME); 
            ChildTeeth::create([
                'teeth_url'    => $fileName,
                'teeth_number' => $teethNumber
            ]);

            $this->info("Stored: " . $fileName . " with teeth number: " . $teethNumber);
        }

        $this->info('Image names and teeth numbers stored successfully.');
    }
}
