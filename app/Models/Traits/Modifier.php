<?php

namespace App\Models\Traits;

use Illuminate\Support\Facades\Auth;

trait Modifier
{
    public static function boot()
    {
        parent::boot();
        if (Auth::guard()->check()) {
            $user = Auth::user();

            self::creating(function ($model) use ($user) {
                $model->created_uid = $user->uid;
                $model->updated_uid = $user->uid;
            });

            self::updating(function ($model) use ($user) {
                $model->updated_uid = $user->uid;
            });

            self::deleting(function ($model) use ($user) {
                $model->updated_uid = $user->uid;
            });
        }
    }
}
