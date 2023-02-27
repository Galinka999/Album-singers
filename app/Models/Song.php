<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Song extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'name',
        'singer_id',
    ];

    public function singer(): belongsTo
    {
        return $this->belongsTo(Singer::class);
    }

    public function albums(): belongsToMany
    {
        return $this->belongsToMany(Album::class);
    }
}
