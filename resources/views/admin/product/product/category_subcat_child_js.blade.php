@section('js')
    <script>
        $(document).ready(function (){
            $("#category_id").on('change',function (){
                var id=$("#category_id").val();
                $.ajax({
                    url:base_url+"/get_sub_cat/"+id,
                    type:'get',
                    dataType:'json',
                    success:function (data){
                        option = '<option >'+'Select Sub Category'+'</option>';
                        $.each(data.data, function(i,data)
                        {
                            // console.log(i);
                            option +='<option value="'+data.id+'">'+data.name+'</option>';
                        });
                        $("#sub_category").empty().html(option);
                    }
                });
            });
        });

        $("#sub_category").on('change',function (){
            var id=$("#sub_category").val();

            $.ajax({
                url:base_url+"/get_child_cat/"+id,
                type:'get',
                dataType:'json',
                success:function (success){
                    option='<option >'+'Select child Category'+'</option>';
                    $.each(success.data,function (i,data){
                        option +='<option value=" '+data.id+' " >'+data.name+'</option>'
                    });
                    $("#child_category").empty().append(option);
                }
            });
        });
    </script>
@endsection
