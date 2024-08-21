@extends('admin.master')

@section('title',__('Purchase'))

@section('content')
    <div class="content">
        <div class="page-header">
            <div class="page-title">
                <h4>{{__('Purchase')}} {{__('List')}}</h4>
                <h6>{{__('Manage your')}} {{__('Purchase')}}</h6>
            </div>
            <div class="page-btn">
                <a href="{{route('purchasOrderCreate')}}" class="btn btn-added"><img src="{{asset('/')}}admin/assets/img/icons/plus.svg" alt="img" class="me-1">{{__('Purchase Create')}}</a>
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
                        @foreach($purchases as $purchas)
                            <tr>
                                <td>
                                    <label class="checkboxs">
                                        <input type="checkbox">
                                        <span class="checkmarks"></span>
                                    </label>
                                </td>
                                <td>{{$purchas->issue_date}}</td>
{{--                                <td>SMCE</td>--}}
{{--                                <td>{{$purchas->vendor}}</td>--}}
                                @if(empty($purchas->wkname))
                                    @php
                                        $sup = explode("-", $purchas->vendor);
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
{{--                                @elseif($purchas->vendor_type == 'cus')--}}
{{--                                    @php--}}
{{--                                        $name=\App\Models\Customer::find($purchas->vendor)--}}
{{--                                     @endphp--}}
{{--                                    <td>{{$name->name}}</td>--}}
{{--                                @elseif($purchas->vendor_type == 'sup')--}}
{{--                                    @php--}}
{{--                                        $name=\App\Models\Supplier::find($purchas->vendor)--}}
{{--                                    @endphp--}}
{{--                                    <td>{{$name->name}}</td>--}}
                                @else
                                    <td>{{$purchas->wkname}}</td>
                                @endif
{{--                                <td>{{$purchas->vendor_type == 'other'? $purchas->vendor:($purchas->vendor_type == 'cus'?$purchas->Customer->vendor:$purchas->Supplier->vendor)}}</td>--}}
                                <td>{{$purchas->wkphone}}</td>

                                <td>{{$purchas->total}}</td>
                                <td>{{$purchas->total - $purchas->due}}</td>
                                <td>{{$purchas->due}}</td>
                                <td><span class="{{ $purchas->status == 0? 'badges bg-lightred':($purchas->status == 1?'badges bg-lightgreen':'badges bg-lightyellow') }}">{{ $purchas->status == 0? 'Pending':($purchas->status == 1?'Received':'Ordered') }}</span></td>
                                <td><span class="{{$purchas->invoice->status == 'paid'?'badges bg-lightgreen':($purchas->invoice->status == 'unpaid'?'badges bg-lightred':'badges bg-lightyellow')}}">{{$purchas->invoice->status}}</span></td>
                                <td>

                                    @can('update purchase')
                                        <a class="me-3" href="{{route('purchases.show',$purchas->id)}}">
                                            <i class="fa fa-eye" data-bs-toggle="tooltip" title="Return Product"></i>
                                        </a>
                                    @endcan
                                    @can('update purchase')
                                        <a class="me-3" href="{{route('purchas_return',$purchas->id)}}">
                                            <i class="fa fa-share" data-bs-toggle="tooltip" title="Return Product"></i>
                                        </a>
                                    @endcan
                                    @can('update purchase')
                                        <a class="me-3" href="{{route('purchases.edit',$purchas->id)}}">
                                            <img src="{{asset('/')}}admin/assets/img/icons/edit.svg" alt="img">
                                        </a>
                                    @endcan
                                    @can('delete purchase')
                                        <form action="{{route('purchases.destroy',$purchas->id)}}" method="POST" class="sr-dl" >
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
                                {{--                                        <form action="{{route('product.destroy',$purchas->id)}}" method="POST" class="sr-dl" >--}}
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


