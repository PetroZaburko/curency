<?php

namespace App\Console\Commands;

use App\Rate;
use App\Services\CurrencyIterator;
use Illuminate\Console\Command;

class RateUpdateCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'rate:update';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update table rates from api sources, the same as Rate::updateDB';

    protected $iterator;

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @param CurrencyIterator $iterator
     * @return mixed
     */
    public function handle(CurrencyIterator $iterator)
    {
        Rate::updateDB($iterator) ?
            $this->info('DB was successful updated!') :
            $this->error('DB not updated!');
    }
}
