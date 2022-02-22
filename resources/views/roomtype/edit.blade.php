@extends('layouts.master')

@section('content')

<!-- container-fluid -->
<div class="container-fluid">
 
    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800">Edit Room Type</h1>

    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Update {{ $data->title }}
                <a href="{{ url("/roomtype/create") }}" class="float-right btn btn-success btn-md mr-5">Add Room Type</a> 
            <a href="{{ url("/roomtype") }}" class="float-right btn btn-success btn-md mr-5">View All</a>
        </h6>
        </div>
        <div class="card-body">
            @if (Session::has("success"))
                <p class="text-success">{{ session("success") }}</p>
            @endif
            <div class="table-responsive">
                <form action="{{ url("/roomtype/".$data->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method("PUT")
                    <table class="table table-bordered">
                    
                        <tbody>
                            <tr>
                                <th>Title</th>
                                <td><input type="text" autocomplete="off" value="{{ $data->title }}" class="form-control" name="title" /></td>
                            </tr>
                            <tr>
                                <th>Price</th>
                                <td><input type="text" autocomplete="off" value="{{ $data->price }}" class="form-control" name="price" /></td>
                            </tr>
                            <tr>
                                <th>Details</th>
                                <td><textarea class="form-control" name="detail">{{ $data->detail }}</textarea></td>
                            </tr>
                            <tr>
                                <th>Gallery</th>
                                
                                <td> <input type="file" multiple name="imgs[]" class="form-control mb-3" />
                                    <table>
                                        <tr>
                                            @foreach ($data->roomtypeimages as $img)
                                                <td class="imgcol{{ $img->id }}">
                                                    <img src="{{ asset('storage/'.$img->img_src) }}" width="100" height="100" />
                                                    <p class="mt-2">
                                                        <button type="button" onclick="return confirm('Are you sure to delete this item?')" class="btn btn-danger btn-sm delete-image" data-image-id="{{ $img->id }}" ><i class="fa fa-trash"></i></button>
                                                    </p>
                                                </td>
                                            @endforeach
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2"><input type="submit" class="btn btn-primary" name="submit" value="update" /></td>
                            </tr>
                        </tbody>
                    </table>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- /.container-fluid -->

@section("scripts")
    <script type="text/javascript">
        $(document).ready(function(){
            $(".delete-image").on("click", function(){
                var _img_id = $(this).attr('data-image-id');
                var _vm = $(this);
                $.ajax({
                    url : "roomtypeimage/"+_img_id+"/delete",
                    data: {},
                    dataType: 'json',
                    beforeSend: function(){
                        _vm.addClass('disabled');
                    },
                    success: function(res){
                        console.log(res);
                        if(res.bool == true){
                            $(".imgcol"+_img_id).remove();
                            _vm.removeClass('disabled');
                        }
                    }
                });
            });
        });
    </script>
@endsection

@endsection