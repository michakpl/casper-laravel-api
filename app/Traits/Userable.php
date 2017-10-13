<?php namespace App\Traits;

use Auth;

trait Userable
{
    public static function bootUserable()
    {
        static::creating(function ($object) {
            if ($object->isUnguarded() && $object->user_id) {
                $user_id = $object->user_id;
            } else {
                $object->user_id = Auth::user()->id;
            }
        });
    }
}
