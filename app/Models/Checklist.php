<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Checklist extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    public function checklist_item()
    {
        return $this->hasMany(ChecklistItem::class);
    }
}
