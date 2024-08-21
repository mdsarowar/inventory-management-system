@extends('admin.master')

@section('title',__('Company'))

@section('content')
    <div class="content">
        <div class="page-header">
            <div class="page-title">
                <h4>{{__('Company')}} {{__('List')}}</h4>
                <h6>{{__('Manage your')}} {{__('Company')}}</h6>
            </div>
            <div class="page-btn">
                <a href="{{ route('company.create')}}" class="btn btn-added">
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
                            <th>{{__('Mobile')}}</th>
                            <th>{{__('Web')}}</th>
                            <th>{{__('Tin')}}</th>
                            <th>{{__('Vat')}}</th>
                            <th>{{__('License')}}</th>
                            <th>{{__('Logo')}}</th>
                            <th>{{__('License Image')}}</th>
                            <th>{{__('Tin Image')}}</th>
                            <th>{{__('Status')}}</th>
                            <th>{{__('Action')}}</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($companies as $company)
                            <tr>
                                <td>
                                    <label class="checkboxs">
                                        <input type="checkbox">
                                        <span class="checkmarks"></span>
                                    </label>
                                </td>
                                <td>{{ $company->name }}</td>
                                <td>{{ $company->page_header }}</td>
                                <td>{{ $company->address }}</td>
                                <td>{{ $company->email }}</td>
                                <td>{{ $company->phone }}</td>
                                <td>{{ $company->fax }}</td>
                                <td>{{ $company->mobile }}</td>
                                <td>{{ $company->web }}</td>
                                <td>{{ $company->tin }}</td>
                                <td>{{ $company->vat }}</td>
                                <td>{{ $company->license }}</td>
                                <td class="productimgname">
                                    <a href="#" class="product-img">
                                        <img src="{{asset($company->logo)}}" alt="product">
                                    </a>
                                </td>
                                <td class="productimgname1">
                                    <a href="#" class="product-img">
                                        <img src="{{asset($company->license_image)}}" alt="product">
                                    </a>
                                </td>
                                <td class="productimgname2">
                                    <a href="#" class="product-img">
                                        <img src="{{asset($company->tin_image)}}" alt="product">
                                    </a>
                                </td>
                                <td>{{ $company->status == 1? 'Active':'Inactive' }}</td>
                                <td>
                                    @can('update user')
                                        <a class="me-3" href="{{route('company.edit',$company->id)}}">
                                            <img src="{{asset('/')}}admin/assets/img/icons/edit.svg" alt="img">
                                        </a>
                                    @endcan
                                    @can('delete user')
                                        <form action="{{route('company.destroy',$company->id)}}" method="POST"
                                              class="sr-dl">
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
                    {{--                    {{ $companies->links() }}--}}
                </div>
            </div>
        </div>
        <!-- /product list -->
    </div>

@endsection

@section('js')
    {{--    @include('admin.include.plugin.datatable')--}}
@endsection
