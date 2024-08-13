@extends('admin.master')

@section('title','Ledger Edit')

@section('content')
    <div class="content">
        <div class="page-header">
            <div class="page-title">
                <h4>Ledger Edit</h4>
                <h6>Update Ledger</h6>
            </div>
        </div>
        <!-- /edit -->
        <div class="card">
            <div class="card-body">
                <form action="{{route('ledger.update',$ledger->id)}}" method="post">
                    @csrf
                    @method('put')
                    <div class="row">
                        <div class="col-lg-4 col-sm-6 col-12">
                            <div class="form-group">
                                <label>Ledger Name</label>
                                <input type="text" name="name" value="{{ $ledger->name }}" required>
                            </div>
                            <div class="form-group">
                                <label>Ledger Name (বাংলা)</label>
                                <input type="text" name="bname" value="{{ $ledger->bname }}">
                            </div>
                        </div>
                        <div class="col-lg-8 col-sm-6 col-12">
                            <div class="form-group">
                                <label>Description</label>
                                <textarea name="description" rows="5" style="height: 135px">{{ $ledger->description }}</textarea>
                            </div>
                        </div>
                        <div class="col-lg-4 col-sm-6 col-12">
                            <div class="form-group">
                                <label>Class</label>
                                <input type="hidden" name="class_id" id="class_id">
                                <input type="text" id="class_text" value="{{ $ledger->class_id ? $ledger->class->name : '' }}" readonly>
                            </div>
                        </div>
                        <div class="col-lg-4 col-sm-6 col-12">
                            <div class="form-group">
                                <label>Select Group</label>
                                <select name="group_id" class="form-select" id="group_id">
                                    <option selected disabled>-- select one --</option>
                                    @if($ledger->group_id)
                                        @foreach($groups as $group)
                                            <option value="{{ $group->id }}" data-class="{{ $group->class }}" {{ $ledger->group_id == $group->id ? 'selected' : '' }}>{{ $group->name }}</option>
                                        @endforeach
                                    @else
                                        <option selected disabled>-- select one --</option>
                                        @foreach($groups as $group)
                                            <option value="{{ $group->id }}">{{ $group->name }}</option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-4 col-sm-6 col-12">
                            <div class="form-group">
                                <label>Select Sub-Group</label>
                                <select name="subgroup_id" class="form-select" id="sub_group_id">
                                    @if($ledger->subgroup_id)
                                        @foreach($sub_groups as $sub_group)
                                            @if($sub_group->group_id == $ledger->group_id)
                                                <option value="{{ $sub_group->id }}" {{ $ledger->subgroup_id == $sub_group->id ? 'selected' : '' }}>{{ $sub_group->name }}</option>
                                            @endif
                                        @endforeach
                                    @else
                                        <option selected disabled>-- select one --</option>
                                        @foreach($sub_groups as $sub_group)
                                            <option value="{{ $sub_group->id }}">{{ $sub_group->name }}</option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-4 col-sm-6 col-12">
                            <div class="form-group">
                                <label>Publisher</label>
                                <input type="text" value="{{ $ledger->user->name }}" readonly>
                                <input type="hidden" name="user_id" value="{{ $ledger->user->id }}" required>
                            </div>
                        </div>
                        <div class="col-lg-4 col-sm-6 col-12">
                            <div class="form-group">
                                <label>Select Branch</label>
                                <select name="branch_id" class="form-select">
                                    @if($ledger->branch_id)
                                        @foreach($branches as $branch)
                                            <option value="{{ $branch->id }}" {{ $ledger->branch_id == $branch->id ? 'selected' : '' }}>{{ $branch->name }}</option>
                                        @endforeach
                                    @else
                                        <option selected disabled>-- select one --</option>
                                        @foreach($branches as $branch)
                                            <option value="{{ $branch->id }}">{{ $branch->name }}</option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-4 col-sm-6 col-12">
                            <div class="form-group">
                                <label>Select Compnay</label>
                                <select name="company_id" class="form-select">
                                    @if($ledger->company_id)
                                        @foreach($companies as $company)
                                            <option value="{{ $company->id }}" {{ $ledger->branch_id == $branch->id ? 'selected' : '' }}>{{ $company->name }}</option>
                                        @endforeach
                                    @else
                                        <option selected disabled>-- select one --</option>
                                        @foreach($companies as $company)
                                            <option value="{{ $company->id }}">{{ $company->name }}</option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <button type="submit" class="btn btn-submit me-2">Submit</button>
                            <a href="{{route('ledger.index')}}" class="btn btn-cancel">Cancel</a>
                        </div>
                    </div>

                </form>
            </div>
        </div>
        <!-- /edit -->
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
