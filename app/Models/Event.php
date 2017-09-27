<?php namespace App\Models;

use App\Models\Model;
use App\Traits\Uuidable;
use App\Traits\Userable;

class Event extends Model
{
    use Uuidable, Userable;

    protected $fillable = [
        'title',
        'location',
        'location_geo',
        'description',
        'starts_at',
        'duration',
        'guests_limit',
        'registration_ends_at',
        'is_private'
    ];

    public function user()
    {
        return $this->belongsTo(\App\Models\User::class);
    }

    public function guests()
    {
        return $this->belongsToMany(\App\Models\User::class, 'event_guests', 'event_id', 'user_id');
    }

    public function invitations()
    {
        return $this->belongsToMany(\App\Models\User::class, 'event_invitations', 'event_id', 'user_id');
    }
}
