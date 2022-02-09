<?php

namespace App;

use Laravel\Sanctum\PersonalAccessToken;

class Token extends PersonalAccessToken
{
    protected $connection = 'mysql';
    protected $table = 'personal_access_tokens';

    public function tariff()
    {
        return $this->belongsTo(Tariff::class);
    }

    public function createdFormat()
    {
        return $this->created_at->format('d-m-Y');
    }

    public function lastUsedFormat()
    {
        return $this->last_used_at ? $this->last_used_at->format('d-m-Y') : '---';
    }
}
