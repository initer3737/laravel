@extends('template.template')
@section('title','list | edit')
@section('main')
    <form action="/list/{{$data->id}}/put" method="POST" class="container rounded d-flex flex-column gap-3 mt-3 p-4 rounded shadow">
        @csrf
        @method('PUT')
        <div class="d-flex justify-content-center align-items-center align-content-center px-5 py-2">
        <label for="file"><img src="{{asset('imgs/')}}/{{$data->file}}" alt="" srcset="" class="rounded-pill w-25 img-thumbnail" style="cursor:pointer"></label>
        <div class="d-flex flex-column gap-2">
            <p class="h3">status: <span id="status">empty!</span></p>
            <input type="file" name="file" id="file" class="shadow">
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
        <button class="btn btn-outline-secondary py-2 px-5 rounded shadow text-capitalize" >send</button>
    </form>
@endsection

<script>
    const inputfile=()=>{
        let target=document.getElementById('status');
        let file=document.getElementById('file');
        target.innerHTML='file.value';
    }
    //status file setengah jadi
    const initialize =()=>{
        inputfile();
    }

    initialize();
</script>