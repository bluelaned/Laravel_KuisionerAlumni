@extends('alumni.style');
@section('content')
<div class="container">
    <form action="{{ route('alumni.submit_kuisioner') }}" method="POST">
        <input type="hidden" name="exam_id" value="{{ Request::segment(3)}}">
        {{ csrf_field()}}
        <div class="row">
            @foreach ($pertanyaan as $key => $database)
            <div class="col-sm-12 mt-4">
                <p>{{$key+1}}. {{ $database->pertanyaan }}</p>
                <?php 
                    $options = json_decode($database->options, true);
                ?>
                <input type="hidden" name="question{{$key+1}}" value="{{$database->id}}">
                <ul class="question_options">
                    @foreach ($options as $option)
                    <li style="list-style: none;">
                        @if($option[0] == null)
                        <textarea name="ans{{$key+1}}" class="form-control" placeholder="Masukkan Jawaban"></textarea>
                        @else
                        <div class="form-check">
                            <input type="radio" value="{{ $option[0] }}" name="ans{{$key+1}}">
                            <label>{{ $option[0] }}</label>
                        </div>
                        @endif
                    </li>
                    @endforeach
                </ul>
            </div>
            @endforeach
            <div class="col-sm-12">
                <input type="hidden" name="index" value="{{ $key+1}}">
                <button type="submit" class="btn btn-primary" id="myCheck">Submit</button>
            </div>
        </div>
    </form>


</div>
