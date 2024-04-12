<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <title>Task Manager</title>
  </head>
  <body>
    <div class="container">
        <div class="row justify-content-center">
            <h1 class="text-center">{{ isset($single_data)?'Task Update':'Task Manager' }}</h1>
            <p><a href="{{ route('register') }}" class="btn btn-success">Register</a></p>
            <form action="{{ isset($single_data)?route('update',$single_data->id):route('store') }}" method="post" class="col-sm-6">
                @csrf
                <div class="mb-3">
                    <label for="title" class="form-label">Title</label>
                    <input type="text" class="form-control" id="title" name="title" value="{{ isset($single_data->title)?$single_data->title:'' }}">
                </div>
                <div class="mb-3">
                    <label for="description" class="form-label" >Description</label>
                    <textarea class="form-control" name="description">{{ isset($single_data->description)?$single_data->description:'' }}</textarea>
                </div>
                <button type="submit" class="btn btn-primary">{{ isset($single_data)?'Update':'Submit'}}</button>
            </form>
        </div>
        <div class="row mt-3">
            <table class="table table-bordered">
                <thead>
                  <tr>
                    <th scope="col">Sr.</th>
                    <th scope="col">Title</th>
                    <th scope="col">Description</th>
                    <th scope="col">Status</th>
                    <th scope="col">Action</th>
                  </tr>
                </thead>
                <tbody>
                    @foreach ($task_list as $item)
                  <tr>
                    <th scope="row">{{ $loop->index+1 }}</th>
                    <td>{{$item->title}}</td>
                    <td>{{$item->description}}</td>
                    <td>

                        <div class="form-check form-switch">
                            <input class="form-check-input active" data-id="{{ $item->id }}" type="checkbox"
                                name="is_active" id="switch-dark-mode-a{{ $item->id }}"
                                {{ $item->status ? 'checked' : '' }}>
                            <label class="custom-control-label" for="switch-dark-mode-a{{$item->id}}"></label>
                        </div>

                    </td>
                    <td>
                        <a href="{{ route('edit',$item->id) }}" class="btn btn-success">Edit</a>
                        <a href="{{ route('delete',$item->id) }}" class="btn btn-danger">Delete</a>
                    </td>
                  </tr>
                  @endforeach

                </tbody>
              </table>

              {{ $task_list->links('pagination::bootstrap-5') }}
        </div>
    </div>
    @include('sweetalert::alert')


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script>
        $(document).ready(function() {
            $(document).on('change', '.active', function() {
                var statusId = $(this).data('id');
                var isActive = $(this).is(':checked');
                var newurl = "{{ url('changeStatus') }}/" + statusId;
                $.ajax({
                    url: newurl,
                    type: 'get',
                });

            });
        });
    </script>
  </body>
</html>
