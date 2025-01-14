<?php

namespace App\Models;

use App\Models\Section_room;
use App\Models\Task;
use App\Models\Role;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'password',
        'role_id',
        'section_room_id'
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
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    public function sectionRoom()
    {
        return $this->belongsTo(Section_room::class, 'section_room_id');
    }

    public function tasks()
    {
        return $this->belongsToMany(Task::class, 'task_user');
    }


    public function isAdmin(): bool
    {
        // Pretpostavljamo da postoji polje 'role' koje označava vrstu korisnika
        return $this->role_id === 1;
    }

    // Automatsko hashiranje lozinke
    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = Hash::make($value);
    }
}
