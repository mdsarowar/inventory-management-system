@extends('admin.master')

@section('title','Create New Sub-Group')

@section('content')
    <div class="content">
        <div class="page-header">
            <div class="page-title">
                <h4>Sub-Group Add</h4>
                <h6>Create New Sub-Group</h6>
            </div>
        </div>
        <!-- /add -->
        <div class="card">
            <div class="card-body">
                <form action="{{route('sub_group.store')}}" method="post">
                    @csrf
                    <div class="row">
                        <div class="col-lg-4 col-sm-6 col-12">
                            <div class="form-group">
                                <label>Sub-Group Name</label>
                                <input type="text" name="name" required>
                            </div>
                        </div>
                        <div class="col-lg-4 col-sm-6 col-12">
                            <div class="form-group">
                                <label>Sub-Group Name (বাংলা)</label>
                                <input type="text" name="bname">
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <label>Description</label>
                                <textarea name="description"></textarea>
                            </div>
                        </div>
                        <div class="col-lg-4 col-sm-6 col-12">
                            <div class="form-group">
                                <label>Class</label>
                                <input type="hidden" name="class_id" id="class_id">
                                <input type="text" id="class_text" readonly>
                            </div>
                        </div>
                        <div class="col-lg-4 col-sm-6 col-12">
                            <div class="form-group">
                                <label>Select Group</label>
                                <select name="group_id" class="form-select" id="group_id">
                                    <option selected disabled>-- select one --</option>
                                    @forelse($groups as $group)
                                    <option value="{{ $group->id }}" data-class="{{ $group->class }}">{{ $group->name }}</option>
                                    @empty
                                    <option selected disabled>no group found</option>
                                    @endforelse
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-4"></div>
                        <div class="col-lg-3 col-sm-6 col-12">
                            <div class="form-group">
                                <label>Publisher</label>
                                <input type="text" value="{{ auth()->user()->name }}" readonly>
                                <input type="hidden" name="user_id" value="{{ auth()->user()->id }}" required>
                            </div>
                        </div>
                        <div class="col-lg-4 col-sm-6 col-12">
                            <div class="form-group">
                                <label>Select Branch</label>
                                <select name="branch_id" class="form-select">
                                    <option selected disabled>-- select one --</option>
                                    @forelse($branches as $branch)
                                    <option value="{{ $branch->id }}">{{ $branch->name }}</option>
                                    @empty
                                    <option selected disabled>no branch found</option>
                                    @endforelse
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-4 col-sm-6 col-12">
                            <div class="form-group">
                                <label>Select Compnay</label>
                                <select name="company_id" class="form-select">
                                    <option selected disabled>-- select one --</option>
                                    @forelse($companies as $company)
                                    <option value="{{ $company->id }}">{{ $company->name }}</option>
                                    @empty
                                    <option selected disabled>no company found</option>
                                    @endforelse
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <button type="submit" class="btn btn-submit me-2">Submit</button>
                            <a href="{{route('sub_group.index')}}" class="btn btn-cancel">Cancel</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <!-- /add -->
    </div>
@endsection
@section('js')
<script>
$(document).ready(function() {
    // jQuery: Selecting DOM elements
    let groupSelect = $('#group_id');
    let classInput = $('#class_id'); // Assuming these are IDs for hidden and visible inputs
    let classText = $('#class_text');

    // jQuery: Event listener for change on group select
    groupSelect.on('change', function() {
        // Get the selected option
        let selectedOption = groupSelect.find('option:selected');

        // Get the data-class attribute (which should be the JSON string)
        let jsonStr = selectedOption.attr('data-class');

        // Parse the JSON string into an object
        let json = JSON.parse(jsonStr);

        // Set the value of the hidden input field
        classInput.val(json.id);

        // Set the value of the visible input field (assuming it's for display purposes)
        classText.val(json.name);
    });
});
</script>
@endsection
