<?php namespace App\Traits;

use Uuid;

trait Uuidable
{
    public static function bootUuidable()
    {
        static::creating(function ($object) {
            do {
                $uuid = Uuid::generate();
            } while (static::where('id', $uuid)->count() > 0);

            $object->id = $uuid;
        });
    }
}
