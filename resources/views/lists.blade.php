@extends('template.template')
@section('title','list')
@section('main')
    <form action="/list/add" method="post" class="container rounded d-flex flex-column gap-3 mt-3 p-4 rounded shadow" enctype="multipart/form-data">
        @csrf
        <div class="form-floating">
        <input type="text" class="form-control rounded shadow py-3" id="input" placeholder="my todos" required name="todo">
        <label for="input">my todos</label>
        </div>
        @error('todo')
            <div class="alert alert-danger">{{$message}}</div>
        @enderror
        <input type="file" class="form-control shadow rounded py-3" id="file" required name="file" onchange="Preview()">
        <img alt="" srcset="" class="img-fluid w-50" id="img-preview">
        @error('file')
            <div class="alert alert-danger">{{$message}}</div>
        @enderror
        <div class="form-floating">
        <input type="text" class="form-control rounded shadow py-3" id="filename" placeholder="filename" required name="filename">
        <label for="filename">filename</label>
        </div>
        @error('filename')
            <div class="alert alert-danger">{{$message}}</div>
        @enderror
        <button class="btn btn-outline-secondary py-2 px-5 rounded shadow text-capitalize" name="send"><i class="bi bi-bookmark-plus-fill"></i> send</button>
    </form>

    <div class="container m-3 p-3 shadow">
        <table class="table table-light table-hover table-striped">
            <tr>
                <thead>
                    <th class="p-3">no</th>
                    <th>todolist</th>
                    <th>picture</th>
                    <th>filename</th>
                    <th>created at</th>
                    <th>updated at</th>
                    <th>action</th>
                </thead>
            </tr>
            @foreach($datas as $data)
            <tr>
                <tbody>
                    <td class="p-3">{{$no++}}</td>
                    <td>{{$data->todo}}</td>
                    <td><img src="{{asset('imgs')}}/{{$data->file}}" alt="{{$data->file_name}}" class="img-fluid img-rounded rounded shadow w-50"></td>
                    <td><p>name : {{$data->file_name}}</p></td>
                    <td>{{ Date('d-D-M-Y H:m:s', strtotime($data->created_at) ) }}</td>
                    <td>{{ Date('d-D-M-Y H:m:s', strtotime($data->updated_at) ) }}</td>
                    <td>
                        <div class="d-flex flex-wrap flex-column gap-3">
                            <a href="/list/{{$data->id}}/edit" class="shadow rounded-pill btn btn-warning px-5 py-2"><i class="bi bi-pencil-square"></i> edit</a>
                                <a href="/list/{{$data->id}}/delete" class="shadow rounded-pill btn btn-danger px-5 py-2"><i class="bi bi-x-octagon-fill"></i> delete</a>
                        </div>
                    </td>
                </tbody>
            </tr>
            @endforeach
        </table>
    </div>
    <script>
//         function Preview(){
//     const image=document.querySelector('#file');
//     const preview=document.querySelector('#img-preview');

//     preview.style.display='block';

//     const reader=new FileReader();

//     reader.readAsDataURL(image.files[0]);
//     reader.onload =function(eventReader){
//         preview.src= eventReader.target.result;
//     }
    
// }
    </script>
@endsection