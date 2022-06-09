@extends('template.template')
@section('title','list')
@section('main')
    <div class="modal fade" id="status" data-bs-backdrop="static" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">post status</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                </div>
                <div class="modal-body">
                    <form action="/api/list/add" method="post" class="container rounded d-flex flex-column gap-3 mt-3 p-4 rounded shadow" enctype="multipart/form-data">
                        @csrf
                        <div class="form-floating">
                        <input type="text" class="form-control rounded shadow py-3" id="input" placeholder="my todos" required name="todo">
                        @error('todo')
                            <div class="alert alert-danger">{{$message}}</div>
                        @enderror
                        <label for="input">my todos</label>
                        </div>
                        <label for="file"><p class="mx-auto"><i class="h2 bi bi-arrow-up-circle-fill upload-link"> upload</i></p></label>
                        <input type="file" class="form-control shadow rounded d-none py-3" id="file" name="file" onchange="Preview()">
                        @error('file')
                        <div class="alert alert-danger">{{$message}}</div>
                        @enderror
                        <img alt="" srcset="" class="img-fluid w-50" id="img-preview">
                        <div class="form-floating">
                        <input type="text" class="form-control rounded shadow py-3" id="filename" placeholder="filename" required name="filename">
                        <label for="filename">filename</label>
                        </div>
                        @error('filename')
                            <div class="alert alert-danger">{{$message}}</div>
                        @enderror
                        <button class="btn btn-outline-secondary py-2 px-5 rounded shadow text-capitalize" name="send"><i class="bi bi-bookmark-plus-fill"></i> send</button>
                    </form>
                </div>
                <div class="modal-footer"></div>
            </div>
        </div>
    </div>
        <div class="col-12 mt-5 shadow">
            @error('todo')
            <div class="alert alert-danger">{{$message}}</div>
            @enderror
            @error('file')
                <div class="alert alert-danger">{{$message}}</div>
            @enderror
            @error('filename')
                <div class="alert alert-danger">{{$message}}</div>
            @enderror
            <button class="btn btn-secondary py-3 px-5 rounded-pill shadow w-100" data-bs-toggle="modal" data-bs-target="#status"> buat status</button>
        </div>

    @foreach($datas as $data)  
        <div class="w-50 d-flex justify-content-center mx-auto mt-5 mb-5 flex-wrap flex-1">
            <div class="border border-secondary card rounded shadow bg-light px-2 py-4">
                <div class="card-content">
                    <div class="card-header">
                        <p>post number : {{$no++}}</p>
                        <p>file name:{{$data->file_name}}</p>
                        <p>todo: {{$data->todo}}</p>
                        <p>created at: {{ Date('d-D-M-Y H:m:s', strtotime($data->created_at) )}}</p>
                        <p>updated at: {{ Date('d-D-M-Y H:i:s', strtotime($data->updated_at) ) }}</p>
                        <div class="d-flex flex-row flex-wrap gap-2">
                            <a href="/list/{{$data->id}}/edit" class="shadow rounded-pill btn btn-warning px-5 py-2"><i class="bi bi-pencil-square"></i> edit</a>
                                <a href="/list/{{$data->id}}/delete" class="shadow rounded-pill btn btn-danger px-5 py-2"><i class="bi bi-x-octagon-fill"></i> delete</a>
                        </div>    
                    </div>
                    <div class="card-body">
                       @if (
                            $data->file_name == "" 
                                    ||
                            $data->file_name ==null
                            )
                       <img src="{{asset('imgs')}}/{{$data->file}}" alt="{{$data->file_name}}" class="img-fluid img-rounded rounded shadow">
                       @endif 
                    </div>
                </div>
            </div>
        </div>
    @endforeach

    {{-- axios library --}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/axios/1.0.0-alpha.1/axios.min.js" integrity="sha512-xIPqqrfvUAc/Cspuj7Bq0UtHNo/5qkdyngx6Vwt+tmbvTLDszzXM0G6c91LXmGrRx8KEPulT+AfOOez+TeVylg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>

     let url="http://127.0.0.1:8000/api/list";
       
    const get=url=>{
        axios.get(url)
        .then((data)=>console.log(data.data))
        .catch((err)=>console.log(err));
    }    
    get(url);
</script>
@endsection