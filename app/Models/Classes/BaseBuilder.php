<?php

namespace App\Models\Classes;

use Illuminate\Support\Facades\Auth;

/**
 * Class BaseBuilder
 * @package App\Models\Classes
 */
class BaseBuilder extends \Illuminate\Database\Eloquent\Builder
{
    /**
     * Update a record in the database.
     *
     * @param  array $values
     * @return int
     */
    public function update(array $values)
    {
        $data = $this->addUpdatedAtColumn($values);
        if (Auth::guard()->check()) {
            $data['updated_uid'] = Auth::user()->uid;
        }
        return $this->toBase()->update($data);
    }
}
