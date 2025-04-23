<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Region extends Model
{
    protected $fillable = ['name', 'type', 'description', 'geometry'];
    protected $casts = ['geometry' => 'array'];

    public function reports()
    {
        return $this->hasMany(Report::class);
    }
}
