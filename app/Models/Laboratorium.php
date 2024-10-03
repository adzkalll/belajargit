<?php

namespace App\Models;

use App\Models\LabCategories;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class Laboratorium extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = "laboratorium";

    protected $fillable = [
        'laboratorium_category_id', 'user_id', 'name', 'description', 'head_of_lab', 'start_operasional_hour', 'end_operasional_hour'
    ];

    public function lab_category(): BelongsTo
    {
        return $this->belongsTo(LabCategories::class, 'laboratorium_category_id', 'id');
    }

    /**
     * Get the userId that owns the Laboratorium
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function userId(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

}