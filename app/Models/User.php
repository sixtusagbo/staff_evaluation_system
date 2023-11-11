<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'type',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = [
        'checked_in_today',
        'is_admin',
    ];

    /**
     * A user has many attendances.
     */
    public function attendances()
    {
        return $this->hasMany(Attendance::class);
    }

    /**
     * A user has many leaves.
     */
    public function leaves()
    {
        return $this->hasMany(Leave::class);
    }

    /**
     * Return true/false whether user has signed attendance or not.
     */
    public function getCheckedInTodayAttribute()
    {
        return $this->attendances()->exists() ? $this->attendances->last()->checked_in_at->isToday() : false;
    }

    /**
     * Return true/false whether user is admin or not.
     */
    public function getIsAdminAttribute()
    {
        return $this->type == 1;
    }

    /**
     * A user has many tasks.
     */
    public function tasks()
    {
        return $this->belongsToMany(Task::class)->withTimestamps();
    }
}
