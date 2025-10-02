<?php

namespace App\Models;

use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Notifications\Notifiable;

class Clothing extends Model

{
    /** @use HasFactory<UserFactory> */
    use Notifiable, HasUuids;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'id',
        'user_id',
        'clothing_name',
        'clothing_path',
        'clothing_description',
        'available',
        'clothing_path',
    ];


    /**
     * The attributes that should be hidden for serialization.
     *


    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'available' => 'boolean',
        ];
    }

    public function getClothingUrlAttribute(): string
    {
        return url("storage/images/{$this->clothing_path}");
    }

    public function user(): BelongsTo{
        return $this->belongsTo(User::class);
    }

    public function look(): BelongsTo{
        return $this->belongsTo(Look::class);
    }
}



