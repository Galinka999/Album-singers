<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Album extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'singer_id',
        'name',
        'year',
    ];

    protected $casts = [
        'year' => 'integer',
    ];

    public function singer(): belongsTo
    {
        return $this->belongsTo(Singer::class);
    }

    public function songs(): belongsToMany
    {
        return $this->belongsToMany(Song::class);
    }
}
