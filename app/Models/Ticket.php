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
        'description',
        'user_id',
        'functionary_id',
        'category_id',
        'state_id',
        'sla_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id')->withTrashed();
    }
    public function functionary()
    {
        return $this->belongsTo(Functionary::class, 'functionary_id');
    }
    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }
    public function state()
    {
        return $this->belongsTo(State::class, 'state_id');
    }
    public function sla()
    {
        return $this->belongsTo(SLA::class, 'sla_id');
    }

    public function file()
    {
        return $this->hasMany(File::class);
    }
    public function comment()
    {
        return $this->hasMany(Comment::class);
    }
}
