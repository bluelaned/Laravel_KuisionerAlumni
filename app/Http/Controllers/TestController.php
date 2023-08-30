<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use App\Models\Kuisioner;


class TestController extends Controller
{
    public function index(){
        Alert::info('Info Title', 'Info Message');
        return view('mahasiswa.home');
    }

    public function index2(){
        return view('test.asulo');
    }
    
    public function index3(){
      $pertanyaan = Kuisioner::all();
        return view('test.create', compact('pertanyaan'));
    }

    public function buat_pertanyaan(Request $request){

        $validator = Validator::make($request->all(), [
            'pertanyaan' => 'required',
            'options' => 'required|array|min:2', 
            'options.*' => 'required|string'
        ]);
    
        if($validator->fails()){
            $arr = array('status'=>'false','message'=>$validator->errors()->all());
        }else{
            $q = new Kuisioner();
            $q->pertanyaan = $request->pertanyaan;
            $q->options = json_encode($request->options);
            $q->status = 1;
            $q->save();
    
            $arr = array('status' => 'true', 'message' => 'Data Berhasil Ditambahkan', 'reload' => url('create'.$request->id));
        }
    
        echo json_encode($arr);
    }
    


    public function edit_kuisioner()
    {
        return view('test.edit_kuisioner');
    }

    public function update_kuisioner(Request $request, $id)
    {
        $kuisioner = Kuisioner::findOrFail($id);
        
        $validator = Validator::make($request->all(), [
            'pertanyaan' => 'required',
            'options' => 'required|array|min:2', 
            'options.*' => 'required|string'
        ]);

        if ($validator->fails()) {
            $arr = array('status'=>'false','message'=>$validator->errors()->all());
        }else{

        $kuisioner->pertanyaan = $request->pertanyaan;
        $kuisioner->options = json_encode($request->options); 
        $kuisioner->status = $request->has('status');
        $kuisioner->save();

        $arr = array('status' => 'true', 'message' => 'Berhasil Edit Data', 'reload' => url('create'));

        }
        echo json_encode($arr);
    }


    //Delete questions
    public function hapus_action($id){
        Kuisioner::where('id', $id)->delete();
        return redirect('create');
   }
}
