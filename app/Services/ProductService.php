<?php

namespace App\Services;

use App\Models\Product;
use Illuminate\Support\Facades\Log;

class ProductService
{
    /**
     * insert product
     *
     * @param array $inputs
     * @return boolean
     */
    public static function createProduct($inputs)
    {
        \DB::beginTransaction();
        try {
            //save product
            Product::create([
                'name' => $inputs['product_name_txt'],
                'is_active' => $inputs['status']
            ]);
            \DB::commit();
        } catch (\Exception $e) {
            Log::error($e->getMessage(), $e->getTrace());
            \DB::rollback();
            abort(500);
            return false;
        }
        \Session::flash('info', 'Create Success');
        return true;
    }

    /**
     * edit product
     *
     * @param array $inputs
     * @return boolean
     */
    public static function updateProduct($inputs)
    {
        \DB::beginTransaction();
        try {
            //save product
            $check = Product::where('product_id', $inputs['product_id'])
                ->where('updated_at', decrypt($inputs['updated_at']))
                ->update([
                    'name' => $inputs['product_name_txt'],
                    'is_active' => $inputs['status'],
                ]);
            if (!$check) {
                \Session::flash('error', 'Update by another');
                $oldSession = session()->pull('_old_input', []);
                unset($oldSession['updated_at']);
                session()->put('_old_input', $oldSession);
                return false;
            }
            \DB::commit();
        } catch (\Exception $e) {
            Log::error($e->getMessage(), $e->getTrace());
            \DB::rollback();
            abort(500);
            return false;
        }
        \Session::flash('info', 'Update Success');
        return true;
    }
}
