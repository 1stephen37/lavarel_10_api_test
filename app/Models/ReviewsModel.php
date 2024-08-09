<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @method static where(string $string, $id)
 * @method static find($id)
 */
class ReviewsModel extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'reviews';
    protected $primaryKey = 'id_review';

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'id_user');
    }

    /**
     * The attributes that are mass assignable.
     *
     *   * @var array<int, string>
     */
    protected $fillable = [
        'content',
        'id_user',
    ];

}
