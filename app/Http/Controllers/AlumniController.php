<?php

namespace App\Http\Controllers;


use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Kuisioner;
use App\Models\Kuisioner_alumni;
use App\Models\Kuisioner_alumni_hasil;
use App\Models\Kuisioner_alumni_akumulasi;

class AlumniController extends Controller
{
    public function home()
    {
        return view('alumni.home');
    }

    public function submit_user(Request $request)
    { 
        $validatedData = $request->validate([
            'npm' => 'required|integer',
            'nama_mahasiswa' => 'required|string|max:255',
        ]);

        $npm = $validatedData['npm'];

        $alumni = Kuisioner_alumni::where('npm', $npm)->first();

        if ($alumni) {
            Auth::guard('alumni')->login($alumni);
            return redirect()->route('complete');
        }

        $alumni = new Kuisioner_alumni;
        $alumni->npm = $npm;
        $alumni->nama_mahasiswa = $validatedData['nama_mahasiswa'];
        $alumni->save();

        Auth::guard('alumni')->login($alumni);

        return redirect()->route('alumni.pertanyaan');
    }

    public function kuisioner_pertanyaan()
    {
        $pertanyaan = Kuisioner::all();
        return view('alumni.pertanyaan', compact('pertanyaan'));
    }


    public function submit_kuisioner(Request $request)
    {
        $exam_id = $request->input('exam_id');
        $index = $request->input('index');

        $user = Auth::guard('alumni')->user();
        $npm = $user->npm;
        $nama_mahasiswa = $user->name;

        $total_nilai = 0;

        $kuisioner_alumni = Kuisioner_alumni::where('npm', $npm)->first();
        if ($kuisioner_alumni) {
            $nama_mahasiswa = $kuisioner_alumni->nama_mahasiswa;
        }

        for ($i = 1; $i <= $index; $i++) {
            $question_id = $request->input('question'.$i);
            $answer = $request->input('ans'.$i);
            $optionsWithPoints = json_decode(Kuisioner::find($question_id)->options);
            $status = [];
            foreach ($optionsWithPoints as $optionWithPoint) {
                if ($optionWithPoint[0] == $answer) {
                    $point = $optionWithPoint[1];
                    $total_nilai += $point;
        
                    if ($answer != null) {
                        $status = json_decode(Kuisioner::find($question_id)->status, true);
                        if (!is_array($status)) {
                            $status = [];
                        }
                        if (isset($status[$answer])) {
                            $status[$answer]++;
                        } else {
                            $status[$answer] = 1;
                        }
                        Kuisioner::where('id', $question_id)->update(['status' => json_encode($status)]);
                    }
                    break;
                }
            }

            $hasilKuisioner = new Kuisioner_alumni_hasil();
            $hasilKuisioner->npm = $npm;
            $hasilKuisioner->nama_mahasiswa = $nama_mahasiswa;
            $hasilKuisioner->pertanyaan = Kuisioner::find($question_id)->pertanyaan;

            if ($answer === null && count($optionsWithPoints) === 2 && $optionsWithPoints[0][0] === null && $optionsWithPoints[1][0] === null) {
                $hasilKuisioner->jawaban = $request->input('custom_answer'.$i);
                $hasilKuisioner->point = 0;
            } else {
                $hasilKuisioner->jawaban = $answer;
                $hasilKuisioner->point = $point;
        }

        $hasilKuisioner->save();
    }
    
    $kuisionerAkumulasi = Kuisioner_alumni_akumulasi::updateOrCreate(
        ['npm' => $npm],
        ['nama_mahasiswa' => $nama_mahasiswa, 'total_point' => $total_nilai]
    );
    
    return redirect()->route('complete')->with('success', 'Kuisioner telah berhasil disimpan.');
}


    public function complete()
    {
        $alumni = Auth::guard('alumni')->user();
        $akumulasi = Kuisioner_alumni_akumulasi::where('npm', $alumni->npm)->first();
        $total_point = $akumulasi ? $akumulasi->total_point : 0;
        
        return view('alumni.complete', ['total_point' => $total_point]);
    }


}
