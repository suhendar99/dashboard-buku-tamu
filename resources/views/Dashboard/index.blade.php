@php
    // $now = \Carbon\Carbon::now();
    // $pengunjung_now = App\Models\Pengunjung::where('tanggal',$now)->count();
    $kunjung = App\Models\Pengunjung::all()->count();
    $sejak = App\Models\Pengunjung::orderBy('tanggal','asc')->first();
    // $sekarang = App\Models\Pengunjung::orderBy('tanggal','desc')->first();
    // dd($sejak);
    $pegawai = App\Models\Pegawai::all()->count();
    // $pegawai_now = App\Models\Pegawai::where('tanggal')->count();
@endphp
@extends('layouts.master')

@section('content')

     <!-- Begin Page Content -->
     <div class="container-fluid">

            <!-- Page Heading -->
            <div class="d-sm-flex align-items-center justify-content-between mb-4">
              <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
              {{-- <a href="" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Generate Report</a> --}}
            </div>

            <!-- Content Row -->
            <div class="row">

              <!-- Earnings (Monthly) Card Example -->
              <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-primary shadow h-100 py-2">
                  <div class="card-body">
                    <div class="row no-gutters align-items-center">
                      <div class="col mr-2">
                          <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Pengunjung</div>
                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Sejak {{ $sejak->tanggal }}</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $kunjung }}</div>
                      </div>
                      <div class="col-auto">
                        <i class="fas fa-calendar fa-2x text-gray-300"></i>
                      </div>
                    </div>
                  </div>
                </div>
              </div>

              <!-- Earnings (Monthly) Card Example -->
              <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-success shadow h-100 py-2">
                  <div class="card-body">
                    <div class="row no-gutters align-items-center">
                      <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Pengunjung Hari Ini</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $kunjung_now }}</div>
                      </div>
                      <div class="col-auto">
                        <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                      </div>
                    </div>
                  </div>
                </div>
              </div>

              <!-- Earnings (Monthly) Card Example -->
              <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-info shadow h-100 py-2">
                  <div class="card-body">
                    <div class="row no-gutters align-items-center">
                      <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Aktivitas Bulan Ini</div>
                        <div class="row no-gutters align-items-center">
                          <div class="col-auto">
                                <a href="/buku-tamu/pengunjung/antri" class="btn btn-primary">Cetak</a>
                                <a href="{{ route('aktivitas.store') }}" class="btn btn-primary">create</a>
                          </div>
                        </div>
                      </div>
                      <div class="col-auto">
                        <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                      </div>
                    </div>
                  </div>
                </div>
              </div>

              <!-- Pending Requests Card Example -->
              <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-warning shadow h-100 py-2">
                  <div class="card-body">
                    <div class="row no-gutters align-items-center">
                      <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Pegawai</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $pegawai }}</div>
                      </div>
                      <div class="col-auto">
                        <i class="fas fa-comments fa-2x text-gray-300"></i>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <!-- Content Row -->

            <div class="row">

              <!-- Area Chart -->
              <div class="col-xl-8 col-lg-7">
                <div class="card shadow mb-4">
                  <!-- Card Header - Dropdown -->
                  <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary"> Aktivitas 10 terakhir</h6>
                    <div class="dropdown no-arrow">
                    </div>
                  </div>
                  <!-- Card Body -->
                  <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="data_table" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Timestamps</th>
                                    <th>Name</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                  </div>
                </div>
              </div>

              <!-- Pie Chart -->
              <div class="col-xl-4 col-lg-5">
                <div class="card shadow mb-4">
                  <!-- Card Header - Dropdown -->
                  <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Gender</h6>
                  </div>
                  <!-- Card Body -->
                  <div class="card-body">
                    <div id="canvas-holder" style="width:100%">
                        <canvas id="chart-area"></canvas>
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-xl-12 col-lg-12">
                  <div class="card shadow">
                    <div class="card-header">
                        <h6 class="m-0 font-weight-bold text-primary">Pengunjung per-hari</h6>
                    </div>
                    <div class="card-body">
                        <div style="width:100%;">
                            <canvas id="canvas"></canvas>
                        </div>
                    </div>
                  </div>
              </div>
            </div>

          </div>
          <!-- /.container-fluid -->
@push('script')
    <script>

    let table = $('#data_table').DataTable({
        processing : true,
        serverSide : true,
        ordering : false,
        pageLength : 10,
        ajax : "{{ route('dashboard') }}",
        columns : [
            {data : 'DT_RowIndex', name: 'DT_RowIndex', searchable:false,orderable:false},
            {data : 'jadwal', name: 'jadwal'},
            {data : 'pengunjung.nama', name: 'id_pengunjung'},
        ]
    });

        var perempuan = '{{ $jk1 }}'
        var laki = '{{ $jk2 }}'
        // var total = perempuan + laki
		var config = {
			type: 'pie',
			data: {
				datasets: [{
					data: [
						// Math.round((laki/total * 100) + "%"),
                        laki,
						// Math.round((perempuan/total * 100) + "%"),
                        perempuan,
					],
					backgroundColor: [
						window.chartColors.red,
						window.chartColors.blue,
					],
				}],
				labels: [
					'Perempuan',
					'Laki Laki',
				]
			},
			options: {
				responsive: true
			}
		};

		window.onload = function() {
			var ctx = document.getElementById('chart-area').getContext('2d');
			window.myPie = new Chart(ctx, config);
		};

        var MONTHS = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];
		var config = {
			type: 'line',
			data: {
				labels: ['January', 'February', 'March', 'April', 'May', 'June', 'July'],
				datasets: [{
					label: 'My First dataset',
					backgroundColor: window.chartColors.red,
					borderColor: window.chartColors.red,
					data: [
						randomScalingFactor(),
						randomScalingFactor(),
						randomScalingFactor(),
						randomScalingFactor(),
						randomScalingFactor(),
						randomScalingFactor(),
						randomScalingFactor()
					],
					fill: false,
				}, {
					label: 'My Second dataset',
					fill: false,
					backgroundColor: window.chartColors.blue,
					borderColor: window.chartColors.blue,
					data: [
						randomScalingFactor(),
						randomScalingFactor(),
						randomScalingFactor(),
						randomScalingFactor(),
						randomScalingFactor(),
						randomScalingFactor(),
						randomScalingFactor()
					],
				}]
			},
			options: {
				responsive: true,
				title: {
					display: true,
					text: 'Chart.js Line Chart'
				},
				tooltips: {
					mode: 'index',
					intersect: false,
				},
				hover: {
					mode: 'nearest',
					intersect: true
				},
				scales: {
					xAxes: [{
						display: true,
						scaleLabel: {
							display: true,
							labelString: 'Month'
						}
					}],
					yAxes: [{
						display: true,
						scaleLabel: {
							display: true,
							labelString: 'Value'
						}
					}]
				}
			}
		};

		window.onload = function() {
			var ctx = document.getElementById('canvas').getContext('2d');
			window.myLine = new Chart(ctx, config);
		};
    </script>
@endpush
@endsection
