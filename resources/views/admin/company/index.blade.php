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
                <div class="table-top">
                    <div class="search-set">
                        <div class="search-path">
                            <a class="btn btn-filter" id="filter_search">
                                <img src="{{asset('/')}}admin/assets/img/icons/filter.svg" alt="img">
                                <span><img src="{{asset('/')}}admin/assets/img/icons/closes.svg" alt="img"></span>
                            </a>
                        </div>
                        <div class="search-input">
                            <a class="btn btn-searchset">
                                <img src="{{asset('/')}}admin/assets/img/icons/search-white.svg" alt="img">
                            </a>
                        </div>
                    </div>
                    <div class="wordset">
                        <ul>
                            <li>
                                <a data-bs-toggle="tooltip" data-bs-placement="top" title="pdf"><img
                                        src="{{asset('/')}}admin/assets/img/icons/pdf.svg" alt="img"></a>
                            </li>
                            <li>
                                <a data-bs-toggle="tooltip" data-bs-placement="top" title="excel"><img
                                        src="{{asset('/')}}admin/assets/img/icons/excel.svg" alt="img"></a>
                            </li>
                            <li>
                                <a data-bs-toggle="tooltip" data-bs-placement="top" title="print"><img
                                        src="{{asset('/')}}admin/assets/img/icons/printer.svg" alt="img"></a>
                            </li>
                        </ul>
                    </div>
                </div>
                <!-- /Filter -->
                {{--                <div class="card" id="filter_inputs">--}}
                {{--                    <div class="card-body pb-0">--}}
                {{--                        <div class="row">--}}
                {{--                            <div class="col-lg-2 col-sm-6 col-12">--}}
                {{--                                <div class="form-group">--}}
                {{--                                    <input type="text" placeholder="Enter User Name">--}}
                {{--                                </div>--}}
                {{--                            </div>--}}
                {{--                            <div class="col-lg-2 col-sm-6 col-12">--}}
                {{--                                <div class="form-group">--}}
                {{--                                    <input type="text" placeholder="Enter Phone">--}}
                {{--                                </div>--}}
                {{--                            </div>--}}
                {{--                            <div class="col-lg-2 col-sm-6 col-12">--}}
                {{--                                <div class="form-group">--}}
                {{--                                    <input type="text" placeholder="Enter Email">--}}
                {{--                                </div>--}}
                {{--                            </div>--}}
                {{--                            <div class="col-lg-2 col-sm-6 col-12">--}}
                {{--                                <div class="form-group">--}}
                {{--                                    <select class="select">--}}
                {{--                                        <option>Disable</option>--}}
                {{--                                        <option>Enable</option>--}}
                {{--                                    </select>--}}
                {{--                                </div>--}}
                {{--                            </div>--}}
                {{--                            <div class="col-lg-1 col-sm-6 col-12 ms-auto">--}}
                {{--                                <div class="form-group">--}}
                {{--                                    <a class="btn btn-filters ms-auto"><img--}}
                {{--                                            src="{{asset('/')}}admin/assets/img/icons/search-whites.svg" alt="img"></a>--}}
                {{--                                </div>--}}
                {{--                            </div>--}}
                {{--                        </div>--}}
                {{--                    </div>--}}
                {{--                </div>--}}
                <!-- /Filter -->
                <div class="table-responsive">
                    <table class="table  datanew">
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
