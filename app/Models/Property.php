<?php

// DONE

namespace App\Models;

use App\Observers\PropertyObserver;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

#[ObservedBy([PropertyObserver::class])]
class Property extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia, softDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'price',
        'surface',
        'lat',
        'lon',
        'rooms',
        'toilets',
        'bedrooms',
        'garage',
        'furnished',
        'floors',
        'lease_duration',
        'video_intercom',
        'keycard_entry',
        'elevator',
        'description',
        'year_built',
        'garden',
        'status',
    ];

    public function type(): BelongsTo
    {
        return $this->belongsTo(Type::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function actions(): HasMany
    {
        return $this->hasMany(Actions::class);
    }
}
