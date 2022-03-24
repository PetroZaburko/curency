<?php

namespace App\Console\Commands;

use App\Rate;
use App\Services\CurrencyIterator;
use Illuminate\Console\Command;

class RateUpdateFromAPICommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'rate:update-from-API {table}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update table rates from api sources';

    /**
     * Execute the console command.
     *
     * @param Rate $rate
     * @param CurrencyIterator $iterator
     * @return mixed
     */
    public function handle(Rate $rate, CurrencyIterator $iterator)
    {
        $rate->updateDB($iterator) ?
            $this->info('DB was successful updated!') :
            $this->error('DB not updated!');
    }
}
