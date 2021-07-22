<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable {

    use HasFactory, Notifiable;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    
    protected $table = 'users';

    protected $fillable = [
        'email',
        'password',
        'phone',
    ];

    protected $hidden = [
        'type',
        'password',
        'remember_token',
        'student_id',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    /**
     * Add a mutator to ensure hashed passwords
     */
    public function setPasswordAttribute($password)
    {
        $this->attributes['password'] = bcrypt($password);
    }

    /**
     * Get the student record associated with the user.
     */

    public function student() {
        
        return $this->hasMany('App\Models\Student');
    }
}
