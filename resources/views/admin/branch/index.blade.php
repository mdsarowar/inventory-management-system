@extends('admin.master')

@section('title',__('Branch'))

@section('content')
    <div class="content">
        <div class="page-header">
            <div class="page-title">
                <h4>{{__('Branch')}} {{__('List')}}</h4>
                <h6>{{__('Manage your')}} {{__('Branch')}}</h6>
            </div>
            <div class="page-btn">
                <a href="{{ route('branch.create')}}" class="btn btn-added">
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
                            <th>{{__('Page Header')}}</th>
                            <th>{{__('Address')}}</th>
                            <th>{{__('Email')}}</th>
                            <th>{{__('Phone')}}</th>
                            <th>{{__('Fax')}}</th>
                            <th>{{__('Company')}}</th>
                            <th>{{__('Branch Code')}}</th>
                            <th>{{__('Mobile')}}</th>
{{--                            <th>web</th>--}}
{{--                            <th>tin</th>--}}
{{--                            <th>vat</th>--}}
{{--                            <th>license</th>--}}
                            <th>{{__('Logo')}}</th>
                            <th>{{__('Status')}}</th>
                            <th>{{__('Action')}}</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($branches as $branch)
                            <tr>
                                <td>
                                    <label class="checkboxs">
                                        <input type="checkbox">
                                        <span class="checkmarks"></span>
                                    </label>
                                </td>
                                <td>{{ $branch->name }}</td>
                                <td>{{ $branch->page_header }}</td>
                                <td>{{ $branch->address }}</td>
                                <td>{{ $branch->email }}</td>
                                <td>{{ $branch->phone }}</td>
                                <td>{{ $branch->fax }}</td>
                                <td>{{ $branch->company->name }}</td>
                                <td>BR-00{{ $branch->branch_code }}</td>
                                <td>{{ $branch->mobile }}</td>
{{--                                <td>{{ $branch->web }}</td>--}}
{{--                                <td>{{ $branch->tin }}</td>--}}
{{--                                <td>{{ $branch->vat }}</td>--}}
{{--                                <td>{{ $branch->license }}</td>--}}
                                <td class="productimgname">
                                    <a href="#" class="product-img">
                                        <img src="{{asset($branch->logo)}}" alt="product">
                                    </a>
                                </td>
                                <td>{{ $branch->status == 1? 'Active':'Inactive' }}</td>
                                <td>
                                    @can('update branch')
                                        <a class="me-3" href="{{route('branch.edit',$branch->id)}}">
                                            <img src="{{asset('/')}}admin/assets/img/icons/edit.svg" alt="img">
                                        </a>
                                    @endcan
                                    @can('delete branch')
                                        <form action="{{route('branch.destroy',$branch->id)}}" method="POST" class="sr-dl">
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
                    <!-- Pagination Links -->
{{--                    {{ $branches->links() }}--}}
                </div>
            </div>
        </div>
        <!-- /product list -->
    </div>

@endsection

@section('js')

@endsection
