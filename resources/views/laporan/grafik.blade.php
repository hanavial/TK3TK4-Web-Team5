@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row mb-4 px-3 align-items-center justify-content-between">
        <h4>Laporan Penjualan</h4>
        <div>
            @if (Auth::guard('admin')->check())
                <a class="btn btn-primary" href="{{ route('admin.laporan.index') }}">Lihat Data dalam Tabel</a>
            @elseif (Auth::guard('staff')->check())
                <a class="btn btn-primary" href="{{ route('staff.laporan.index') }}">Lihat Data dalam Tabel</a>
            @endif
        </div>
    </div>
    <div class="card">
        <div class="card-body">
          <div id="chartLaporan"></div>
        </div>
    </div>
</div>
@endsection

@section('script')
<script src="https://code.highcharts.com/highcharts.js"></script>
<script type="text/javascript">
    window.onload = function(){
        var jumlah = {!! json_encode($jumlah) !!};
        Highcharts.chart('chartLaporan', {
            chart: {
                type: 'column'
            },
            title: {
                text: 'Grafik Laporan Penjualan'
            },
            xAxis: {
                categories: {!! json_encode($nama_barang) !!},
                crosshair: true
            },
            yAxis: {
                min: 0,
                title: {
                    text: 'Laba'
                }
            },
            tooltip: {
                shared: true,
                useHTML: true,
                formatter: function() {
                    var dataTooltip = '<b>' + this.x + '</b>';
                    var dataPoint = 0;
                    $.each(this.points, function() {
                        var dataPoint = this.point.index
                        if (this.series.index == 0) {
                            dataTooltip += '<br/>Jumlah Barang Terjual : ' + jumlah[dataPoint];
                        }
                        dataTooltip += '<br/>' + this.series.name + ' : ' + this.y;
                    });
                    return dataTooltip;
                },
            },
            plotOptions: {
                column: {
                    pointPadding: 0.2,
                    borderWidth: 0
                }
            },
            series: [{
                name: 'Laba Bersih',
                color: '#1070D6',
                data: {!! json_encode($net) !!},
            },{
                name: 'Laba Kotor',
                color: '#2e3236',
                data: {!! json_encode($gross) !!},
            }]
        });
    }
</script>
@endsection
