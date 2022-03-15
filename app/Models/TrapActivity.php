<?php

namespace App\Models;

use Eloquent;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

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
 */
class TrapActivity extends Model
{
    use HasFactory;
}