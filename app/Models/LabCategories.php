<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class LabCategories extends Model
{ 
    use HasFactory, SoftDeletes;

    protected $table = "laboratorium_category";

    protected $fillable = [
        'id', 'author', 'name', 'description',
    ];
    
    /**
     * Get the authorId that owns the LabCategories
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function authorId(): BelongsTo
    {
        return $this->belongsTo(User::class, 'author', 'id');
    }
}
