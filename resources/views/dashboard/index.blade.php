@extends('layouts.app')

@section('js')
<script src="{{ $dashboard1->cdn() }}"></script>
{{ $dashboard1->script() }}
<script src="{{ $dashboard2->cdn() }}"></script>
{{ $dashboard2->script() }}
<script src="{{ $dashboard3->cdn() }}"></script>
{{ $dashboard3->script() }}
<script src="{{ $dashboard4->cdn() }}"></script>
{{ $dashboard4->script() }}
<script src="{{ $dashboard5->cdn() }}"></script>
{{ $dashboard5->script() }}
@endsection

@push('css')
    <link rel="stylesheet" href="{{ asset('plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">
    <style>
        .card-body {
            padding: 20px;
            display: flex;
            flex-wrap: wrap;
        }

        .card-title {
            font-size: 18px;
            margin-bottom: 10px;
            font-weight: bold;
        }

        .card-title-2 {
            font-size: 16px;
            margin-bottom: 10px;
            font-style: italic;
        }

        .card-black table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        .card-black th,
        .card-black td {
            border: 1px solid #ddd;
            padding: 15px;
            text-align: left;
        }

        .card-black .card-child {
            flex: 1;
            padding: 20px;
            box-sizing: border-box;
        }



        .card-black .peta img {
            max-width: 100%;
            height: 30rem;
            object-fit: cover;
        }

        @media only screen and (max-width: 768px) {
            .card-black {
                padding: 10px;
                max-width: 90%;
            }

            .card-black .card-child {
                padding: 10px;
            }
        }

        .card-primary .card-header {
            padding: 20px;
            background-color: #fff;
            color: #000;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .today-card-content .card {
            width: 100%;
        }

        #map {
            height: 420px;
        }

        .card.card-primary.card-outline {
            border-color: #343A40;
        }
    </style>
@endpush

@section('content')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6 text-uppercase">
                <h4 class="m-0" style="font-weight: bold; font-size: 2em;">Dashboard</h4>
            </div>
        </div>
    </div>
</div>

<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card card-black">
                    <div class="card-body">
                        <div class="kawasan card-child">
                            <h5 class="card-title">Kawasan dengan tumpukan sampah tertinggi di TPA Jatibarang Semarang
                            </h5>
                            <table>
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Kawasan</th>
                                        <th>Indeks Tumpukan Sampah</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($statusKawasan as $historiKawasan)
                                        @foreach ($historiKawasan as $histori)
                                            <tr>
                                                <td>{{ $loop->parent->iteration }}</td>
                                                <td><a href="#">{{ $histori->kawasan->kode_kawasan }}</a></td> <!-- Menampilkan kode_kawasan -->
                                                <td>{{ $histori->status }}</td> <!-- Menampilkan status -->
                                            </tr>
                                        @endforeach
                                    @endforeach
                                </tbody>
                            </table>
                            <h6 class="card-title-2">Semakin tinggi tumpukan sampah, maka semakin buruk kualitas udara
                                di Kawasan tersebut</h6>
                        </div>
                        <div class="peta card-child">
                            <div id="map"></div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-12">
                <div class="card card-primary card-outline card-black">
                    <div class="card-header">
                        <h5 class="m-0">Prediksi Kualitas Udara</h5>
                    </div>
                    <div class="card-body">
                        {!! $dashboard1->container() !!}
                        {!! $dashboard2->container() !!}
                        {!! $dashboard3->container() !!}
                        {!! $dashboard4->container() !!}
                        {!! $dashboard5->container() !!}
                    </div>
                </div>
            </div>

            <div class="col-md-12">
                <div class="card card-primary card-outline">
                    <div class="card-header">
                        <h5>Data Sampah</h5>
                        <h5 class="m-0"></h5>
                    </div>
                    <div class="card-body">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Rentang</th>
                                    <th>Kategori</th>
                                    <th>Penjelasan</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>1 - 50</td>
                                    <td>Aman</td>
                                    <td>Tingkat mutu udara yang sangat baik, tidak memberikan efek negatif kepada
                                        manusia, hewan, dan tumbuhan</td>
                                </tr>
                                <tr>
                                    <td>51 - 100</td>
                                    <td>Sedang</td>
                                    <td>Tingkat mutu udara masih dapat diterima pada kesehatan manusia, hewan, dan
                                        tumbuhan</td>
                                </tr>
                                <tr>
                                    <td>101 - 200</td>
                                    <td>Tidak Aman</td>
                                    <td>Tingkat mutu udara yang bersifat merugikan pada manusia, hewan, dan tumbuhan
                                    </td>
                                </tr>
                                <tr>
                                    <td>201 - 300</td>
                                    <td>Sangat Tidak Sehat</td>
                                    <td>Tingkat mutu udara masih dapat meningkatkan resiko kesehatan pada sejumlah
                                        segmen populasi yang terpapar</td>
                                </tr>
                                <tr>
                                    <td>301+</td>
                                    <td>Berbahaya</td>
                                    <td>Tingkat mutu udara yang dapat merugikan kesehatan serius pada populasi dan perlu
                                        penanganan cepat</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>
@endsection

@push('js')
    <script>
        // Data dummy untuk kawasan sekitar TPA Jatibarang Semarang
        var kawasanData = [
            { id_kawasan: 1, name: 'Kawasan A', coords: [-7.024556, 110.360232] },
            { id_kawasan: 2, name: 'Kawasan B', coords: [-7.021556, 110.357232] },
            { id_kawasan: 3, name: 'Kawasan C', coords: [-7.023256, 110.356932] },
            { id_kawasan: 4, name: 'Kawasan D', coords: [-7.026556, 110.359232] },
            { id_kawasan: 5, name: 'Kawasan E', coords: [-7.028156, 110.359932] }
        ];

        // Data status kawasan dari backend
        var statusKawasan = {!! json_encode($statusKawasan) !!};

        // Gabungkan data status dengan data koordinat tetap
        kawasanData.forEach(function (kawasan) {
            var statusData = statusKawasan[kawasan.id_kawasan];
            kawasan.status = statusData ? statusData[0].status : 'Unknown';
        });

        // Inisialisasi peta
        var map = L.map('map').setView([-7.024556, 110.359232], 15);

        // Tambahkan tile layer dari OpenStreetMap
        L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
            maxZoom: 19,
            attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
        }).addTo(map);

        kawasanData.forEach(function (kawasan) {
            L.circle(kawasan.coords, {
                color: getStatusColor(kawasan.status),
                fillColor: getStatusColor(kawasan.status),
                fillOpacity: 0.5,
                radius: 20 // Ubah nilai radius di sini sesuai dengan preferensi Anda
            }).addTo(map).bindPopup('<b>' + kawasan.name + '</b><br>Status: ' + kawasan.status);
        });

        L.marker([-7.024556, 110.359232]).addTo(map)
            .bindPopup("<b>TPA Jatibarang</b><br>Tempat Pembuangan Sampah");

        // Fungsi untuk mendapatkan warna berdasarkan status
        function getStatusColor(status) {
            switch (status) {
                case 'Tinggi':
                    return 'red';
                case 'Sedang':
                    return 'yellow';
                case 'Rendah':
                    return 'green';
                default:
                    return 'gray';
            }
        }
    </script>
@endpush