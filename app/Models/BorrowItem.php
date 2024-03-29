<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class BorrowItem extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'borrow_id',
        'book_id',
        'fine',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @method array
     */
    protected function casts(): array
    {
        return [
            'id' => 'integer',
            'borrow_id' => 'integer',
            'book_id' => 'integer',
        ];
    }

    public function borrow(): BelongsTo
    {
        return $this->belongsTo(Borrow::class);
    }

    public function book(): BelongsTo
    {
        return $this->belongsTo(Book::class);
    }
}
