<?php

namespace App\Console\Commands;

use App\Services\CurrencyIterator;
use App\Traits\RateUpdateCommandTrait;
use Illuminate\Console\Command;

class RateUpdateFromAPICommand extends Command
{
    use RateUpdateCommandTrait;

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
     * List of available models to update on this command
     *
     * @var array
     */
    protected $availableClasses = [
        \App\RateEnterprise::class
    ];

    /**
     * Execute the console command.
     *
     * @param CurrencyIterator $iterator
     * @return mixed
     */
    public function handle(CurrencyIterator $iterator)
    {
        $this->makeInstance();
        $this->instance->updateDB($iterator) ?
            $this->info('DB was successful updated!') :
            $this->error('DB not updated!');
    }
}
