<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\DB;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'given_name',
        'family_name',
        'hd',
        'locale',
        'picture',
        'google_id',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
        'email_verified_at',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function logins(): HasMany
    {
        return $this->hasMany(UserLogin::class);
    }

    public function getLoginsCountAttribute(): int
    {
        return $this->logins()->count();
    }

    public function scopeWithLastLogin(Builder $builder): void
    {
        $relation = $this->logins();
        $userLoginsTable = $relation->getRelated()->getTable();
        $userLoginsForeignKey = $relation->getForeignKeyName();

        $sub = UserLogin::select($userLoginsForeignKey)
            ->selectRaw('MAX(created_at) as last_login')
            ->groupBy($userLoginsForeignKey);

        $builder
            ->join(
                DB::raw("({$sub->toSql()}) {$userLoginsTable}"),
                fn ($join) =>
                    $join->on(
                        $relation->getQualifiedParentKeyName(),
                        '=',
                        $relation->getQualifiedForeignKeyName()
                    )
            );
    }
}
