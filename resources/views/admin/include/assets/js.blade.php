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


<!-- Custom JS -->
<script src="{{asset('/')}}admin/assets/js/script.js"></script>


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


@yield('js')
