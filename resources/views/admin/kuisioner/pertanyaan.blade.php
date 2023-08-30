@extends('admin.home');
@section('content')

<!-- /.content-header -->
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper" style="margin-left: 0px;">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Add questions</h1>
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
                            <div class="card-header">
                                <h3 class="card-title">Title</h3>

                                <div class="card-tools" style="margin-left: 880px;">
                                    <a class="btn btn-info btn-sm" href="javascript:;" data-toggle="modal"
                                        data-target="#myModal">Add new</a>
                                </div>

                            </div>
                            <div class="card-body table-responsive">
                                <table class="table table-striped table-bordered table-hover datatable">
                                    <thead>
                                        <tr>
                                            <th>No. </th>
                                            <th>Pertanyaan</th>
                                            <th>Pilihan</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($pertanyaan as $key=>$database)
                                        <tr>
                                            <td>{{ $key+1}}</td>
                                            <td>{{ $database['pertanyaan']}}</td>
                                            <td>{{ $database['options']}}</td>
                                            <td>
                                                <a href="{{ route('admin.kuisioner.edit_kuisioner', ['id' => $database['id']]) }}"
                                                    class="btn btn-info btn-sm">Edit</a>
                                                <a href="{{ route('hapus_action', ['id' => $database['id']]) }}"
                                                    class="btn btn-danger btn-sm">Delete</a>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>
                </div>
            </div>
        </section>

    </div>
    <!-- /.content-header -->

    <!-- Modal -->
    <div class="modal fade" id="myModal" role="dialog">
        <div class="modal-dialog modal-lg">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Tambah Data</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('admin.kuisioner.create_action')}}" method="post">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label for="">Masukkan Pertanyaan</label>
                                    {{ csrf_field() }}
                                    <input type="text" name="pertanyaan" placeholder="Enter Question"
                                        class="form-control">
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="form-group" id="options-container">
                                    <label for="">Option</label>
                                    <div class="input-group mb-3">
                                        <input type="text" name="options[]" placeholder="Enter Option"
                                            class="form-control">
                                        <input type="number" name="points[]" placeholder="Enter Point"
                                            class="form-control ml-2">
                                        <div class="input-group-append">
                                            <button class="btn btn-outline-secondary" type="button"
                                                onclick="addOptionField()">Add Option</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <script>
                                var optionIndex = 1;

                                function addOptionField() {
                                    var container = document.getElementById("options-container");
                                    var inputOption = document.createElement("input");
                                    inputOption.type = "text";
                                    inputOption.name = "options[]";
                                    inputOption.placeholder = "Enter Option";
                                    inputOption.className = "form-control";

                                    var inputPoint = document.createElement("input");
                                    inputPoint.type = "number";
                                    inputPoint.name = "points[]";
                                    inputPoint.placeholder = "Enter Point";
                                    inputPoint.className = "form-control ml-2";

                                    var inputGroup = document.createElement("div");
                                    inputGroup.className = "input-group mb-3";
                                    inputGroup.appendChild(inputOption);
                                    inputGroup.appendChild(inputPoint);

                                    container.appendChild(inputGroup);

                                    optionIndex++;
                                }

                            </script>
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <button class="btn btn-primary" type="submit">Add</button>
                                </div>
                            </div>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
    @endsection
