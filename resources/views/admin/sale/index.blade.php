@extends('admin.master')

@section('title',__('Sales'))

@section('content')
    <div class="content">
        <div class="page-header">
            <div class="page-title">
                <h4>{{__('Sales')}} {{__('List')}}</h4>
                <h6>{{__('Manage your')}} {{__('Sales')}}</h6>
            </div>
            <div class="page-btn">
                <a href="{{route('sales.create')}}" class="btn btn-added"><img src="{{asset('/')}}admin/assets/img/icons/plus.svg" alt="img" class="me-1">{{__('Sales Create')}}</a>
            </div>
        </div>


        <!-- /product list -->
        <div class="card">
            <div class="card-body">

                <div class="table-responsive">
                    <table class="table datatable">
                        <thead>
                        <tr>
                            <th>
                                <label class="checkboxs">
                                    <input type="checkbox" id="select-all">
                                    <span class="checkmarks"></span>
                                </label>
                            </th>
                            <th>{{__('Date')}}</th>
                            {{--                            <th>{{__('Branch')}}</th>--}}
                            <th>{{__('Supplier')}}</th>
                            <th>{{__('Walk Supplier')}}</th>
                            <th>{{__('Total Amount')}}</th>
                            <th>{{__('Paid Amount')}}</th>
                            <th>{{__('Payment Due')}}</th>
                            <th>{{__('Status')}}</th>
                            <th>{{__('Payment Status')}}</th>
                            <th>{{__('Action')}}</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($sales as $sale)
                            <tr>
                                <td>
                                    <label class="checkboxs">
                                        <input type="checkbox">
                                        <span class="checkmarks"></span>
                                    </label>
                                </td>
                                <td>{{$sale->issue_date}}</td>
                                {{--                                <td>SMCE</td>--}}
                                {{--                                <td>{{$sale->vendor}}</td>--}}
                                @if(empty($sale->wkname))
                                    @php
                                        $sup = explode("-", $sale->vendor);
                                               if (isset($sup[1])) {
                                                    if ($sup[0] == 'sup') {
                                                        $name = \App\Models\Supplier::find($sup[1]);
                                                    } else {
                                                        $name = \App\Models\Customer::find($sup[1]);
                                                    }
                                                } else {
                                                    $name = null;
                                                }
                                    @endphp
                                    <td>{{ $name ? $name->name : 'Unknown' }}</td>
                                    {{--                                @elseif($sale->vendor_type == 'cus')--}}
                                    {{--                                    @php--}}
                                    {{--                                        $name=\App\Models\Customer::find($sale->vendor)--}}
                                    {{--                                     @endphp--}}
                                    {{--                                    <td>{{$name->name}}</td>--}}
                                    {{--                                @elseif($sale->vendor_type == 'sup')--}}
                                    {{--                                    @php--}}
                                    {{--                                        $name=\App\Models\Supplier::find($sale->vendor)--}}
                                    {{--                                    @endphp--}}
                                    {{--                                    <td>{{$name->name}}</td>--}}
                                @else
                                    <td>{{$sale->wkname}}</td>
                                @endif
                                {{--                                <td>{{$sale->vendor_type == 'other'? $sale->vendor:($sale->vendor_type == 'cus'?$sale->Customer->vendor:$sale->Supplier->vendor)}}</td>--}}
                                <td>{{$sale->wkphone}}</td>

                                <td>{{$sale->total}}</td>
                                <td>{{$sale->total - $sale->due}}</td>
                                <td>{{$sale->due}}</td>
                                <td><span class="{{ $sale->status == 0? 'badges bg-lightred':($sale->status == 1?'badges bg-lightgreen':'badges bg-lightyellow') }}">{{ $sale->status == 0? 'Pending':($sale->status == 1?'Received':'Ordered') }}</span></td>
                                <td><span class="{{$sale->invoice->status == 'paid'?'badges bg-lightgreen':($sale->invoice->status == 'unpaid'?'badges bg-lightred':'badges bg-lightyellow')}}">{{$sale->invoice->status}}</span></td>
                                <td>

                                    @can('update purchase')
                                        <a class="me-3" href="{{route('sales.show',$sale->id)}}">
                                            <i class="fa fa-eye" data-bs-toggle="tooltip" title="Return Product"></i>
                                        </a>
                                    @endcan
{{--                                    @can('update purchase')--}}
{{--                                        <a class="me-3" href="{{route('purchas_return',$sale->id)}}">--}}
{{--                                            <i class="fa fa-share" data-bs-toggle="tooltip" title="Return Product"></i>--}}
{{--                                        </a>--}}
{{--                                    @endcan--}}
                                    @can('edit purchase')
                                        <a class="me-3" href="{{route('sales.edit',$sale->id)}}">
                                            <img src="{{asset('/')}}admin/assets/img/icons/edit.svg" alt="img">
                                        </a>
                                    @endcan
                                    {{--                                    @can('view product')--}}
                                    {{--                                        <a class="me-3" href="{{route('product.show',$sale->id)}}">--}}
                                    {{--                                            <img src="{{asset('/')}}admin/assets/img/icons/eye.svg" alt="img">--}}
                                    {{--                                        </a>--}}
                                    {{--                                    @endcan--}}
                                    @can('delete purchase')
                                        <form action="{{route('sales.destroy',$sale->id)}}" method="POST" class="sr-dl" >
                                            @csrf
                                            @method('delete')
                                            <a class="delete_confirm" href="javascript:void(0);">
                                                <img src="{{asset('/')}}admin/assets/img/icons/delete.svg" alt="img">
                                            </a>
                                        </form>
                                    @endcan
                                </td>
                                {{--                                <td>--}}
                                {{--                                    <a class="me-3" href="product-details.html">--}}
                                {{--                                        <img src="{{asset('/')}}admin/assets/img/icons/eye.svg" alt="img">--}}
                                {{--                                    </a>--}}
                                {{--                                    <a class="me-3" href="editproduct.html">--}}
                                {{--                                        <img src="{{asset('/')}}admin/assets/img/icons/edit.svg" alt="img">--}}
                                {{--                                    </a>--}}
                                {{--                                    @can('delete brand')--}}
                                {{--                                        <form action="{{route('product.destroy',$sale->id)}}" method="POST" class="sr-dl" >--}}
                                {{--                                            @csrf--}}
                                {{--                                            @method('delete')--}}
                                {{--                                            <a class="delete_confirm" href="javascript:void(0);">--}}
                                {{--                                                <img src="{{asset('/')}}admin/assets/img/icons/delete.svg" alt="img">--}}
                                {{--                                            </a>--}}
                                {{--                                        </form>--}}
                                {{--                                    @endcan--}}
                                {{--                                </td>--}}
                            </tr>
                        @endforeach

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <!-- /product list -->
    </div>
@endsection


