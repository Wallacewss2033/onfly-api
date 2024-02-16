<?php

namespace App\Models;

use Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Expense extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'description',
        'date',
        'user_id',
        'value',
    ];

    protected $appends = ['format_value', 'format_date'];

    public function getFormatValueAttribute()
    {
        return number_format($this->value, 2, ",", ".");
    }

    public function getFormatDateAttribute()
    {
        return implode('/', array_reverse(explode('-', $this->date)));
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
