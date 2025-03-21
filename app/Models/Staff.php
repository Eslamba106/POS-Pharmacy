<?php

namespace App\Models;

use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Facades\Log;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Staff extends Authenticatable
{

    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $table = 'staffs';
    protected $fillable = [
        'name',
        'email',
        'role_id',
        'role_name',
        'user_name',
        'phone',
        'password',
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
    private $permissions;

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    public function hasPermission($section_name)
    {
        
        if (!isset($this->permissions)) {
            $sections_id = Permission::where('role_id', '=', $this->role_id)->where('allow', true)->pluck('section_id')->toArray();
           
            $this->permissions = Section::whereIn('id', $sections_id)->pluck('name')->toArray(); 
        }
        // Log::info($this->permissions);
        return in_array($section_name, $this->permissions , true);
    }
    // public function role()
    // {
    //     return $this->belongsTo(Role::class);
    // }

    // public function permissions()
    // {
    //     return $this->role->permissions();
    // }
    // public function getPermissions()
    // {
    //     return $this->role ? $this->role->permissions()->pluck('name')->toArray() : [];
    // }
}
