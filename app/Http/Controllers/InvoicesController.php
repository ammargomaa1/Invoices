<?php

namespace App\Http\Controllers;

use App\Exports\InvoicesExport;
use App\Models\Invoices;
use App\Models\invoices_attachment;
use App\Models\invoices_details;
use App\Models\Products;
use App\Models\sections;
use App\Models\User;
use App\Notifications\InvoiceAdd;
use Illuminate\Http\Request;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;

class InvoicesController extends Controller
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
        //
        $invoices = Invoices::get();

        return view('invoices.invoices',['invoices'=>$invoices]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $sections = sections::get();
        return view('invoices.add_invoice', compact('sections'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //return $request;
        Invoices::create([
            'invoice_number'=>$request->invoice_number,
            'invoice_date'=>$request->invoice_Date,
            'due_date'=>$request->Due_date,
            'product'=>$request->product,
            'section_id'=>$request->Section,
            'amount_collection'=>$request->Amount_collection,
            'discount'=>$request->Discount,
            'amount_commission'=>$request->Amount_Commission,
            'value_vat'=>$request->Value_VAT,
            'rate_vat'=>$request->Rate_VAT,
            'total'=>$request->Total,
            'status'=>'غير مدفوعة',
            'value_status'=>'2',
            'note'=>$request->note,
            'user'=>Auth::user()->name

        ]);

        $invoiceo=Invoices::latest()->first();

        $invoice_id = $invoiceo->id;

        invoices_details::create([
            'id_invoices'=>$invoice_id,
            'invoice_number'=>$request->invoice_number,
            'product'=>$request->product,
            'section'=>$request->Section,
            'status'=>'غير مدفوعة',
            'note'=>$request->note,
            'value_status'=>'2',
            'user'=>Auth::user()->name
        ]);
            if($request->hasFile('pic')){
                $this->validate($request,['pic'=>'required|mimes:pdf|max:10000'],['pic.mimies'=>'خطأ … تم حفظ الفاتورة ولم يتم حفظ الملف']);
                $image = $request->file('pic');
                $file_name = $image->getClientOriginalName();
                $invoice_number = $request->invoice_number;
                $invoice_attachment = new invoices_attachment();
                $invoice_attachment->file_name = $file_name;
                $invoice_attachment->invoice_number = $invoice_number;
                $invoice_attachment->created_by = Auth::user()->name;
                $invoice_attachment->invoice_id = $invoice_id;
                $invoice_attachment->save();
                /*
                invoices_attachment::create([
                    'file_name'=>$file_name,
                    'invoice_number'=>$invoice_number,
                    'created_by'=>Auth::user()->name,
                    'invoice_id'=>$invoice_id
                ]);*/


                //move pic

                $imageName = $request->pic->getClientOriginalName();
                $request->pic->move(public_path('Attachments/'.$invoice_number),$imageName);
            }

            $user = User::first();
            $user->notify(new InvoiceAdd($invoice_id));
        session()->flash('Add','تم إضافة الفاتورة بنجاح');
        return redirect('/invoices');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Invoices  $invoices
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

        $invoice = Invoices::findOrFail($id);
        return view('invoices.status_show',compact('invoice'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Invoices  $invoices
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $invoice = Invoices::where('id',$id)->first();
        // dd($invoice);
        $sections = sections::all();
        return view('invoices.edit_invoice',compact('invoice','sections'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Invoices  $invoices
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        //dd($request);
        $id = $request->id;
        $invoice = Invoices::find($id);
        $invoice->update([
            'invoice_number'=>$request->invoice_number,
            'invoice_date'=>$request->invoice_Date,
            'due_date'=>$request->Due_date,
            'product'=>$request->product,
            'section_id'=>$request->Section,
            'amount_collection'=>$request->Amount_collection,
            'discount'=>$request->Discount,
            'amount_commission'=>$request->Amount_Commission,
            'value_vat'=>$request->Value_VAT,
            'rate_vat'=>$request->Rate_VAT,
            'total'=>$request->Total,
            'status'=>'غير مدفوعة',
            'value_status'=>'2',
            'note'=>$request->note,
            'user'=>Auth::user()->name
        ]);

        session()->flash('Add','تم تعديل الفاتورة بنجاح');
        return redirect('/invoices');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Invoices  $invoices
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        //dd($request);
        $id = $request->invoice_id;
        $invoice = Invoices::find($id);

        if(!$request->id_page==2){

            $details = invoices_attachment::findOrFail($id);
            if(!empty($details->invoice_number)){
                Storage::disk('public_uploads')->deleteDirectory($details->invoice_number);
                $invoice->forceDelete();
                session()->flash('delete_invoice','تم حذف الفاتورة');
                return redirect('/invoices');
                //dd($details);
            }
        }else{
            $invoice->delete();
            session()->flash('archive_invoice','تم أرشفة الفاتورة');
                return redirect('/invoices');
        }



    }

    public function getproduct($id)
    {
        $products = DB::table("products")->where("section_id",$id)->pluck('product_name','id');
        $products->all();

        return json_encode($products);
    }

    public function update_status($id,Request $request)
    {
        //return $request;
        $invoice = Invoices::findOrFail($id);
        if($request->status === "مدفوعة")
            {
                $invoice->update([
                    'status' => 'مدفوعة',
                    'value_status'=>'1'
                ]);

                invoices_details::create([
                    'id_invoices'=>$id,
                    'invoice_number'=>$request->invoice_number,
                    'product'=>$request->product,
                    'section'=>$request->Section,
                    'status'=>'مدفوعة',
                    'note'=>$request->note,
                    'value_status'=>'1',
                    'user'=>Auth::user()->name
                ]);


            }
        else
            {
                $invoice->update([
                    'status' => 'مدفوعة جزئيا',
                    'value_status'=>'0'
                ]);

                invoices_details::create([
                    'id_invoices'=>$id,
                    'invoice_number'=>$request->invoice_number,
                    'product'=>$request->product,
                    'section'=>$request->Section,
                    'status'=>'مدفوعة جزئيا',
                    'note'=>$request->note,
                    'value_status'=>'0',
                    'user'=>Auth::user()->name
                ]);
            }
            session()->flash('Add','تم تعديل حالة الفاتورة');
        return redirect('/invoices');

    }
    public function unpaid_invoices()
    {
        $invoices = Invoices::where('value_status',2)->get();
        return view('invoices.unpaid_invoices',compact('invoices'));
    }

    public function paid_invoices()
    {
        $invoices = Invoices::where('value_status',1)->get();
        return view('invoices.paid_invoices',compact('invoices'));
    }
    public function partial_paid()
    {
        $invoices = Invoices::where('value_status',0)->get();
        return view('invoices.partial_paid',compact('invoices'));
    }
    public function print_invoice(Request $request)
    {
        $id = $request->id;
        $invoice = Invoices::findOrFail($id);
        return view('invoices.print_invoice',compact('invoice'));
    }

    public function export()
    {
        return Excel::download(new InvoicesExport, 'Invoices.xlsx');

    }

}
