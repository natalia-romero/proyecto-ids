<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SLA extends Model
{
    use HasFactory;
    public const NORMAL_ID = 1;
    public const MEDIUM_ID = 2;
    public const HIGH_ID = 3;
    public function tickets()
    {
        return $this->hasMany(Ticket::class);
    }
}
