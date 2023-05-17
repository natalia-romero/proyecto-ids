<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */

    protected $fillable = [
        'reason',
        'description',
        'user_id',
        'functionary_id',
        'category_id',
        'state_id',
        'sla_id',
    ];

    public function users()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    public function functionaries()
    {
        return $this->belongsTo(Functionary::class, 'functionary_id');
    }
    public function categories()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }
    public function states()
    {
        return $this->belongsTo(State::class, 'state_id');
    }
    public function slas()
    {
        return $this->belongsTo(SLA::class, 'sla_id');
    }

    public function files()
    {
        return $this->hasMany(File::class);
    }
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }
}
