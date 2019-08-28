<?php

namespace App\Models\Classes;

use App\Models\Traits\Modifier;
use Illuminate\Foundation\Auth\User as Authenticatable;

/**
 * Class BaseAuth
 * @package App\Models\Classes
 */
class BaseAuth extends Authenticatable
{
    use Modifier;

    protected $guarded = [
        'created_uid',
        'updated_uid'
    ];

    protected $dates = [
        'created_at',
        'updated_at'
    ];

    /**
     * Create a new Eloquent query builder for the model.
     *
     * @param  \Illuminate\Database\Query\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder|static
     */
    public function newEloquentBuilder($query)
    {
        return new BaseBuilder($query);
    }
}
