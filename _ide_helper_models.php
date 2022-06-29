<?php

// @formatter:off
/**
 * A helper file for your Eloquent Models
 * Copy the phpDocs from this file to the correct Model,
 * And remove them from this file, to prevent double declarations.
 *
 * @author Barry vd. Heuvel <barryvdh@gmail.com>
 */


namespace App\Models{
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
	class Location extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Setting.
 *
 * @property int $id
 * @property string $key
 * @property string $value
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @method static Builder|Setting newModelQuery()
 * @method static Builder|Setting newQuery()
 * @method static Builder|Setting query()
 * @method static Builder|Setting whereCreatedAt($value)
 * @method static Builder|Setting whereId($value)
 * @method static Builder|Setting whereKey($value)
 * @method static Builder|Setting whereUpdatedAt($value)
 * @method static Builder|Setting whereValue($value)
 * @mixin Eloquent
 */
	class Setting extends \Eloquent {}
}

namespace App\Models{
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
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\UserNotification[] $userNotifications
 * @property-read int|null $user_notifications_count
 */
	class Trap extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\TrapActivity.
 *
 * @property int $id
 * @property int $trap_id
 * @property string $type
 * @property string $data
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @method static Builder|TrapActivity newModelQuery()
 * @method static Builder|TrapActivity newQuery()
 * @method static Builder|TrapActivity query()
 * @method static Builder|TrapActivity whereCreatedAt($value)
 * @method static Builder|TrapActivity whereData($value)
 * @method static Builder|TrapActivity whereId($value)
 * @method static Builder|TrapActivity whereTrapId($value)
 * @method static Builder|TrapActivity whereType($value)
 * @method static Builder|TrapActivity whereUpdatedAt($value)
 * @mixin Eloquent
 * @property-read \App\Models\Trap|null $trap
 */
	class TrapActivity extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\User.
 *
 * @property int $id
 * @property string $name
 * @property string $email
 * @property string|null $phone
 * @property Carbon|null $email_verified_at
 * @property string $password
 * @property string $notification_settings
 * @property string|null $remember_token
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property-read DatabaseNotificationCollection|DatabaseNotification[] $notifications
 * @property-read int|null $notifications_count
 * @property-read Collection|PersonalAccessToken[] $tokens
 * @property-read int|null $tokens_count
 * @method static UserFactory factory(...$parameters)
 * @method static Builder|User newModelQuery()
 * @method static Builder|User newQuery()
 * @method static Builder|User query()
 * @method static Builder|User whereCreatedAt($value)
 * @method static Builder|User whereEmail($value)
 * @method static Builder|User whereEmailVerifiedAt($value)
 * @method static Builder|User whereId($value)
 * @method static Builder|User whereName($value)
 * @method static Builder|User whereNotificationSettings($value)
 * @method static Builder|User wherePassword($value)
 * @method static Builder|User wherePhone($value)
 * @method static Builder|User whereRememberToken($value)
 * @method static Builder|User whereUpdatedAt($value)
 * @mixin Eloquent
 * @property-read Collection|\App\Models\UserNotification[] $userNotifications
 * @property-read int|null $user_notifications_count
 */
	class User extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\UserNotification
 *
 * @property int $user_id
 * @property string $type
 * @property string $text
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\User|null $user
 * @method static \Illuminate\Database\Eloquent\Builder|UserNotification newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|UserNotification newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|UserNotification query()
 * @method static \Illuminate\Database\Eloquent\Builder|UserNotification whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserNotification whereText($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserNotification whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserNotification whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|UserNotification whereUserId($value)
 * @mixin \Eloquent
 * @property int $trap_id
 * @method static \Illuminate\Database\Eloquent\Builder|UserNotification whereTrapId($value)
 * @property-read \App\Models\Trap|null $trap
 */
	class UserNotification extends \Eloquent {}
}

