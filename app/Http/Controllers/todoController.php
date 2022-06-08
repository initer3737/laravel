<?php

namespace App\Http\Controllers;
use App\Models\todo;
use Illuminate\Http\Request;
use File;

class todoController extends Controller
{
        // api
public function ApiIndex()
{       $data=todo::all();
        $headers=[
                "status"=>200
        ];
        $fake=[
                "name"=>"puthut wahyu aji",
                "alamat"=>"k*dun*** pen**** rt.** rw.**",
                "kesehatan"=>[
                        1=>"gula darah",
                        2=>"diabetes",
                        3=>"darah tinggi"
                ],
                "hoby"=>[
                          1=>"sepedaan",
                          2=>"koding",
                          3=>"berenang"
                        ],
                "hiburan"=>[
                             1=>"youtube",
                             2=>"instagram",
                             3=>"film",
                           ]               
        ];
         return response()->json($data, 200, $headers);
}


    public function Index()
    {
            $title ='lists';$data=todo::all();$no=1;
            return view('lists',['datas'=>$data,'title'=>$title,'no'=>$no]);
        // return response()->json($data, 200,[
        //         "status"=>"200!"
        // ]);
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
            $file->move('imgs/',$filesend);
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

    public function Update(Request $request,$id)
    {
            $request->validate([
                'todo'=>['required','max:125'],
                'file'=>['image','max:12000'],
                'filename'=>['required','min:12']
            ]);
            $POST=todo::find($id);
                       if($request->file('file')){
                                //1.upload the file from front end to storage
                                $fileupload=$request->file('file');
                                $fileNameImage=$fileupload->getClientOriginalName();
                                $dir="imgs/{$POST->file}";
                                // 2.delete file from local and update the db
                                        File::delete($dir);
                                //3.move file
                                $fileupload->move('imgs/',$fileNameImage);
                       }
                   if(is_null($request->file('file'))){
                           $fileNameImage=$POST->file;
                   }    
        
            $POST->todo = $request->todo;
            $POST->file = $fileNameImage;
            $POST->file_name = $request->filename;
            $POST->save();
            return redirect('/');
    }

    public function Delete(Request $request ,$id)
    {
            $delete=todo::find($id);
            File::delete('imgs/'.$delete->file);//delete the image from directori
            $delete->delete();
            return redirect('/');
    }

}
