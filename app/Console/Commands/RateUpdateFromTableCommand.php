<?php

namespace App\Console\Commands;

use App\RateEnterprise;
use App\Traits\RateUpdateCommandTrait;
use Illuminate\Console\Command;

class RateUpdateFromTableCommand extends Command
{
    use RateUpdateCommandTrait;

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
     * List of available models to update on this command
     *
     * @var array
     */
    protected $availableClasses = [
        \App\RateFree::class,
        \App\RateStarter::class
    ];

    /**
     * Execute the console command.
     *
     * @param RateEnterprise $rate
     * @return mixed
     */
    public function handle(RateEnterprise $rate)
    {
        $this->makeInstance();
        $this->instance->updateDB($rate) ?
            $this->info('DB was successful updated!') :
            $this->error('DB not updated!');
    }
}
