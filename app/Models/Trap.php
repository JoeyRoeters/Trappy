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
 * @property string|null $battery
 * @property bool|null $is_open
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
 * @method static Builder|Trap whereIsOpen($value)
 * @property string $identifier
 * @method static Builder|Trap whereBattery($value)
 * @method static Builder|Trap whereIdentifier($value)
 */
class Trap extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'location_id',
        'status',
        'battery',
        'is_open',
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

    public function userNotifications(): HasMany
    {
        return $this->hasMany(UserNotification::class);
    }

    public function getTrapActivities(): array
    {
        $data = [];

        $activities = $this->activities()->whereType(TrapActivity::TYPE_CATCH)->orderByDesc('created_at')->take(5)->get();
        foreach ($activities as $activity) {
            $data[] = [
                'name' => $activity->trap->name,
                'location' => $activity->trap->getLocationName(),
                'date' => $activity->created_at?->format('d F H:i'),
                'url' => route('locations.show', $this->location()->first()),
            ];
        }

        return $data;
    }
}
