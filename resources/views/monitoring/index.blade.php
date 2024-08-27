@extends('layouts.app')
@section('js')

<script src="{{ $parameter2->cdn() }}"></script>
{{ $parameter2->script() }}
@endsection
@push('css')
    <!-- Style -->
    <style>
        .inner p strong {
            font-weight: bold;
            font-size: 18px;
        }

        .inner h3 {
            font-size: 20px;
        }

        /* Warna latar belakang dan teks untuk setiap kotak */
        .small-box {
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            text-align: center;
            padding: 10px;
            border-radius: 10px;
        }

        .bg-volume {
            background-color: #5BA8A0;
            /* Warna biru */
            color: #fff;
            /* Warna teks putih */
        }

        .bg-ketinggian {
            background-color: #28a745;
            /* Warna hijau */
            color: #fff;
            /* Warna teks putih */
        }

        .bg-ratarata {
            background-color: #CBE54E;
            /* Warna kuning */
            color: #fff;
            /* Warna teks hitam */
        }

        /* Style untuk small box footer */
        .small-box-footer {
            padding: 10px;
            background-color: rgba(0, 0, 0, 0.2);
            /* Warna latar belakang transparan */
            color: #fff;
            /* Warna teks putih */
            font-size: 20px;
        }

        .card.card-primary.card-outline {
            border-color: #343A40;
        }

        .thick-border-table {
            height: 300px;
            overflow-y: auto;
        }

        /* Style untuk persentase perubahan */
        .positive-change {
            color: green;
            font-size: 0.6em;

        }

        .negative-change {
            color: red;
            font-size: 0.6em;
        }
    </style>
@endpush
@section('content')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6 text-uppercase">
                <h4 class="m-0" style="font-weight: bold; font-size: 2em;">Monitoring</h4>
            </div>
        </div>
    </div>
</div>

<section class="content">
    <div class="container-fluid">
        <!-- Small boxes (Start box) -->
        <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-6">
                <div class="small-box bg-volume">
                    <div class="inner">
                        <p><strong>Volume Sampah</strong></p>
                        <h3>{{ $rata_rata_volume}}<sup
                                class="{{ $selisih_volume >= 0 ? 'positive-change' : 'negative-change' }}">{{ $selisih_volume >= 0 ? '+' : '' }}{{ number_format($selisih_volume, 2) }}%</sup>
                        </h3>
                    </div>
                    <div class="small-box-footer">
                        (m&sup3;/tahun)
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-6">
                <div class="small-box bg-ketinggian">
                    <div class="inner">
                        <p><strong>Ketinggian Sampah</strong></p>
                        <h3>{{ $rata_rata_ketinggian}}<sup
                                class="{{ $selisih_ketinggian >= 0 ? 'positive-change' : 'negative-change' }}">
                                {{ $selisih_ketinggian >= 0 ? '+' : '' }}{{ number_format($selisih_ketinggian, 2) }}%
                            </sup></h3>
                    </div>
                    <div class="small-box-footer">
                        (meter/tahun)
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="content">
    <div class="container-fluid">
        <div class="row">
            <!-- Filter dan Bar Chart dalam satu Card -->
            <div class="col-md-12">
                <div class="card card-primary card-outline">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-4">
                                <div class="card d-flex justify-content-end">
                                    <!-- Konten lainnya -->
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <!-- Bar "Kualitas Udara" -->
                            <div class="col-sm-12 col-md-6">
                                <div class="card card-black">
                                    <div class="card-header bg-black">
                                        <h3 class="card-title">
                                            <i class="far fa-chart-bar"></i>
                                            Kualitas Udara
                                        </h3>
                                        <div class="card-tools">
                                            <button type="button" class="btn btn-tool" data-card-widget="collapse">
                                                <i class="fas fa-minus"></i>
                                            </button>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <div style="height: 360px; overflow-y: auto;">
                                            <table class="table table-bordered">
                                                <thead>
                                                    <tr>
                                                        <th>Parameter</th>
                                                        <th>Rata-Rata</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td>PM2.5</td>
                                                        <td>{{ $rata_rata_parameter['PM2_5'] }}</td>
                                                    </tr>
                                                    <tr>
                                                        <td>PM10</td>
                                                        <td>{{ $rata_rata_parameter['PM10'] }}</td>
                                                    </tr>
                                                    <tr>
                                                        <td>SO2</td>
                                                        <td>{{ $rata_rata_parameter['SO2'] }}</td>
                                                    </tr>
                                                    <tr>
                                                        <td>NO2</td>
                                                        <td>{{ $rata_rata_parameter['NO2'] }}</td>
                                                    </tr>
                                                    <tr>
                                                        <td>CO</td>
                                                        <td>{{ $rata_rata_parameter['CO'] }}</td>
                                                    </tr>
                                                    <tr>
                                                        <td>O3</td>
                                                        <td>{{ $rata_rata_parameter['O3'] }}</td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Bar Chart "Volume dan Ketinggian Sampah" -->
                            <div class="col-sm-12 col-md-6">
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
                                        {!! $parameter2->container() !!}
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Table di bawah grafik -->
                        <div class="row mt-3">
                            <div class="col-md-12">
                                <!-- Konten lainnya -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection