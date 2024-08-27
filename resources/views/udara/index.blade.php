@extends('layouts.app')
@section('js')
        <script src="{{ $chartParameter1->cdn() }}"></script>
        {{ $chartParameter1->script() }}

        <script src="{{ $chartParameter2->cdn() }}"></script>
        {{ $chartParameter2->script() }}

        <script src="{{ $chartParameter3->cdn() }}"></script>
        {{ $chartParameter3->script() }}

        <script src="{{ $chartParameter4->cdn() }}"></script>
        {{ $chartParameter4->script() }}

        <script src="{{ $chartParameter5->cdn() }}"></script>
        {{ $chartParameter5->script() }}

        <script src="{{ $chartParameter6->cdn() }}"></script>
        {{ $chartParameter6->script() }}
@endsection


@push('css')
    <!-- DataTables -->
    <link rel="stylesheet" href="{{ asset('') }}plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="{{ asset('') }}plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
    <link rel="stylesheet" href="{{ asset('') }}plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
    <style>
        .card.card-primary.card-outline {
            border-color: #343A40; /* Mengubah warna garis tepi kartu */
        }
        #datatable-main thead th {
            background-color: #343A40; /* Warna latar belakang untuk sel header */
            color: white; /* Warna teks pada sel header */
        }
        
    </style>
@endpush
@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6 text-uppercase">
                <h4 class="m-0" style="font-weight: bold; font-size: 2em;">Data Kualitas Udara</h4>
                </div>
                <div class="container">
                <form method="GET" action="">
                    @csrf
                    <div class="form-row justify-content-end">
                        <div class="form-group col-md-2">
                            <label for="start_date">Start Date:</label>
                            <input type="date" class="form-control" id="start_date" name="start_date" required @if ($_GET['start_date'] != '')
                            value="{{$_GET['start_date']}}"
                            @endif>
                        </div>
                        <div class="form-group col-md-2">
                            <label for="end_date">End Date:</label>
                            <input type="date" class="form-control" id="end_date" name="end_date" required @if ($_GET['end_date'] != '')
                            value="{{$_GET['end_date']}}"
                            @endif>
                        </div>
                        <div class="form-group col-md-2 d-flex align-items-end">
                            <button type="submit" class="btn btn-primary w-100">Filter</button>
                        </div>
                    </div>
                </form>
                
                </div>
            </div>
        </div>
    </div>
    <section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-6">
                <!-- Baris Pertama -->
                <!-- Parameter 1 -->
                <div class="card card-primary card-outline">
                    <div class="card-header">
                        <h3 class="card-title">
                            <i class="far fa-chart-bar"></i>
                            Parameter PM 2.5
                        </h3>

                        <div class="card-tools">
                        </div>
                    </div>
                    <div class="card-body">
                        {!! $chartParameter1->container() !!} <!-- Hanya menampilkan chart jika ada data -->
                    </div>
                    <!-- /.card-body-->
                </div>
                <!-- /.card -->
            </div>
            <div class="col-md-6">
            <div class="card card-primary card-outline">
                        <div class="card-header">
                            <h3 class="card-title">
                                <i class="far fa-chart-bar"></i>
                                Parameter PM 10
                            </h3>

                            <div class="card-tools">
                            </div>
                        </div>
                        <div class="card-body">
                        {!! $chartParameter2->container() !!}
                        </div>
                        <!-- /.card-body-->
                    </div>
                    <!-- /.card -->
                    
            </div>
        </div>
        <!-- /.row -->
    <!-- Baris Kedua -->
    <div class="row mt-3">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-6 mb-3">
                    <!-- Parameter 2 -->
                    <div class="card card-primary card-outline">
                        <div class="card-header">
                            <h3 class="card-title">
                                <i class="far fa-chart-bar"></i>
                                Parameter NO2
                            </h3>

                            <div class="card-tools">
                            </div>
                        </div>
                        <div class="card-body">
                        {!! $chartParameter3->container() !!}
                        </div>
                        <!-- /.card-body-->
                    </div>
                    <!-- /.card -->
                </div>

                <div class="col-md-6 mb-3">
                    <!-- Parameter 3 -->
                    <div class="card card-primary card-outline">
                        <div class="card-header">
                            <h3 class="card-title">
                                <i class="far fa-chart-bar"></i>
                                Parameter O3
                            </h3>

                            <div class="card-tools">
                            </div>
                        </div>
                        <div class="card-body">
                        {!! $chartParameter4->container() !!}
                        </div>
                        <!-- /.card-body-->
                    </div>
                    <!-- /.card -->
                </div>
            </div>
        </div>
    </div>
        <!-- Baris Ketiga -->
        <div class="row mt-3">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-6 mb-3">
                    <!-- Parameter 4 -->
                    <div class="card card-primary card-outline">
                        <div class="card-header">
                            <h3 class="card-title">
                                <i class="far fa-chart-bar"></i>
                                Parameter CO
                            </h3>

                            <div class="card-tools">
                            </div>
                        </div>
                        <div class="card-body">
                        {!! $chartParameter5->container() !!}
                        </div>
                        <!-- /.card-body-->
                    </div>
                    <!-- /.card -->
                </div>

                <div class="col-md-6 mb-3">
                    <!-- Parameter 5 -->
                    <div class="card card-primary card-outline">
                        <div class="card-header">
                            <h3 class="card-title">
                                <i class="far fa-chart-bar"></i>
                                Parameter SO2
                            </h3>

                            <div class="card-tools">
                            </div>
                        </div>
                        <div class="card-body">
                        {!! $chartParameter6->container() !!}
                        </div>
                        <!-- /.card-body-->
                    </div>
                    <!-- /.card -->
                </div>
            </div>
        </div>
    </div>
        
</section>

    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-primary card-outline">
                        <div class="card-header">
                            <h5>Data Kualitas Udara</h5>
                            <h5 class="m-0"></h5>
                        </div>
                        <div class="card-body">

                            <table id="datatable-main" class="table table-bordered table-striped text-sm">
                                <thead>
                                    <th>No</th>
                                    <th>Tanggal</th>
                                    <th>Indeks</th>
                                    <th>Parameter</th>
                                    <th>Nilai Parameter</th>
                                    <th>Keterangan</th>
                                </thead>
                                <tbody>
                                @foreach ($histori_kualitas as $item)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $item->waktu }}</td>
                                            <td>{{ $item->id_parameter }}</td>
                                            <td>{{ $item->parameter_kualitas_udara->nama_parameter}}</td>
                                            <td>{{ $item->nilai_parameter}}</td>
                                            <td>{{ $item->keterangan}}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    
@endsection