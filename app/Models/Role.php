<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    
    use HasFactory;

    static $admin = 'admin';
    static $staffs = 'staffs';
    static $user = 'user';


    protected $guarded = ['id'];

    public function canDelete()
    {
        switch ($this->name) {
            case self::$admin:
            case self::$user:
            case self::$staffs:
            // case self::$organization:
            // case self::$teacher:
                return false;
                // break;
            default:
                return true;
        }
    }

    public function users()
    {
        return $this->hasMany(User::class, 'role_id', 'id');
    }

    public function staffs()
    {
        return $this->hasMany(Staff::class, 'role_id', 'id');
    }

    public function isDefaultRole()
    {
        return in_array($this->name, [self::$admin, self::$user , self::$staffs]);
    }
    public function permissions()
    {
        return $this->hasMany(Permission::class);
    }
    public function sections()
    {
        return $this->hasMany(Section::class);
    }
    public function isMainAdminRole()
    {
        return $this->name == self::$admin;
    }


   
}
