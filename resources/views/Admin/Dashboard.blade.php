@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12 mb-0">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                  <li class="breadcrumb-item"><a href="/admin/dashboard">Dashboard</a></li>
                </ol>
            </nav>
        </div>

        <div class="col-md-12">
            <div id="chart-container"></div>
        </div>
    </div>

    <div class="row my-4">
        <div class="col-md-4 mb-3">
            <div class="card border-0 card-job-seeker">
                <div class="card-body text-white">
                    <p>Pekerja</p>
                    <h5 class="text-center mx-5 bg-dark">{{ $count_users->user }}</h5>
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-3">
            <div class="card border-0 card-recruiter">
                <div class="card-body text-white">
                    <p>Rekruter</p>
                    <h5 class="text-center mx-5 bg-dark">{{ $count_users->recruiter }}</h5>
                </div>
            </div>
        </div>
        <div class="col-md-4 mb-3">
            <div class="card border-0 card-instation">
                <div class="card-body text-white">
                    <p>Instansi</p>
                    <h5 class="text-center mx-5 bg-dark">{{ $instation }}</h5>
                </div>
            </div>
        </div>
    </div>
</div>

@include('components/datatable')
@endsection

@section('js')
<script src="https://fastly.jsdelivr.net/npm/echarts@5.4.3/dist/echarts.min.js"></script>
<script>
    var dom = document.getElementById('chart-container');
    var myChart = echarts.init(dom, null, {
        renderer: 'canvas',
        useDirtyRect: false
    });
    var app = {};

    var option;

    option = {
    xAxis: {
        type: 'category',
        data: ['sen', 'sel', 'rab', 'sen', 'sel', 'rab']
    },
    yAxis: {
        type: 'value'
    },
    series: [
        {
        data: [{!! $grafik['value'] !!}],
        type: 'line',
        smooth: true
        }
    ]
    };

    if (option && typeof option === 'object') {
    myChart.setOption(option);
    }

    window.addEventListener('resize', myChart.resize);
</script>
@endsection

@section('css')
<style>
    #chart-container {
        position: relative;
        height: 30vh;
        overflow: hidden;
    }

    .card-job-seeker{
        background-color: #FF3CAC;
        background-image: linear-gradient(225deg, #FF3CAC 0%, #784BA0 50%, #2B86C5 100%);
    }
    
    .card-recruiter{
        background-color: #FF3CAC;
        background-image: linear-gradient(225deg, #3cff66 0%, #784BA0 50%, #2B86C5 100%);
    }
    .card-instation{
        background-color: #FF3CAC;
        background-image: linear-gradient(225deg, #ff3c3c 0%, #784BA0 50%, #2B86C5 100%);
    }

</style>
@endsection
