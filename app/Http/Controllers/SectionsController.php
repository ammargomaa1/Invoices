<?php

namespace App\Http\Controllers;

use App\Models\sections;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SectionsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

     public function index()
    {
        $sections = sections::get();
        return view('sections.sections',['sections'=>$sections]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        //

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedata = $request->validate([
            'section_name'=>'required|unique:sections|max:255',
            'description'=>'required'
        ],[
            'section_name.required' => 'حقل الإسم مطلوب',
            'section_name.unique'=>'هذا القسم موجود بالفعل',
            'section_name.max'=>'الحد الأقصى للإسم 255 حرف',
            'description.required'=>'برجاء إدخال الوصف'
        ]);

        sections::create([
            'section_name'=> $request->section_name,
            'description'=> $request->description,
            'created_by'=>Auth::user()->name
        ]);
        session()->flash('Add','تم إضافة القسم بنجاح');
        return redirect('/sections');

        /*if(sections::where('section_name','=',$request['section_name'])->exists()){
            session()->flash('Error','القسم مسجل مسبقًا');
            return redirect('/sections');
        }else{
            sections::create([
                'section_name'=> $request->section_name,
                'description'=> $request->description,
                'created_by'=>Auth::user()->name
            ]);
            session()->flash('Add','تم إضافة القسم بنجاح');
            return redirect('/sections');
        }*/
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\sections  $sections
     * @return \Illuminate\Http\Response
     */
    public function show(sections $sections)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\sections  $sections
     * @return \Illuminate\Http\Response
     */
    public function edit(sections $sections)
    {
        //


    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\sections  $sections
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, sections $sections)
    {
        //
        $id = $request->id;
        $section = sections::find($id);


        $validatedata = $request->validate([
            'section_name'=>'required|unique:sections|max:255'.$id,
            'description'=>'required'
        ],[
            'section_name.required' => 'حقل الإسم مطلوب',
            'section_name.unique'=>'هذا القسم موجود بالفعل',
            'section_name.max'=>'الحد الأقصى للإسم 255 حرف',
            'description.required'=>'برجاء إدخال الوصف'
        ]);


        $section->update([
            'section_name'=> $request->section_name,
            'description'=> $request->description,
            'created_by' => Auth::user()->name
        ]);
        session()->flash('Add','تم تعديل القسم بنجاح');

        return redirect('/sections');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\sections  $sections
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        //
        $section = sections::find($request->id);
        $section->delete();
        session()->flash('Destroy','تم حذف القسم');
        return redirect('/sections');
    }
}
