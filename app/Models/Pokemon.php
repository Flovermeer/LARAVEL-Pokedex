<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Type;

class Pokemon extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'gender',
        'type',
        'trainer'
    ];

    public function types()
    {
        return $this->belongsToMany(Type::class)->withPivot('created_at');
    }

    public function trainers()
    {
        return $this->belongsTo(Trainer::class);
    }
}
