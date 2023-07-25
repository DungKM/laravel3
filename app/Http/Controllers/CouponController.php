<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\Coupon\CreateCouponRequest;
use App\Http\Requests\Coupon\UpdateCouponRequest;
use App\Models\Coupon;
use Illuminate\Http\Request;
use Laravel\Ui\Presets\React;
use Yajra\DataTables\DataTables;

class CouponController extends Controller
{
    protected $coupon;
    public function __construct(Coupon $coupon)
    {
        $this->coupon = $coupon;
    }
  
    public function index(Request $request)
    {
        $search = $request->get(key: 'q');
        $coupons = $this->coupon->latest('id')->where(column: 'name', operator: 'like', value: '%' . $search . '%')->paginate(3);
        return view('admin.coupons.index', compact('coupons','search'));
    }

 
    
    public function create()
    {
        return view('admin.coupons.create');
    }

    public function store(CreateCouponRequest $request)
    {
        $dataCreate =  $request->all();

        $this->coupon->create($dataCreate);

        return redirect()->route('coupons.index')->with(['message' => 'create coupon success']);
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        //
        $coupon = $this->coupon->findOrFail($id);
        return view('admin.coupons.edit', compact('coupon'));
    }

    public function update(UpdateCouponRequest $request, $id)
    {
        $coupon = $this->coupon->findOrFail($id);
        $dataUpdate = $request->all();
        $coupon->update($dataUpdate);
        return redirect()->route('coupons.index')->with(['message' => 'Update coupon success']);
    }
    public function destroy($id)
    {
        $coupon = $this->coupon->findOrFail($id);
        $coupon->delete();

        return redirect()->route('coupons.index')->with(['message' => 'Delete ' . $coupon->name . ' success']);
    }

}