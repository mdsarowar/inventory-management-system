@extends('admin.master')

@section('title',__('Store'))

@section('content')
    <div class="content">
        <div class="page-header">
            <div class="page-title">
                <h4>{{__('Store')}} {{__('List')}}</h4>
                <h6>{{__('Manage your')}} {{__('Store')}}</h6>
            </div>
            <div class="page-btn">
                <a href="{{ route('store.create')}}" class="btn btn-added">
                    <img src="{{asset('/')}}admin/assets/img/icons/plus.svg" alt="img" class="me-2">{{__('Add')}}</a>
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
                                    <input type="checkbox">
                                    <span class="checkmarks"></span>
                                </label>
                            </th>
                            <th>{{__('Name')}}</th>
                            <th>{{__('Address')}}</th>
                            <th>{{__('Company')}}</th>
                            <th>{{__('Code')}}</th>
                            <th>{{__('Mobile')}}</th>
                            <th>{{__('Incharge')}}</th>
                            <th>{{__('Status')}}</th>
                            <th>{{__('Action')}}</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($stores as $store)
                            <tr>
                                <td>
                                    <label class="checkboxs">
                                        <input type="checkbox">
                                        <span class="checkmarks"></span>
                                    </label>
                                </td>
                                <td>{{ $store->name }}</td>
{{--                                <td>{{ $store->page_header }}</td>--}}
                                <td>{{ $store->address }}</td>
{{--                                <td>{{ $store->email }}</td>--}}
{{--                                <td>{{ $store->phone }}</td>--}}
{{--                                <td>{{ $store->fax }}</td>--}}
                                <td>{{ $store->company->name }}</td>
                                <td>WH-00{{ $store->branch_code }}</td>
                                <td>{{ $store->mobile }}</td>
                                <td>{{ $store->user->name }}</td>
{{--                                <td>{{ $store->web }}</td>--}}
{{--                                <td>{{ $store->tin }}</td>--}}
{{--                                <td>{{ $store->vat }}</td>--}}
{{--                                <td>{{ $store->license }}</td>--}}
{{--                                <td class="productimgname">--}}
{{--                                    <a href="#" class="product-img">--}}
{{--                                        <img src="{{asset($store->logo)}}" alt="product">--}}
{{--                                    </a>--}}
{{--                                </td>--}}
                                <td>{{ $store->status == 1? 'Active':'Inactive' }}</td>
                                <td>
                                    @can('update branch')
                                        <a class="me-3" href="{{route('store.edit',$store->id)}}">
                                            <img src="{{asset('/')}}admin/assets/img/icons/edit.svg" alt="img">
                                        </a>
                                    @endcan
                                    @can('delete branch')
                                        <form action="{{route('store.destroy',$store->id)}}" method="POST" class="sr-dl">
                                            @csrf
                                            @method('delete')
                                            <a class="me-3 delete_confirm" href="javascript:void(0);">
                                                <img src="{{asset('/')}}admin/assets/img/icons/delete.svg" alt="img">
                                            </a>
                                        </form>
                                    @endcan
                                </td>
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

