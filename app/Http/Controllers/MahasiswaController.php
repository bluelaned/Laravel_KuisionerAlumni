<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Kuisioner;
use App\Models\Hasil_kuisioner;
use App\Models\Kuisioner_akumulasi;

class MahasiswaController extends Controller
{
    public function index(){
        return view('mahasiswa.home');
    }

    // ---------------------------------------------------------------------------------------- //
    public function kuisioner_pertanyaan()
    {
        $pertanyaan = Kuisioner::all();
        return view('mahasiswa.kuisioner.pertanyaan', compact('pertanyaan'));
    }

    public function submitKuisioner(Request $request)
    {
        $exam_id = $request->input('exam_id');
        $index = $request->input('index');

        $user = Auth::user();
        $npm = $user->npm;
        $nama_mahasiswa = $user->name;

        $total_nilai = 0;

        for ($i = 1; $i <= $index; $i++) {
            $question_id = $request->input('question'.$i);
            $answer = $request->input('ans'.$i);
            $optionsWithPoints = json_decode(Kuisioner::find($question_id)->options);
        
         
            foreach ($optionsWithPoints as $optionWithPoint) {
                if ($optionWithPoint[0] == $answer) {
                    $point = $optionWithPoint[1];
                    $total_nilai += $point;
                    break;
                }
            }
        
            $hasilKuisioner = new Hasil_kuisioner();
            $hasilKuisioner->npm = $npm;
            $hasilKuisioner->nama_mahasiswa = $nama_mahasiswa;
            $hasilKuisioner->pertanyaan = Kuisioner::find($question_id)->pertanyaan;
            $hasilKuisioner->jawaban = $answer;
            $hasilKuisioner->point = $point;
            $hasilKuisioner->save();
        }

       
        $kuisionerAkumulasi = Kuisioner_akumulasi::updateOrCreate(
            ['npm' => $npm],
            ['nama_mahasiswa' => $nama_mahasiswa, 'total_nilai' => $total_nilai]
        );

        return redirect()->route('mahasiswa.kuisioner.response');
    }


    // ---------------------------------------------------------------------------------------- //

    public function kuisioner_response(){
        return view('mahasiswa.kuisioner.response');
    }

    public function tracer_response(){
        return view('mahasiswa.tracerStudy.response');
    }

    public function informasi_berita(){
        return view('mahasiswa.informasi.Berita');
    }

    public function informasi_pengumuman(){
        return view('mahasiswa.informasi.Pengumuman');
    }
}
