<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Consultant extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'img'];
    public function project()
    {
        return $this->hasMany(Project::class, 'consultant_id');
    }
}
