<?php

namespace App\Console\Commands;
use App\Models\AdultTeeth;
use App\Models\AdultTeethDisease;
use App\Models\ChildDisease;
use App\Models\ChildTeeth;
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
        $files = Storage::files('public/child_root');

        foreach ($files as $file) {
            $fileName = basename($file);
            $teethNumber = explode("-",$fileName);
            $teeth = ChildTeeth::where('teeth_number',$teethNumber[0])->first();
            ChildDisease::create([
                'teeth_number' => $teeth->id,  
                'disease_img_url' => $fileName,  
                'disease_name' => 'Root Fragment'
            ]);
        }
        $this->info('Disease names stored successfully.');
    }

}
