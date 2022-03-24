<?php

namespace App\Console\Commands;

use App\Rate;
use App\RateEnterprise;
use Illuminate\Console\Command;

class RateUpdateFromTableCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'rate:update-from-table {table}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update table rates from other table source';

    /**
     * Execute the console command.
     *
     * @param Rate $rate
     * @param RateEnterprise $source
     * @return mixed
     */
    public function handle(Rate $rate, RateEnterprise $source)
    {
        $rate->updateDB($source) ?
            $this->info('DB was successful updated!') :
            $this->error('DB not updated!');
    }
}
