<?php namespace App\Models;

use App\Models\Model;
use App\Traits\Uuidable;

class Event extends Model
{
    use Uuidable;

    public function user()
    {
        return $this->belongsTo(\App\Models\User::class);
    }
}
