<?php

namespace App\Http\Controllers;

use App\Models\Products;
use App\Models\sections;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductsController extends Controller
{
    public function __construct()
    {
        return $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Products::get();
        $sections = sections::get();
        return view('products.products',['products'=>$products, 'sections'=>$sections]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $request->validate([
            'product_name'=>'required|unique:products|max:255',
            'description'=>'required'
        ],[
            'product_name.required' => 'حقل الإسم مطلوب',
            'product_name.unique'=>'هذا القسم موجود بالفعل',
            'product_name.max'=>'الحد الأقصى للإسم 255 حرف',
            'description.required'=>'برجاء إدخال الوصف'

        ]);

        Products::create([
            'product_name'=> $request->product_name,
            'description'=> $request->description,
            'section_id'=>$request->section_id
        ]);
        session()->flash('Add','تم إضافة المنتج بنجاح');
        return redirect('/products');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Products  $products
     * @return \Illuminate\Http\Response
     */
    public function show(Products $products)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Products  $products
     * @return \Illuminate\Http\Response
     */
    public function edit(Products $products)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Products  $products
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $section_id = sections::where('section_name',$request->section_name)->first()->id;
        $id = request()->id;

        $product = Products::find($id);

        $request->validate([
            'product_name'=>'required|unique:products|max:255',
            'description'=>'required'
        ],[
            'product_name.required' => 'حقل الإسم مطلوب',
            'product_name.unique'=>'هذا القسم موجود بالفعل',
            'product_name.max'=>'الحد الأقصى للإسم 255 حرف',
            'description.required'=>'برجاء إدخال الوصف'

        ]);
        $product->update([
            'product_name'=> $request->product_name,
            'description'=> $request->description,
            'section_id'=>$section_id
        ]);
        session()->flash('Add','تم تعديل المنتج بنجاح');
        return redirect('/products');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Products  $products
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $product = Products::find($request->id);
        $product->delete();
        session()->flash('Destroy','تم حذف المنتج ');
        return redirect('/products');
    }
}
