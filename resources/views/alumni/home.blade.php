@extends('alumni.style');
@section('content')

<div class="container">
    <h1>Kuisioner Alumni</h1>
    <form action="{{ route('alumni.submit_user') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="npm">NPM :</label>
            <input type="text" class="form-control" id="npm" name="npm" placeholder="Enter NPM" required>
        </div>
        <div class="form-group">
            <label for="nama">Nama Mahasiswa :</label>
            <input type="text" class="form-control" id="nama_mahasiswa" name="nama_mahasiswa" placeholder="Enter name" required>
        </div>
        <div class="d-flex justify-content-end">
            <button type="submit" class="btn btn-primary btn-next" id="next-button">Next</button>
        </div>
    </form>
</div>

