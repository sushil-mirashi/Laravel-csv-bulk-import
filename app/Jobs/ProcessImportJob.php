<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Jobs\ProductsImport\ProcessProductImportJob;
use Illuminate\Support\Facades\Storage;

class ProcessImportJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    public $timeout = 1200;
    public $filePath = null;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(string $filePath)
    {
        $this->filePath = $filePath;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $file = fopen(storage_path($this->filePath), 'r');
        $count = 0;
        $dataStore = [];
        while ($row = fgetcsv($file)) {
            $dataStore[] = ['id' => $row[0], 'name' => $row[1]];
        }

        $chunks = array_chunk($dataStore, 1);
        foreach ($chunks as $key => $value) {
           ProcessProductImportJob::dispatch($value);
        }
    }
}
