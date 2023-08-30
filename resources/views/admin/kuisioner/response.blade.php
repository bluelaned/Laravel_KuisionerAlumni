@extends('admin.home');
@section('content')
<style>
    table {
        border-collapse: collapse;
        width: 100%;
    }

    th,
    td {
        border: 1px solid #ddd;
        padding: 8px;
        text-align: left;
    }

    th {
        background-color: #f2f2f2;
    }

    .detail-btn {
        background-color: #4caf50;
        border: none;
        color: #fff;
        cursor: pointer;
        padding: 8px 16px;
    }

    .detail-content {
        display: none;
        padding: 16px;
        background-color: #f9f9f9;
    }

    .detail-content ul {
        list-style: none;
        margin: 0;
        padding: 0;
    }

    .detail-content li {
        margin-bottom: 8px;
    }

</style>
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
                                <table>
                                    <thead>
                                        <tr>
                                            <th>No.</th>
                                            <th>Pertanyaan</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($pertanyaan as $key => $database)
                                        <tr>
                                            <td>{{ $key + 1 }}</td>
                                            <td>{{ $database['pertanyaan'] }}</td>
                                            <td>
                                                <button class="detail-btn">Details</button>
                                            </td>
                                        </tr>
                                        <tr class="detail-content">
                                            <td colspan="3">
                                                <table>
                                                    <tbody>
                                                        <tr>
                                                            <td>Status</td>
                                                            <td>{{ $database['status'] }}</td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                <style>
                                    table {
                                        border-collapse: collapse;
                                        width: 100%;
                                    }

                                    table td,
                                    table th {
                                        border: 1px solid #ddd;
                                        padding: 8px;
                                        text-align: left;
                                    }

                                    table th {
                                        background-color: #f2f2f2;
                                    }

                                    .detail-content {
                                        display: none;
                                    }

                                    .detail-content table {
                                        margin-top: 10px;
                                    }

                                </style>

                                <script>
                                    const detailBtns = document.querySelectorAll('.detail-btn');

                                    detailBtns.forEach(btn => {
                                        btn.addEventListener('click', () => {
                                            const content = btn.parentNode.parentNode
                                                .nextElementSibling;
                                            content.style.display = content.style.display === 'none' ?
                                                'table-row' : 'none';
                                        });
                                    });

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
