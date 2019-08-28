<?php

namespace App\Http\Controllers;

use App\Helpers\GetUrlHelper;
use App\Helpers\PaginationHelper;
use App\Http\Requests\ProductRequest;
use App\Models\Product;
use App\Services\ProductService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Session;

class ProductController extends Controller
{
    /**
     * Show Product list
     *
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request)
    {
        $listProduct = Product::orderBy('product.created_at', 'desc')
            ->paginate(PaginationHelper::PER_PAGE)
            ->appends(Input::except(['page', '_token']));;
        return view('product.index', ['listProduct' => $listProduct]);
    }

    /**
     * show form add, edit Product
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function add()
    {
        // set title, sub title
        $productDetail = null;
        $data = [
            'productDetail' => $productDetail,
        ];
        return view('product.add', $data);
    }

    /**
     * get form edit Product
     *
     * @param int $product_id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($product_id)
    {
        $productDetail = Product::where('product_id', $product_id)->first();
        // handler case edit or delete one record not exist (deleted by another)
        if (!$productDetail) {
            if (!strpos(url()->previous(), 'confirm')) {
                abort(404);
            } else {
                Session::flash('error', 'update by another');
                return redirect(route('productIndex'));
            }
        }
        $data = [
            'productDetail' => $productDetail
        ];
        return view('product.add', $data);
    }

    /**
     * confirm add, edit, delete
     *
     * @param ProductRequest $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function confirm(ProductRequest $request)
    {
        $inputs = $request->input();
        \Session::flashInput($inputs);
        // Check exist and valid customer in case edit product
        // case delete product
        if ($inputs['product_id']) {
            //case update Product
            $previous = url('') . '/product/edit/' . $inputs['product_id'];
        } else {
            //case create new Product
            $previous = url('') . '/product/add';
        }
        $data = [
            'previous' => $previous,
            'inputs' => $inputs
        ];
        return view('product.confirm', $data);
    }

    /**
     * insert, update Product to database
     *
     * @param ProductRequest $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function complete(ProductRequest $request)
    {
        $inputs = $request->input();
        \Session::flashInput($inputs);
        // Check exist and valid customer in case edit product


        // check status of product
        if (!in_array($inputs['status'], [ProductRequest::ACTIVE, ProductRequest::IN_ACTIVE])) {
            \Session::flash('error', 'Status Not In');
            return redirect(route('productIndex'));
        }
        if (!empty($inputs['product_id'])) {
            //check input updated_at
            if (!isset($inputs['updated_at'])) {
                \Session::flash('error', 'Update by another');
                return redirect(route('productIndex'));
            }

            // call function update Product
            $result = ProductService::updateProduct($inputs);
            $redirect = url('') . '/product/edit/' . $inputs['product_id'];
        } else {
            // call function add new Product
            $result = ProductService::createProduct($inputs);
            $redirect = url('') . '/product/add';
        }
        //if error with update, go to previous url.
        if (!$result) {
            return redirect($redirect);
        }
        //will be go to list agency if success
        return redirect(route('productIndex'));
    }
}
