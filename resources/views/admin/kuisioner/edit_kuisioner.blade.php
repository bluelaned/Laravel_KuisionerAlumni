@extends('admin.home')
@section('content')


<!-- /.content-header -->
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper" style="margin-left: 0px;">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Edit Data</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->

        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <!-- Default box -->
                        <div class="card">
                            <div class="card-body">
                                <form action="{{ route('update_kuisioner', ['id' => $kuisioner->id]) }}" method="POST"
                                    class="database_operation">
                                    @csrf
                                    @method('PUT')
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div class="form-group">
                                                <label for="">Masukkan Pertanyaan</label>
                                                <input type="text" name="pertanyaan" placeholder="Enter Question"
                                                    class="form-control"
                                                    value="{{ old('pertanyaan', $kuisioner->pertanyaan) }}">
                                            </div>
                                        </div>
                                        <div class="col-sm-12">
                                            <div class="form-group">
                                                <label for="">Options:</label>
                                                @if(isset($kuisioner))
                                                @php $options = json_decode($kuisioner->options, true); @endphp
                                                @foreach($options as $index => $option)
                                                <div class="input-group mb-3">
                                                    <input type="text" name="options[{{ $index }}][option]"
                                                        class="form-control" placeholder="Enter Option"
                                                        value="{{ $option[0] ?? '' }}">
                                                    <input type="text" name="options[{{ $index }}][point]"
                                                        class="form-control" placeholder="Enter Points"
                                                        value="{{ $option[1] ?? '' }}">
                                                    <div class="input-group-append">
                                                        <button class="btn btn-outline-secondary" type="button"
                                                            onclick="removeOptionField(this)">Remove</button>
                                                    </div>
                                                </div>
                                                @endforeach
                                                @else
                                                < input-group mb-3">
                                                    <input type="text" name="options[0][option]" class="form-control"
                                                        placeholder="Enter Option">
                                                    <input type="text" name="options[0][point]" class="form-control"
                                                        placeholder="Enter Points">
                                                    <div class="input-group-append">
                                                        <button class="btn btn-outline-secondary" type="button"
                                                            onclick="removeOptionField(this)">Remove</button>
                                                    </div>
                                            </div>
                                            @endif
                                            <div id="optionFields"></div>
                                            <button class="btn btn-outline-secondary" type="button"
                                                onclick="addOptionField()">Add Option</button>
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <button class="btn btn-primary" type="submit">Update</button>
                                        </div>
                                    </div>
                            </div>
                            </form>

                            <script>
                                function addOptionField() {
                                    var optionFields = document.getElementById('optionFields');
                                    var index = optionFields.childElementCount;
                                    var inputGroup = document.createElement('div');
                                    inputGroup.classList.add('input-group', 'mb-3');
                                    inputGroup.innerHTML = `
            <input type="text" name="options[${index}][option]" class="form-control"
                placeholder="Enter Option">
            <input type="text" name="options[${index}][point]" class="form-control"
                placeholder="Enter Points">
            <div class="input-group-append">
                <button class="btn btn-outline-secondary" type="button"
                    onclick="removeOptionField(this)">Remove</button>
            </div>
        `;
                                    optionFields.appendChild(inputGroup);
                                }

                                function removeOptionField(button) {
                                    button.closest('.input-group').remove();
                                }

                            </script>

                        </div>
                    </div>
                </div>
            </div>
    </div>
    </section>
</div>
</div>
@endsection
