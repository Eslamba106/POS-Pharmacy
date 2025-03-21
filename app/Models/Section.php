<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Section extends Model
{
    use HasFactory;
        protected $guarded = ['id'];

    public function children() {
        return $this->hasMany($this, 'section_group_id', 'id');
    }
    public function scopeActive(Builder $query)
    {
        return $query->where('status', 1);
    }
}
