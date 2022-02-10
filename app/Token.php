<?php

namespace App;

use Illuminate\Support\Str;
use Laravel\Sanctum\PersonalAccessToken;

class Token extends PersonalAccessToken
{
    protected $connection = 'mysql';
    protected $table = 'personal_access_tokens';

    public function tariff()
    {
        return $this->belongsTo(Tariff::class);
    }

    public function getCreatedAttribute()
    {
        return $this->created_at->format('d-m-Y');
    }

    public function getLastUsedAttribute()
    {
        return $this->last_used_at ? $this->last_used_at->format('d-m-Y') : '---';
    }

    public function isTokenAllowed()
    {
        return $this->usage < $this->tariff->requests;
    }

    public function increaseTokenUsage()
    {
        $this->usage += 1;
        $this->save();
    }

    public function resetTokenUsage()
    {
        $this->usage = 0;
        $this->save();
    }

    public function regenerateCurrentToken()
    {
        $this->token = hash('sha256', $plainTextToken = Str::random(40));
        $this->save();
        return $plainTextToken;
    }
}
