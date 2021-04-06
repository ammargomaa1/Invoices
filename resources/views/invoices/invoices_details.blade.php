@extends('layouts.master')
@section('css')
<!---Internal  Prism css-->
<link href="{{URL::asset('assets/plugins/prism/prism.css')}}" rel="stylesheet">
<!---Internal Input tags css-->
<link href="{{URL::asset('assets/plugins/inputtags/inputtags.css')}}" rel="stylesheet">
<!--- Custom-scroll -->
<link href="{{URL::asset('assets/plugins/custom-scroll/jquery.mCustomScrollbar.css')}}" rel="stylesheet">
<!-- Internal Data table css -->
<link href="{{URL::asset('assets/plugins/datatable/css/dataTables.bootstrap4.min.css')}}" rel="stylesheet" />
<link href="{{URL::asset('assets/plugins/datatable/css/buttons.bootstrap4.min.css')}}" rel="stylesheet">
<link href="{{URL::asset('assets/plugins/datatable/css/responsive.bootstrap4.min.css')}}" rel="stylesheet" />
<link href="{{URL::asset('assets/plugins/datatable/css/jquery.dataTables.min.css')}}" rel="stylesheet">
<link href="{{URL::asset('assets/plugins/datatable/css/responsive.dataTables.min.css')}}" rel="stylesheet">
<link href="{{URL::asset('assets/plugins/select2/css/select2.min.css')}}" rel="stylesheet">
<style>
  .panel.panel-primary.tabs-style-2 {
    background-color: white;
}

</style>
@endsection
@section('page-header')

				<!-- breadcrumb -->
                @if (session()->has('delete'))
                        <div class="alert alert-danger alert-dismissable fade show" role="alert">
                            <ul>

                                    <li><strong>{{ session()->get('delete') }}</strong></li>

                            </ul>

                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>

                    @endif
				<div class="breadcrumb-header justify-content-between">
					<div class="my-auto">
						<div class="d-flex">
							<h4 class="content-title mb-0 my-auto">الفواتير</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ تفاصيل الفاتورة</span>
						</div>
					</div>

				</div>
				<!-- breadcrumb -->
@endsection
@section('title')
    تفاصيل الفاتورة رقم {{$invoice->invoice_number}}
@endsection
@section('content')
				<!-- row -->
				<div class="">

                    @if ($errors->any())
                        <div class="alert alert-danger alert-dismissable fade show" role="alert">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>

                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>

                    @endif
                    @if (session()->has('Add'))
                        <div class="alert alert-success alert-dismissable fade show" role="alert">
                            <strong>{{session()->get('Add')}}</strong>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>

                    @endif

                    <div class="panel-body tabs-menu-body main-content-body-right border">
                        <div class="panel panel-primary tabs-style-2">
                            <div class=" tab-menu-heading">
                                <div class="tabs-menu1">
                                    <!-- Tabs -->
                                    <ul class="nav panel-tabs main-nav-line">
                                        <li><a href="#tab4" class="nav-link active" data-toggle="tab">تفاصيل الفاتورة</a></li>
                                        <li><a href="#tab5" class="nav-link" data-toggle="tab">حالة الفاتورة</a></li>
                                        <li><a href="#tab6" class="nav-link" data-toggle="tab">المرفقات</a></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="panel-body tabs-menu-body main-content-body-right border">
                                <div class="tab-content">
                                    <div class="tab-pane active" id="tab4">

                                        <label for="invoice_number" class="control-label">رقم الفاتورة </label>
                                        <input type="text" name="invoice_numer" class="form-control" id="" value="{{$invoice->invoice_number}}" readonly>
                                        <label for="invoice_number" class="control-label">تاريخ الفاتورة </label>
                                        <input type="text" name="invoice_numer" class="form-control" id="" value="{{$invoice->invoice_date}}" readonly>
                                        <label for="invoice_number" class="control-label">تاريخ الإستحقاق</label>
                                        <input type="text" name="invoice_numer" class="form-control" id="" value="{{$invoice->due_date}}" readonly>
                                        <label for="invoice_number" class="control-label">المنتج</label>
                                        <input type="text" name="invoice_numer" class="form-control" id="" value="{{$invoice->product}}" readonly>
                                        <label for="invoice_number" class="control-label">القسم </label>
                                        <input type="text" name="invoice_numer" class="form-control" id="" value="{{$invoice->section->section_name}}" readonly>



                                    </div>
                                    <div class="tab-pane" id="tab5">
                                        <table id="example1" class="table key-buttons text-md-nowrap" data-page-length = "50">
                                            <thead>
                                                <tr>
                                                    <th class="border-bottom-0">#</th>
                                                    <th class="border-bottom-0">رقم الفاتورة</th>
                                                    <th class="border-bottom-0">المنتج</th>
                                                    <th class="border-bottom-0">الحالة</th>
                                                    <th class="border-bottom-0">أضيفت بواسطة</th>

                                                </tr>
                                            </thead>

                                            <tbody>
                                                <?php $i = 0; ?>
                                                @foreach ($invoice_details as $invoice_detail)
                                                <?PHP $i++?>
                                                <tr>
                                                    <td>{{$i }}</td>
                                                    <td>{{$invoice_detail->invoice_number}}</td>
                                                    <td>{{$invoice_detail->product}}</td>

                                                        @if ($invoice_detail->value_status==1)
                                                                <td  name="invoice_numer" class="form-control text-success"  >{{$invoice_detail->status}}</td>
                                                            @elseif ($invoice_detail->value_status==2)
                                                                <td type="text" name="invoice_numer" class="form-control text-danger"  >{{$invoice_detail->status}}</td>
                                                            @elseif ($invoice_detail->value_status==0)
                                                                <td type="text" name="invoice_numer" class="form-control text-warning"  >{{$invoice_detail->status}}</td>
                                                            @endif


                                                    <td>{{$invoice_detail->user}}</td>



                                                </tr>
                                                @endforeach






                                            </tbody>
                                        </table>






                                    </div>
                                    <div class="tab-pane" id="tab6">
                                        <div class="card-body">
                                            <div class="table-responsive">
                                                <p class="text-danger">*صيغة المرفق PDF</p>
                                                <h5 class="card-title">إضافة مرفقات</h5>
                                                <form method="POST" action="{{url("/InvoiceAttachment")}}" enctype="multipart/form-data">
                                                    @csrf
                                                    <div class="custom-file">
                                                        <input type="file" name="file_name"  class="custom-file-input" required >
                                                        <input type="hidden" name="invoice_number" id="custom-file" value="{{$invoice->invoice_number}}">
                                                        <input type="hidden" name="invoice_id" id="invoice_id" value="{{$invoice->id}}">
                                                        <label for="customfile" class="custom-file-label">حدد المرفق</label>
                                                    </div><br><br>
                                                    <button type="submit" class="btn btn-primary btn-sm" name="uploadedfile">تأكيد</button>
                                                </form>
                                                <table id="example1" class="table key-buttons text-md-nowrap" data-page-length = "50">
                                                    <thead>
                                                        <tr>
                                                            <th class="border-bottom-0">#</th>
                                                            <th class="border-bottom-0">اسم الملف</th>
                                                            <th class="border-bottom-0">قام بالإضافة</th>
                                                            <th class="border-bottom-0">تاريخ الإضافة</th>
                                                            <th class="border-bottom-0">العمليات</th>

                                                        </tr>
                                                    </thead>

                                                    <tbody>
                                                        @if ($invoice_attachments)
                                                        @foreach ($invoice_attachments as $invoice_attachment)
                                                        <tr>
                                                            <td>1</td>
                                                            <td>{{$invoice_attachment->file_name}}</td>
                                                            <td>{{$invoice_attachment->created_by}}</td>
                                                            <td>{{$invoice_attachment->created_at}}</td>
                                                            <td colspan="2">

                                                                <a class="btn btn-outline-success btn-sm"
                                                                    href="{{ url('View_file') }}/{{ $invoice->invoice_number }}/{{ $invoice_attachment->file_name }}"
                                                                    role="button"><i class="fas fa-eye"></i>&nbsp;
                                                                    عرض</a>

                                                                <a class="btn btn-outline-info btn-sm"
                                                                    href="{{ url('download') }}/{{ $invoice->invoice_number }}/{{ $invoice_attachment->file_name }}"
                                                                    role="button"><i
                                                                        class="fas fa-download"></i>&nbsp;
                                                                    تحميل</a>


                                                                    <button class="btn btn-outline-danger btn-sm"
                                                                        data-toggle="modal"
                                                                        data-file_name="{{ $invoice_attachment->file_name }}"
                                                                        data-invoice_number="{{ $invoice_attachment->invoice_number }}"
                                                                        data-id_file="{{ $invoice_attachment->id }}"
                                                                        data-target="#delete_file">حذف</button>


                                                            </td>



                                                        </tr>
                                                        @endforeach

                                                        @else
                                                        <tr>
                                                            <td>
                                                                لا توجد مرفقات لهذه الفاتورة
                                                            </td>

                                                        </tr>
                                                        @endif




                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>




				</div>
				<!-- row closed -->
			</div>
            <!-- delete -->
    <div class="modal fade" id="delete_file" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">حذف المرفق</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('delete_file') }}" method="post">

                {{ csrf_field() }}
                <div class="modal-body">
                    <p class="text-center">
                    <h6 style="color:red"> هل انت متاكد من عملية حذف المرفق ؟</h6>
                    </p>

                    <input type="hidden" name="id_file" id="id_file" value="">
                    <input type="hidden" name="file_name" id="file_name" value="">
                    <input type="hidden" name="invoice_number" id="invoice_number" value="">

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">الغاء</button>
                    <button type="submit" class="btn btn-danger">تاكيد</button>
                </div>
            </form>
        </div>
    </div>
</div>
</div>
			<!-- Container closed -->
		</div>
		<!-- main-content closed -->
@endsection
@section('js')
<!--Internal  Datepicker js -->
<script src="{{URL::asset('assets/plugins/jquery-ui/ui/widgets/datepicker.js')}}"></script>
<!-- Internal Select2 js-->
<script src="{{URL::asset('assets/plugins/select2/js/select2.min.js')}}"></script>
<!-- Internal Jquery.mCustomScrollbar js-->
<script src="{{URL::asset('assets/plugins/custom-scroll/jquery.mCustomScrollbar.concat.min.js')}}"></script>
<!-- Internal Input tags js-->
<script src="{{URL::asset('assets/plugins/inputtags/inputtags.js')}}"></script>
<!--- Tabs JS-->
<script src="{{URL::asset('assets/plugins/tabs/jquery.multipurpose_tabcontent.js')}}"></script>
<script src="{{URL::asset('assets/js/tabs.js')}}"></script>
<!--Internal  Clipboard js-->
<script src="{{URL::asset('assets/plugins/clipboard/clipboard.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/clipboard/clipboard.js')}}"></script>
<!-- Internal Prism js-->
<script src="{{URL::asset('assets/plugins/prism/prism.js')}}"></script>
<!-- Internal Data tables -->
<script src="{{URL::asset('assets/plugins/datatable/js/jquery.dataTables.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/dataTables.dataTables.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/dataTables.responsive.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/responsive.dataTables.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/jquery.dataTables.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/dataTables.bootstrap4.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/dataTables.buttons.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/buttons.bootstrap4.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/jszip.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/pdfmake.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/vfs_fonts.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/buttons.html5.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/buttons.print.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/buttons.colVis.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/dataTables.responsive.min.js')}}"></script>
<script src="{{URL::asset('assets/plugins/datatable/js/responsive.bootstrap4.min.js')}}"></script>
<!--Internal  Datatable js -->

<script>
    $('#delete_file').on('show.bs.modal', function(event) {
        var button = $(event.relatedTarget)
        var id_file = button.data('id_file')
        var file_name = button.data('file_name')
        var invoice_number = button.data('invoice_number')
        var modal = $(this)
        modal.find('.modal-body #id_file').val(id_file);
        modal.find('.modal-body #file_name').val(file_name);
        modal.find('.modal-body #invoice_number').val(invoice_number);
    })
</script>

<script>
    // Add the following code if you want the name of the file appear on select
    $(".custom-file-input").on("change", function() {
        var fileName = $(this).val().split("\\").pop();
        $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
    });
</script>
@endsection
