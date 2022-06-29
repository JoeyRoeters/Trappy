<?php

namespace App\Models;

use App\Helpers\Utils;
use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Carbon;

/**
 * App\Models\Location.
 *
 * @property int $id
 * @property string $name
 * @property string|null $description
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read Collection|Trap[] $traps
 * @property-read int|null $traps_count
 * @method static Builder|Location newModelQuery()
 * @method static Builder|Location newQuery()
 * @method static Builder|Location query()
 * @method static Builder|Location whereCreatedAt($value)
 * @method static Builder|Location whereDescription($value)
 * @method static Builder|Location whereId($value)
 * @method static Builder|Location whereName($value)
 * @method static Builder|Location whereUpdatedAt($value)
 * @mixin Eloquent
 * @property float|null $latitude
 * @property float|null $longitude
 * @property string|null $address
 * @method static Builder|Location whereAddress($value)
 * @method static Builder|Location whereLatitude($value)
 * @method static Builder|Location whereLongitude($value)
 */
class Location extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
    ];

    public function traps(): HasMany
    {
        return $this->hasMany(Trap::class);
    }

    public function trapActivitiesQuery(?string $type = null)
    {
        $query = TrapActivity::query()->whereHas('trap', function ($q) {
            $q->whereLocationId($this->id);
        });

        if ($type !== null) {
            $query->whereType($type);
        }

        return $query;
    }

    public function getAddress(bool $refresh = false): string
    {
        if (!empty($this->address) && !$refresh) {
            return $this->address;
        }

        $address = Utils::locationToAddress($this);

        $this->address = $address;
        $this->save();

        return $address;
    }

    public function getLatestActivities(): array
    {
        $data = [];

        $activities = $this->trapActivitiesQuery(TrapActivity::TYPE_CATCH)->orderByDesc('created_at')->take(5)->get();
        foreach ($activities as $activity) {
            $data[] = [
                'name' => $activity->trap->name,
                'location' => $activity->trap->getLocationName(),
                'date' => $activity->created_at?->format('d F H:i'),
                'url' => route('traps.show', $activity->trap()->first()),
            ];
        }

        return $data;
    }
}
