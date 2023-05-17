<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;
    public const COORDINATOR_ID = 1;
    public const SUPPORT_ID = 2;
    
    public function tickets()
    {
        return $this->hasMany(Ticket::class);
    }
}
