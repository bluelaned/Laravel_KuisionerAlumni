@extends('alumni.style');
@section('content')

<div class="container">
    <h2>
        <p>NPM : {{ Auth::guard('alumni')->user()->npm }}</p>
        <p>NAMA MAHASISWA : {{ Auth::guard('alumni')->user()->nama_mahasiswa }}</p>
        <p>Poin Akumulasi : {{ $total_point }}</p>
    </h2>
    <hr>
    <h2>Selesai! Terima kasih atas waktu dan perhatian Anda untuk menjawab survei ini. Masukan Anda akan sangat membantu
        kami dalam memahami kebutuhan dan harapan pelanggan kami.</h2>
</div>
