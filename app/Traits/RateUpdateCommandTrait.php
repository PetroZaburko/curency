<?php


namespace App\Traits;

use App\Rate;

trait RateUpdateCommandTrait
{
    /**
     * @var string
     */
    protected $prefix = Rate::class;

    /**
     * @var Rate
     */
    protected $instance;

    protected function makeInstance()
    {
        $class = $this->prefix . ucfirst($this->argument('table'));
        if (in_array($class, $this->availableClasses)) {
            $this->instance = new $class;
        } else {
            $this->error('No such table, or not available in this command !');
            exit();
        }
    }
}
