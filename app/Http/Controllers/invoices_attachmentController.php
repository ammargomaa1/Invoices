<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\invoices_attachment;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\UploadedFile;


class invoices_attachmentController extends Controller
{
    public function __construct()
    {
        return $this->middleware('auth');
    }
    public function store(Request $request)
    {
        $invoice_id = $request->invoice_id;

        $this->validate($request,[
            'file_name'=>'mimes:pdf'
        ],[
            'file_name.mimes'=>'صيغة الملف يجب أن تكون pdf'
        ]);





        $file_name = $request->file('file_name')->getClientOriginalName();
        $invoice_attachment = new invoices_attachment();

        $invoice_number = $request->invoice_number;
        $invoice_attachment = new invoices_attachment();
        $invoice_attachment->file_name = $file_name;
        $invoice_attachment->invoice_number = $invoice_number;
        $invoice_attachment->created_by = Auth::user()->name;
        $invoice_attachment->invoice_id = $invoice_id;
        $invoice_attachment->save();
        $imageName = $request->file_name->getClientOriginalName();
        $request->file_name->move(public_path('Attachments/'.$invoice_number),$imageName);
        session()->flash('Add','تم إضافة المرفق بنجاح');
        return redirect('/invoicesdetails/'.$invoice_id);
    }
}
