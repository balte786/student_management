@extends('layouts.main')

@section('content')
    <div class="main-content">
        <div class="breadcrumb">
            <h1 class="mr-2">{{ Auth::user()->school->school_name }}</h1>
            <ul>
                <li><a href="">Dashboard</a></li>
            </ul>
        </div>
        <div class="separator-breadcrumb border-top"></div>
        <div class="row">
            <div class="col-lg-6 col-md-12">
                <div class="row">
                    @foreach($quotas as $quota)
                    <div class="col-lg-4 col-md-6 col-sm-6">
                        <div class="card card-icon mb-4">
                            <div class="card-body text-center"><i class="i-Diploma-2"></i>
                                <p class="text-muted mt-2 mb-2">{{ $quota->year }} Quota</p>
                                <p class="text-primary text-50 line-height-1 m-0">{{ $quota->quota }}</p>
                            </div>
                        </div>
                    </div>
                    @endforeach

                </div>
            </div>

            <div class="col-lg-6 col-md-12">
                <div class="card mb-4">
                    <div class="card-body p-0">
                        <h5 class="card-title m-0 p-3">Yearly Quota</h5>
                        <div id="echart6" style="height: 300px"></div>
                    </div>
                </div>
            </div>




        </div>
        <!-- end of row-->

        <!-- end of main-content -->
        <!-- Footer Start -->
        <div class="flex-grow-1"></div>
        <div class="app-footer">
            <div class="row">
                <div class="col-md-9">
                    <!--<p><strong>Pharmacists Council of Nigeria</strong></p>
                    <p>The Pharmacists Council of Nigeria (PCN) is a Federal Government parastatal established by Act 91 of 1992 (Cap P17 LFN 2004) charged with the responsibility for regulating and controlling Pharmacy Education, Practice and Training in all aspects and ramifications.
                        <sunt></sunt>
                    </p>-->
                </div>
            </div>
            <div class="footer-bottom border-top pt-3 d-flex flex-column flex-sm-row align-items-center">

                <span class="flex-grow-1"></span>
                <div class="d-flex align-items-center">
                    <img class="logo" src="{{ asset('dist-assets/images/logo.png') }}" alt="">
                    <div>
                        <p class="m-0">&copy; 2021 Pharmacists Council of Nigeria</p>
                        <p class="m-0">All rights reserved</p>
                    </div>
                </div>
            </div>
        </div>
    <!-- fotter end -->
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>
        $(document).ready(function () {
            var echartElem4 = document.getElementById('echart6');

            if (echartElem4) {
                var echart4 = echarts.init(echartElem4);
                echart4.setOption(_objectSpread({}, echartOptions.lineNoAxis, {}, {
                    series: [{
                        data: [<?php echo implode(",", $yearly_quota)?>],
                        lineStyle: {
                            color: 'rgba(102, 51, 153, .86)',
                            width: 3,
                            shadowColor: 'rgba(0, 0, 0, .2)',
                            shadowOffsetX: -1,
                            shadowOffsetY: 8,
                            shadowBlur: 10
                        },
                        label: {
                            show: true,
                            color: '#212121'
                        },
                        type: 'line',
                        smooth: true,
                        itemStyle: {
                            borderColor: 'rgba(69, 86, 172, 0.86)'
                        }
                    }]
                }, {
                    xAxis: {
                        data: [<?php echo implode(",", $years)?>]
                    }
                }));
                $(window).on('resize', function () {
                    setTimeout(function () {
                        echart4.resize();
                    }, 500);
                });
            }
        });
    </script>
@endsection

