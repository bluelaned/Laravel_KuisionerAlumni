<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use App\Models\Kuisioner;

class AdminController extends Controller
{


    public function index(){
        return view('admin.home');
    }
    // ---------------------------------------------------------------------------------------------------- //
    public function kuisioner_pertanyaan(){
        $pertanyaan = Kuisioner::all();
          return view('admin.kuisioner.pertanyaan', compact('pertanyaan'));
    }
    

    public function buat_pertanyaan(Request $request){

        $validator = Validator::make($request->all(), [
            'pertanyaan' => 'required',
            'options' => 'nullable|array', 
            'options.*' => 'nullable|string',
            'points' => 'nullable|array',
            'points.*' => 'nullable|integer'
        ]);
    
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        } else {
            $options = $request->options;
            $points = $request->points;
            $optionsWithPoints = array();
        
            for ($i = 0; $i < count($options); $i++) {
                $optionWithPoint = array($options[$i], $points[$i]);
                $optionsWithPoints[] = $optionWithPoint;
            }
        
            $q = new Kuisioner();
            $q->pertanyaan = $request->pertanyaan;
            $q->options = json_encode($optionsWithPoints);
            $q->status = 1;
            $q->save();
        
            return redirect()->route('admin.kuisioner.pertanyaan')->with('success', 'Data Berhasil Ditambahkan');
        }
    }          

    public function edit_kuisioner($id)
    {
        $kuisioner = Kuisioner::findOrFail($id);
        return view('admin.kuisioner.edit_kuisioner', compact('kuisioner'));
    }


    public function update_kuisioner(Request $request, $id)
    {
        $kuisioner = Kuisioner::find($id);

    if (!$kuisioner) {
        $arr = array('status' => 'false', 'message' => 'Kuisioner not found');
    } else {
        $validator = Validator::make($request->all(), [
            'pertanyaan' => 'required',
            'options' => 'required|array|filled', 
            'options.*.option' => 'required|string',
            'options.*.point' => 'required|integer'
        ]);

        if ($validator->fails()) {
            $arr = array('status'=>'false', 'message'=>$validator->errors()->all());
        } else {
            $old_options = json_decode($kuisioner->options, true);
            $new_options = [];

            foreach ($request->options as $option) {
                $key = array_search($option['option'], array_column($old_options, 0));
                if ($key !== false) {
                    $new_options[] = [$option['option'], $option['point']];
                } else {
                    $new_options[] = [$option['option'], $option['point']];
                }
            }

            // Add any new options that are not present in old options
            foreach ($old_options as $option) {
                $key = array_search($option[0], array_column($new_options, 0));
                if ($key === false) {
                    $new_options[] = [$option[0], $option[1]];
                }
            }

            $kuisioner->pertanyaan = $request->pertanyaan;
            $kuisioner->options = json_encode($new_options); 
            $kuisioner->status = $request->has('status');
            $kuisioner->save();

                $arr = array('status' => 'true', 'message' => 'Berhasil Edit Data', 'reload' => route('admin.kuisioner.pertanyaan'));
            }
        }

        echo json_encode($arr);
    }

    
    public function hapus_action($id){
        Kuisioner::where('id', $id)->delete();
        return redirect()->route('admin.kuisioner.pertanyaan');
    }    

    // ---------------------------------------------------------------------------------------------------- //

    
    public function kuisioner_response()
    {
        $pertanyaan = Kuisioner::all(['id', 'pertanyaan', 'options', 'status']);
        return view('admin.kuisioner.response', compact('pertanyaan'));
    }


    public function tracer_response(){
        return view('admin.tracerStudy.response');
    }

    public function informasi_berita(){
        return view('admin.informasi.Berita');
    }

    public function informasi_pengumuman(){
        return view('admin.informasi.Pengumuman');
    }
}
