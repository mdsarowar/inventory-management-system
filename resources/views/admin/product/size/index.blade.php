@extends('admin.master')

@section('title','Size')

@section('content')
    <div class="content">
        <div class="page-header">
            <div class="page-title">
                <h4>Size List</h4>
                <h6>Manage your Sizes</h6>
            </div>
            <div class="page-btn">
                <a href="{{route('size.create')}}" class="btn btn-added"><img src="{{asset('/')}}admin/assets/img/icons/plus.svg"  class="me-2" alt="img">Add Size</a>
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
                            <a class="btn btn-searchset"><img src="{{asset('/')}}admin/assets/img/icons/search-white.svg" alt="img"></a>
                        </div>
                    </div>
                    <div class="wordset">
                        <ul>
                            <li>
                                <a data-bs-toggle="tooltip" data-bs-placement="top" title="pdf"><img src="{{asset('/')}}admin/assets/img/icons/pdf.svg" alt="img"></a>
                            </li>
                            <li>
                                <a data-bs-toggle="tooltip" data-bs-placement="top" title="excel"><img src="{{asset('/')}}admin/assets/img/icons/excel.svg" alt="img"></a>
                            </li>
                            <li>
                                <a data-bs-toggle="tooltip" data-bs-placement="top" title="print"><img src="{{asset('/')}}admin/assets/img/icons/printer.svg" alt="img"></a>
                            </li>
                        </ul>
                    </div>
                </div>
                <!-- /Filter -->
                <div class="card" id="filter_inputs">
                    <div class="card-body pb-0">
                        <div class="row">
                            <div class="col-lg-3 col-sm-6 col-12">
                                <div class="form-group">
                                    <input type="text" placeholder="Enter size Name">
                                </div>
                            </div>
                            <div class="col-lg-3 col-sm-6 col-12">
                                <div class="form-group">
                                    <input type="text" placeholder="Enter size Symbol">
                                </div>
                            </div>
                            <div class="col-lg-1 col-sm-6 col-12 ms-auto">
                                <div class="form-group">
                                    <a class="btn btn-filters ms-auto"><img src="{{asset('/')}}admin/assets/img/icons/search-whites.svg" alt="img"></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /Filter -->
                <div class="table-responsive">
                    <table class="table datanew">
                        <thead>
                        <tr>
                            <th>
                                <label class="checkboxs">
                                    <input type="checkbox" id="select-all">
                                    <span class="checkmarks"></span>
                                </label>
                            </th>
                            <th>Name</th>
                            <th>বাংলা</th>
                            <th>Symbol</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($sizes as $size)
                            <tr>
                                <td>
                                    <label class="checkboxs">
                                        <input type="checkbox">
                                        <span class="checkmarks"></span>
                                    </label>
                                </td>
                                <td>{{$size->name}}</td>
                                <td>{!! $size->bname !!}</td>
                                <td>{!! $size->symbol !!}</td>
                                <td>{{ $size->status == 1? 'Active':'Inactive' }}</td>
                                <td>
                                    @can('update size')
                                        <a class="me-3" href="{{route('size.edit',$size->id)}}">
                                            <img src="{{asset('/')}}admin/assets/img/icons/edit.svg" alt="img">
                                        </a>
                                    @endcan
                                    @can('delete size')
                                        <form action="{{route('size.destroy',$size->id)}}" method="POST" class="sr-dl" >
                                            @csrf
                                            @method('delete')
                                            <a class="delete_confirm" href="javascript:void(0);">
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


