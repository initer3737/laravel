<?php

namespace App\Http\Controllers;
use App\Models\todo;
use Illuminate\Http\Request;
use File;

class todoController extends Controller
{
    public function Index()
    {
            $title ='lists';$data=todo::all();$no=1;
            return view('lists',['datas'=>$data,'title'=>$title,'no'=>$no])->with('i', (request()->input('page', 1) - 1) * 5);
    }

    public function IndexId($id)
    {
            $title ='lists | edit';$data=todo::find($id);$no=1;
            return view('listDetail',['data'=>$data,'title'=>$title,'no'=>$no]);
    }

    public function Store(Request $request)
    {
            $request->validate([
                'todo'=>['required','max:125'],
                'file'=>['required','image','max:12000'],
                'filename'=>['required','min:12']
            ]);
            
            //post data image
            //ambil inputan file 2.ambil nama file 3.kirim ke folder tujuan  
            //filesend is a variable thats will be send to the database
            $file=$request->file('file');
            $filesend=$file->getClientOriginalName();
            $file->move('imgs',$filesend);
            $filename=$request->input('filename');
            $POST=new todo;
        //     $POST->todo = $request->todo;
            $POST->fill([
                'todo' => $request->todo,
                'file'=>$filesend,
                'file_name'=>$filename
            ]);
            $POST->save();
            return redirect('/');
    }

    public function Update(Request $request)
    {
            $request->validate([
                'todo'=>['required','max:125']
            ]);
            
            $POST=todo::find($request->id);
        //     $POST->todo = $request->todo;
            $POST->update( $request->all());
        //     $POST->save();
            return redirect('/');
    }

    public function Delete(Request $request)
    {
            $delete=todo::find($request->id);
            File::delete('imgs/'.$delete->file);//delete the image from directori
            $delete->delete();
            return redirect('/');
    }

}
