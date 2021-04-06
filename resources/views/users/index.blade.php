@extends('layouts.master')
@section('css')
<!-- Internal Data table css -->
<link href="{{URL::asset('assets/plugins/datatable/css/dataTables.bootstrap4.min.css')}}" rel="stylesheet" />
<link href="{{URL::asset('assets/plugins/datatable/css/buttons.bootstrap4.min.css')}}" rel="stylesheet">
<link href="{{URL::asset('assets/plugins/datatable/css/responsive.bootstrap4.min.css')}}" rel="stylesheet" />
<link href="{{URL::asset('assets/plugins/datatable/css/jquery.dataTables.min.css')}}" rel="stylesheet">
<link href="{{URL::asset('assets/plugins/datatable/css/responsive.dataTables.min.css')}}" rel="stylesheet">
<link href="{{URL::asset('assets/plugins/select2/css/select2.min.css')}}" rel="stylesheet">
@endsection
@section('title')
    المستخدمين
@endsection
@section('page-header')
				<!-- breadcrumb -->
				<div class="breadcrumb-header justify-content-between">
					<div class="my-auto">
						<div class="d-flex">
							<h4 class="content-title mb-0 my-auto">المستخدمين</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ قائمة المستخدمين</span>
						</div>
					</div>

				</div>
				<!-- breadcrumb -->
@endsection
@section('content')
<!-- main-content  -->
<div class="maincontent"></div>
<!-- Container  -->
            <div class="container"></div>
				<!-- row -->
				<div class="row">
                    <!--div-->
                    <div class="col-xl-12">
                        <div class="card mg-b-20">
                            <div class="card-header pb-0">
                                <a class="btn ripple btn-primary" href="#" class="fas fa-plus">&nbsp; إضافة مستخدم</a>


                            </div>

                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="example1" class="table key-buttons text-md-nowrap" data-page-length = "50">
                                        <thead>
                                            <tr>
                                                <th class="border-bottom-0">#</th>
                                                <th class="border-bottom-0">اسم المستخدم</th>
                                                <th class="border-bottom-0">البريد الإلكتروني</th>
                                                <th class="border-bottom-0">حالة المستخدم</th>
                                                <th class="border-bottom-0">نوع المستخدم</th>
                                                <th class="border-bottom-0">العمليات</th>
                                            </tr>
                                        </thead>

                                        <tbody>
                                            @php
                                                $i =1;
                                            @endphp
                                            @foreach ($data as $user)
                                                <tr>
                                                    <td>{{$i++}}</td>
                                                    <td>{{$user->name}}</td>
                                                    <td>{{$user->email}}</td>
                                                    <td></td>
                                                    <td></td>





                                                    <td>
                                                        <div class="dropdown">
                                                            <button aria-expanded="false" aria-haspopup="true" class="btn ripple btn-primary btn-sm" data-toggle="dropdown"
                                                            type="button">العمليات <i class="fas fa-caret-down ml-1"></i></button>
                                                            <div class="dropdown-menu tx-13">

                                                                    <a class="dropdown-item"
                                                                        href=" {{ url('edit_invoice') }}/{{ $user->id }}">تعديل
                                                                        الفاتورة</a>



                                                                    <a class="dropdown-item" href="#" data-invoice_id="{{ $user->id }}"
                                                                        data-toggle="modal" data-target="#delete_invoice"><i
                                                                            class="text-danger fas fa-trash-alt"></i>&nbsp;&nbsp;حذف
                                                                        الفاتورة</a>



                                                                    <a class="dropdown-item" href="status_show/{{$user->id}}"
                                                                        ><i
                                                                            class=" text-success fas
                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                fa-money-bill"></i>&nbsp;&nbsp;تغير
                                                                        حالة
                                                                        الدفع</a>



                                                                    <a class="dropdown-item" href="#" data-invoice_id="{{ $user->id }}"
                                                                        data-toggle="modal" data-target="#Transfer_invoice"><i
                                                                            class="text-warning fas fa-exchange-alt"></i>&nbsp;&nbsp;نقل الي
                                                                        الارشيف</a>



                                                                    <a class="dropdown-item" href="print_invoice/{{ $user->id }}"><i
                                                                            class="text-success fas fa-print"></i>&nbsp;&nbsp;طباعة
                                                                        الفاتورة
                                                                    </a>

                                                            </div>
                                                        </div>
                                                    </td>
                                                </tr>
                                            @endforeach

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--/div-->
				</div>
				<!-- row closed -->
			</div>
			<!-- Container closed -->
		</div>
		<!-- main-content closed -->
@endsection
@section('js')
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
<script src="{{URL::asset('assets/js/table-data.js')}}"></script>
@endsection
