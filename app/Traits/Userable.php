<?php namespace App\Traits;

use Auth;

trait Userable
{
    public static function bootUserable()
    {
        static::creating(function ($object) {
            $object->user_id = Auth::user()->id;
        });
    }
}
