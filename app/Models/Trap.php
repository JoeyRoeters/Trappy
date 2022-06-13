<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Carbon;

/**
 * App\Models\Trap.
 *
 * @property int $id
 * @property string $name
 * @property string|null $description
 * @property int|null $location_id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property string|null $deleted_at
 * @property-read Collection|TrapActivity[] $activities
 * @property-read int|null $activities_count
 * @property-read Location|null $location
 * @method static Builder|Trap newModelQuery()
 * @method static Builder|Trap newQuery()
 * @method static Builder|Trap query()
 * @method static Builder|Trap whereCreatedAt($value)
 * @method static Builder|Trap whereDeletedAt($value)
 * @method static Builder|Trap whereDescription($value)
 * @method static Builder|Trap whereId($value)
 * @method static Builder|Trap whereLocationId($value)
 * @method static Builder|Trap whereName($value)
 * @method static Builder|Trap whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property string $status
 * @method static Builder|Trap whereStatus($value)
 * @property int $is_open
 * @method static Builder|Trap whereIsOpen($value)
 */
class Trap extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'location_id',
        'status',
        'identifier',
    ];

    public function location(): BelongsTo
    {
        return $this->belongsTo(Location::class);
    }

    public function getLocationName(): string
    {
        return $this->location?->name ?: 'Not coupled';
    }

    public function activities(): HasMany
    {
        return $this->hasMany(TrapActivity::class);
    }
}
