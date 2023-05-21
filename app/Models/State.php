<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class State extends Model
{
    use HasFactory;
    public const OPEN_ID = 1;
    public const SPECIALIST_ID = 2;
    public const CLOSE_ID = 3;
    public function tickets()
    {
        return $this->hasMany(Ticket::class);
    }
}
