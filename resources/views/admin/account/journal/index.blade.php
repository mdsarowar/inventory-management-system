@extends('admin.master')

@section('title','Account Journal')

@section('content')
    <div class="content">
        <div class="page-header">
            <div class="page-title">
                <h4>Journal List</h4>
                <h6>Manage Your Journal</h6>
            </div>
            <div class="page-btn">
                <a href="{{route('journal.create')}}" class="btn btn-added"><img src="{{asset('/')}}admin/assets/img/icons/plus.svg"  class="me-2" alt="img">Add Journal</a>
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
                            <th>#</th>
                            <th>Date</th>
                            <th>Invno</th>
                            <th>Amount</th>
                            <th>Note</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($journals as $journal)
                            <tr>
                                <td>
                                    <label class="checkboxs">
                                        <input type="checkbox">
                                        <span class="checkmarks"></span>
                                    </label>
                                </td>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ !empty($journal->date) ? \Carbon\Carbon::parse($journal->date)->format('d M Y') : '' }}</td>
                                <td>{{ $journal->inv_number }}</td>
                                <td>{{ $journal->amount }}</td>
                                <td>{{ Str::limit($journal->note, 80) }}</td>
                                <td>
                                    @can('update journal')
                                        <a class="me-3" href="{{route('journal.edit',$journal->id)}}">
                                            <img src="{{asset('/')}}admin/assets/img/icons/edit.svg" alt="img">
                                        </a>
                                    @endcan
                                    @can('delete journal')
                                        <form action="{{route('journal.destroy', $journal->id)}}" method="POST" class="sr-dl" >
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
        <!-- /journal list -->
    </div>
@endsection

@section('js')
{{--    @include('admin.include.plugin.datatable')--}}
@endsection
