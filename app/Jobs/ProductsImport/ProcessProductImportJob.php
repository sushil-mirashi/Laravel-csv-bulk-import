<?php

namespace App\Jobs\ProductsImport;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class ProcessProductImportJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    public $rowData = [];
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(array $rowData)
    {
        $this->rowData = $rowData;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        //will upsert data here
        echo "<pre> upsert === \n";print_r($this->rowData);
    }
}
