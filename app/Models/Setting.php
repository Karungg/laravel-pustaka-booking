<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'borrow_duration',
        'fine',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @method array
     */
    protected function casts()
    {
        return [
            'id' => 'integer',
        ];
    }
}
