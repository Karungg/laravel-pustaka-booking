<?php

namespace App\Models;

use App\Enums\BorrowStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Borrow extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'booking_id',
        'user_id',
        'return_date',
        'return_of_date',
        'status',
        'total_fine',
        'status'
    ];

    protected function casts(): array
    {
        return [
            'id' => 'integer',
            'booking_id' => 'integer',
            'user_id' => 'integer',
            'return_date' => 'date',
            'return_of_date' => 'date',
            'status' => BorrowStatus::class
        ];
    }

    public function borrowItems(): HasMany
    {
        return $this->hasMany(BorrowItem::class);
    }

    public function booking(): BelongsTo
    {
        return $this->belongsTo(Booking::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
