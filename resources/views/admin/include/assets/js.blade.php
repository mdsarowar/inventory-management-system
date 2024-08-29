<!-- jQuery -->
<script src="{{asset('/')}}admin/assets/js/jquery-3.6.0.min.js"></script>

<!-- Summernote JS -->
<script src="{{asset('/')}}admin/assets/plugins/summernote/summernote-bs4.min.js"></script>


<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.8/js/select2.min.js" defer></script>

<!-- Feather Icon JS -->
<script src="{{asset('/')}}admin/assets/js/feather.min.js"></script>

<!-- Slimscroll JS -->
<script src="{{asset('/')}}admin/assets/js/jquery.slimscroll.min.js"></script>

<!-- Select2 JS -->
{{--<script src="{{asset('/')}}admin/assets/plugins/select2/js/select2.min.js"></script>--}}
{{--<script src="{{asset('/')}}admin/assets/plugins/select2/js/custom-select.js"></script>--}}

<!-- Owl JS -->
<script src="{{asset('/')}}admin/assets/plugins/owlcarousel/owl.carousel.min.js"></script>


<!-- Datatable JS -->
<script src="{{asset('/')}}admin/assets/js/jquery.dataTables.min.js"></script>
<script src="{{asset('/')}}admin/assets/js/dataTables.bootstrap4.min.js"></script>

{{--<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>--}}
{{--<script src="https://cdn.datatables.net/v/bs5/dt-2.0.8/datatables.min.js"></script>--}}
{{--<script src="https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.21/js/jquery.dataTables.min.js" integrity="sha512-BkpSL20WETFylMrcirBahHfSnY++H2O1W+UnEEO4yNIl+jI2+zowyoGJpbtk6bx97fBXf++WJHSSK2MV4ghPcg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>--}}

<!-- Bootstrap Core JS -->
<script src="{{asset('/')}}admin/assets/js/bootstrap.bundle.min.js"></script>
{{--<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>--}}

<!-- Chart JS -->
<script src="{{asset('/')}}admin/assets/plugins/apexchart/apexcharts.min.js"></script>
<script src="{{asset('/')}}admin/assets/plugins/apexchart/chart-data.js"></script>


<!-- Toastr Cdn -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js" integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<!-- sweet alert -->
{{--<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>--}}
<script src="{{asset('/')}}admin/assets/plugins/sweetalert/sweetalert2.all.min.js"></script>
<script src="{{asset('/')}}admin/assets/plugins/sweetalert/sweetalerts.min.js"></script>



<!-- DataTables JS -->
<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>

<!-- DataTables Buttons JS -->
<script src="https://cdn.datatables.net/buttons/2.3.6/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.3.6/js/buttons.html5.min.js"></script>

<!-- JSZip for Excel export -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>

<!-- PDFMake for PDF export -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js"></script>
<!-- Datatable JS -->


<!-- Fileupload JS -->
<script src="{{('/')}}admin/assets/plugins/fileupload/fileupload.min.js"></script>

<!-- Slimscroll JS -->
<script src="{{('/')}}admin/assets/js/jquery.slimscroll.min.js"></script>


<!-- Custom JS -->
<script src="{{asset('/')}}admin/assets/js/script.js"></script>

<script>
    $(document).ready(function() {
        $('#summernote2').summernote({
            height: 200,   // set the height of the editor
        });
        $('#summernote1').summernote({
            height: 200,   // set the height of the editor
        });
    });
</script>

<script>
    @if(Session::has('success'))
        // toastr.options.timeOut = 10000;
    toastr.success("{{ Session::get('success') }}");
    @endif
    @if(Session::has('error'))
        // toastr.options.timeOut = 10000;
    toastr.error("{{ Session::get('error') }}");
    @endif
    @if(Session::has('wrn'))
        // toastr.options.timeOut = 10000;
    toastr.warning("{{ Session::get('wrn') }}");
    @endif
    @if(Session::has('info'))
        // toastr.options.timeOut = 10000;
    toastr.info("{{ Session::get('info') }}");
    @endif
</script>

<script>
    @if(Session::has('swl'))
    Swal.fire("{{ Session::get('swl') }}");
    @endif
</script>
{{--@if(\Illuminate\Support\Facades\Session::has('success'))--}}
{{--    <script>--}}
{{--        toastr.options.timeOut = 10000;--}}
{{--        toastr.success("{{ Session::get('message') }}");--}}
{{--        --}}{{--toastr.success("{{Session::get('success')}}")--}}
{{--    </script>--}}
{{--@endif--}}

<script type="text/javascript">
    $(".delete_confirm").on("click", function () {
        var form =  $(this).closest("form");
        event.preventDefault();
        Swal.fire({
            title: "Are you sure?",
            text: "You won't be able to revert this!",
            type: "warning",
            showCancelButton: !0,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Yes, delete it!",
            confirmButtonClass: "btn btn-primary",
            cancelButtonClass: "btn btn-danger ml-1",
            buttonsStyling: !1,
        }).then(function (t) {
            if (t.value == true) {
                form.submit();
            }
        });
    });
</script>

<script>
    var base_url = window.location.origin;
</script>

<script>
    $(document).ready(function(){
        // console.log('sarowar');
        $('#selectlang a').click(function (e){
            e.preventDefault();
            var val=$(this).attr('val');
            $('#selectlang a').removeClass('active');
            $(this).addClass('active');
            $.ajax({
                url:base_url+'/change_lang/'+val,
                type:'get',
                success:function (){
                    // console.log('sar');
                    location.reload();
                }

            });
            // alert(val);
        });
    });
</script>

<script>
    $(document).ready(function() {
        $('#bank_type').select2();
        $('#product_search').select2();
        $('.select2').select2();
    });
</script>
<!-- end Select2 JS -->


<!-- Datatable JS -->
<style>
    .dataTables_paginate {
        margin-top: 10px; /* Space above pagination controls */
        text-align: right; /* Align controls to the right */
    }

    .dataTables_paginate .paginate_button {
        padding: 5px 10px;
        margin: 0 2px;
        border: 1px solid #ddd;
        border-radius: 4px;
        background-color: #f9f9f9;
        color: #333;
        cursor: pointer;
    }

    .dataTables_paginate .paginate_button.current {
        background-color: #007bff;
        color: white;
        border: 1px solid #007bff;
    }

    .dataTables_paginate .paginate_button:hover {
        background-color: #ddd;
    }

    .dataTables_paginate .paginate_button.previous,
    .dataTables_paginate .paginate_button.next {
        font-weight: bold;
    }

    .dataTables_paginate .paginate_button.disabled {
        display: none;
    }
</style>
<script>
    $(document).ready(function() {
        // Check if the table has already been initialized
        if ($.fn.DataTable.isDataTable('.datatable')) {
            // If yes, destroy the existing instance
            $('.datatable').DataTable().destroy();
        }

        // Initialize the DataTable
        $('.datatable').DataTable({
            "paging": true,
            // "pagingType": 'full_numbers', // Full pagination controls
            // "pageLength": 25, // Number of rows per page
            "lengthMenu": [10, 25, 50, 100], // Options for page lengths
            "bFilter": true,
            "sDom": 'fBtlpi',
            "ordering": true,
            "language": {
                search: ' ',
                sLengthMenu: '_MENU_',
                searchPlaceholder: "Search ...",
                info: "_START_ - _END_ of _TOTAL_ items",
                paginate: {
                    first: "First",
                    last: "Last",
                    next: "Next",
                    previous: "Previous"
                }
            },
            initComplete: function(settings, json) {
                // Move the DataTables filter to a custom container
                $('.dataTables_filter').appendTo('.search-input');
            },
            dom: 'Bfrtip', // Define where the buttons and pagination controls should be placed
            buttons: [
                {
                    extend: 'copy',
                    text: '<img src="{{asset('/')}}admin/assets/img/icons/menu-icon-05.svg" alt="Copy">',
                    titleAttr: 'Copy',
                    className: 'btn btn-excel'
                },
                {
                    extend: 'excelHtml5',
                    text: '<img src="{{asset('/')}}admin/assets/img/icons/excel.svg" alt="Excel">',
                    titleAttr: 'Export to Excel',
                    className: 'btn btn-excel'
                },
                {
                    extend: 'pdfHtml5',
                    text: '<img src="{{asset('/')}}admin/assets/img/icons/pdf.svg" alt="PDF">',
                    titleAttr: 'Export to PDF',
                    className: 'btn btn-excel'
                }
                // Uncomment if you need CSV export
                // {
                //     extend: 'csvHtml5',
                //     text: '<img src="{{asset('/')}}admin/assets/img/icons/csv.svg" alt="CSV">',
                //     titleAttr: 'Export to CSV',
                //     className: 'btn btn-excel'
                // },
            ],
        });

        // Handle custom Excel button click
        $('#excelButton').on('click', function() {
            $('.datatable').DataTable().button('.buttons-excelHtml5').trigger();
        });

        // Handle custom PDF button click
        $('#pdfButton').on('click', function() {
            $('.datatable').DataTable().button('.buttons-pdfHtml5').trigger();
        });

        // Handle custom Print button click
        $('#printButton').on('click', function() {
            $('.datatable').DataTable().button('.buttons-print').trigger();
        });
    });
</script>

<!--  End Datatable JS -->
@yield('js')
