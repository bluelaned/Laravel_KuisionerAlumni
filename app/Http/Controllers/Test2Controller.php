<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kuisioner;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class Test2Controller extends Controller
{
    public function index()
    {
        $pertanyaan = Kuisioner::all();
        return view('test.mahasiswa.kuisioner.pertanyaan', compact('pertanyaan'));
    }

    public function submitKuisioner(Request $request)
    {
        $input = $request->all();
        $exam_id = $input['exam_id'];
        $index = $input['index'];

        $user = Auth::user();
        $npm = $user->npm;
        $nama_mahasiswa = $user->name;

       
        for ($i = 1; $i <= $index; $i++) {
            $question_id = $input['question'.$i];
            $answer = $input['ans'.$i];

            $hasilKuisioner = new HasilKuisioner();
            $hasilKuisioner->exam_id = $exam_id;
            $hasilKuisioner->npm = $npm;
            $hasilKuisioner->nama_mahasiswa = $nama_mahasiswa;
            $hasilKuisioner->jawaban = $answer;
            $hasilKuisioner->save();
        }

        return redirect()->route('kuisioner.complete');
    }


}
