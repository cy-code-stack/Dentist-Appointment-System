<?php

namespace App\Console\Commands;
use App\Models\AdultTeeth;
use App\Models\AdultTeethDisease;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;

class StoreDiseaseImg extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:store-disease-img';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'To Store Teeth Disease Images';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $folderPath = storage_path('app/public/adult_missing_teeth');
        $files = Storage::files('public/adult_missing_teeth');

        foreach ($files as $file) {
            $fileName = basename($file);
            $teethNumber = explode("-",$fileName);
            $teeth = AdultTeeth::where('teeth_number',$teethNumber[0])->first();
            AdultTeethDisease::create([
                'teeth_number' => $teeth->id,  
                'disease_img_url' => $fileName,  
                'disease_name' => 'Missing'
            ]);
        }
        $this->info('Disease names stored successfully.');
    }

}
