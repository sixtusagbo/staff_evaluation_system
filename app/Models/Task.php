<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;


    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'description',
        'started_on',
        'deadline',
        'points',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'started_on' => 'datetime',
        'deadline' => 'datetime',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = [
        'status', //? 0 - Upcoming, 1- Ongoing, 2 - Elapsed
    ];

    /**
     * The tasks that belong to the user.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function users()
    {
        return $this->belongsToMany(User::class);
    }

    /**
     * Return the task status.
     */
    public function getStatusAttribute()
    {
        if ($this->deadline->isPast()) {
            return 2;
        } else if ($this->started_on->isPast() && $this->deadline->isFuture()) {
            return 1;
        } else if ($this->started_on->isFuture()) {
            return 0;
        }
    }
}
