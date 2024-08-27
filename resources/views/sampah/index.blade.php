@extends('layouts.app')
@section('js')
    <script src="{{ $histori_sampah->cdn() }}"></script>
    {{ $histori_sampah->script() }}

@endsection

    @push('css')
        <!-- DataTables -->
        <link rel="stylesheet" href="{{ asset('plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
        <link rel="stylesheet" href="{{ asset('plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
        <link rel="stylesheet" href="{{ asset('plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">
        <style>
            .card.card-primary.card-outline {
                border-color: #343A40;
            }
        
            
            #datatable-main thead th {
                background-color: #343A40;
                color: white;
            }
           
        </style>
    @endpush

@section('content')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6 text-uppercase">
                <h4 class="m-0" style="font-weight: bold; font-size: 2em;">Data Sampah</h4>
            </div>
            <div class="col-sm-6">
                <form method="GET" action="">
                    @csrf
                    <div class="form-row justify-content-end">
                        <div class="form-group col-md-3">
                            <label for="start_date">Start Date:</label>
                            <input type="date" class="form-control" id="start_date" name="start_date" required @if ($_GET['start_date'] != '')
                            value="{{$_GET['start_date']}}"
                            @endif>
                        </div>
                        <div class="form-group col-md-3">
                            <label for="end_date">End Date:</label>
                            <input type="date" class="form-control" id="end_date" name="end_date" required @if ($_GET['end_date'] != '')
                            value="{{$_GET['end_date']}}"
                            @endif>
                        </div>
                        <div class="form-group col-md-3 d-flex align-items-end">
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
            <!-- Kolom untuk bar chart -->
            <div class="col-md-12">
                <!-- BAR CHART -->
                <div class="card card-black">
                    <div class="card-header bg-black">
                        <h3 class="card-title">
                            <i class="far fa-chart-bar"></i>
                            Volume dan Ketinggian Sampah
                        </h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                <i class="fas fa-minus"></i>
                            </button>
                        </div>
                    </div>
                    <div class="card-body">
                        {!! $histori_sampah->container() !!}
                    </div>
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
                        </form>
                        <h5>Data Sampah</h5>
                        <h5 class="m-0"></h5>
                    </div>
                    <div class="card-body">
                        <table id="datatable-main" class="table table-bordered table-striped text-sm">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Tanggal</th>
                                    <th>Kawasan</th>
                                    <th>Ketinggian(m)</th>
                                    <th>Volume </th>
                                    <th>Keterangan</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($histori as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $item->waktu }}</td>
                                    <td>{{ $item->ReferensiAlat->kawasan->kode_kawasan }}</td>
                                    <td>{{ $item->ketinggian_sampah }}</td>
                                    <td>{{ $item->volume }}</td>
                                    <td>{{ $item->keterangan }}</td>
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

@push('scripts')
<!-- DataTables  & Plugins -->
<script src="{{ asset('plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
<script src="{{ asset('plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
<script src="{{ asset('plugins/datatables-buttons/js/dataTables.buttons.min.js') }}"></script>
<script src="{{ asset('plugins/datatables-buttons/js/buttons.bootstrap4.min.js') }}"></script>
<script>
        $function(){
            
            var barChartCanvas = $('#barChart').get(0).getContext('2d')
            var barChartData = $.extend(true, {}, areaChartData)
            var temp0 = areaChartData.datasets[0]
            var temp1 = areaChartData.datasets[1]
            barChartData.datasets[0] = temp1
            barChartData.datasets[1] = temp0

            var barChartOptions = {
                responsive              : true,
                maintainAspectRatio     : false,
                datasetFill             : false
            }

            new Chart(barChartCanvas, {
                type: 'bar',
                data: barChartData,
                options: barChartOptions
            })
        }
    </script>

@endpush