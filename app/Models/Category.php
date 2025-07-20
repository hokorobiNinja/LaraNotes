<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Note;

class Category extends Model
{
    public function notes()
    {
        return $this->hasMany(Note::class);
    }
}
