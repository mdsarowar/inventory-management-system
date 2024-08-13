@extends('admin.master')

@section('title','Create New Ledger')

@section('content')
    <div class="content">
        <div class="page-header">
            <div class="page-title">
                <h4>Ledger Add</h4>
                <h6>Create New Ledger</h6>
            </div>
        </div>
        <!-- /add -->
        <div class="card">
            <div class="card-body">
                <form action="{{route('ledger.store')}}" method="post">
                    @csrf
                    <div class="row">
                        <div class="col-lg-4 col-sm-6 col-12">
                            <div class="form-group">
                                <label>Ledger Name</label>
                                <input type="text" name="name" placeholder="e.g. Petty Cash" required>
                            </div>
                            <div class="form-group">
                                <label>Ledger Name (বাংলা)</label>
                                <input type="text" name="bname">
                            </div>
                        </div>
                        <div class="col-lg-8 col-sm-6 col-12">
                            <div class="form-group">
                                <label>Description</label>
                                <textarea name="description" rows="5" style="height: 135px"></textarea>
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
                        <div class="col-lg-4 col-sm-6 col-12">
                            <div class="form-group">
                                <label>Select Sub-Group</label>
                                <select name="subgroup_id" class="form-select" id="sub_group_id">
                                    <option selected disabled>-- select one --</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-4 col-sm-6 col-12">
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
                            <a href="{{route('group.index')}}" class="btn btn-cancel">Cancel</a>
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
    let subGroupSelect = $('#sub_group_id');

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

    // jQuery: Second event listener for change on group select
    groupSelect.on('change', function() {
        let groupId = $(this).val(); // Get the ID of the selected group

        // Clear existing options in sub-group select
        subGroupSelect.empty();

        // Create and append default option "-- select one --"
        let defaultOption = $('<option selected disabled>-- select one --</option>');
        subGroupSelect.append(defaultOption);

        // PHP Blade syntax integrated to dynamically populate sub-group options
        @foreach($sub_groups as $sub_group)
            // Check if sub-group belongs to the selected group
            if ({{ $sub_group->group_id }} == groupId) {
                let option = $('<option></option>');
                option.val('{{ $sub_group->id }}'); // Set option value
                option.attr('data-class', '{{ $sub_group->class }}'); // Set data-class attribute
                option.text('{{ $sub_group->name }}'); // Set option text
                subGroupSelect.append(option); // Append option to sub-group select
            }
        @endforeach
    });
});
</script>
@endsection
