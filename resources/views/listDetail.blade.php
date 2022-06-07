@extends('template.template')
@section('title','list | edit')
@section('main')
    <form action="/list/{{$data->id}}/put" method="POST" class="container rounded d-flex flex-column gap-3 mt-3 p-4 rounded shadow" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="d-flex justify-content-center align-items-center align-content-center px-5 py-2">
            <label for="file"><img src="{{asset('imgs/')}}/{{$data->file}}" alt="" srcset="" class="rounded-pill w-25 img-thumbnail gambar" style="cursor:pointer"></label>
        <div class="d-flex flex-column gap-1">
            <label for="file"><p><i class="h2 bi bi-arrow-up-circle-fill upload-link"> upload</i></p></label>
            <input type="file" name="file" id="file" class="form-control d-none shadow  rounded py-3" onchange="Preview()" value="{{$data->file}}">
            @error('file')
                <div class="alert alert-danger"><h5>{{$message}}</h5></div>
            @enderror
            <img alt="" srcset="" class="img-fluid w-75 shadow rounded p-1" id="img-preview">
        </div>
        </div>
        <div class="form-floating">
        <input type="text" class="form-control rounded shadow py-3" id="input" placeholder=" todos" required name="todo" value="{{$data->todo}}">
        <label for="input">todo</label>
        </div>
        <div class="form-floating">
        <input type="text" class="form-control rounded shadow py-3" id="input" placeholder="file name" required name="filename" value="{{$data->file_name}}">
        <label for="input">file name</label>
        </div>
        <button class="btn btn-outline-secondary py-2 px-5 rounded shadow text-capitalize" ><i class="bi bi-bookmark-plus-fill"></i> send</button>
    </form>


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
