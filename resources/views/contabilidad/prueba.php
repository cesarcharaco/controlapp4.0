@extends('layouts.app')

@section('content')
    <style type="text/css">
      .apexcharts-legend {
        display: flex;
        overflow: auto;
        padding: 0 10px;
      }

      .apexcharts-legend.position-bottom, .apexcharts-legend.position-top {
        flex-wrap: wrap
      }
      .apexcharts-legend.position-right, .apexcharts-legend.position-left {
        flex-direction: column;
        bottom: 0;
      }

      .apexcharts-legend.position-bottom.left, .apexcharts-legend.position-top.left, .apexcharts-legend.position-right, .apexcharts-legend.position-left {
        justify-content: flex-start;
      }

      .apexcharts-legend.position-bottom.center, .apexcharts-legend.position-top.center {
        justify-content: center;  
      }

      .apexcharts-legend.position-bottom.right, .apexcharts-legend.position-top.right {
        justify-content: flex-end;
      }

      .apexcharts-legend-series {
        cursor: pointer;
        line-height: normal;
      }

      .apexcharts-legend.position-bottom .apexcharts-legend-series, .apexcharts-legend.position-top .apexcharts-legend-series{
        display: flex;
        align-items: center;
      }

      .apexcharts-legend-text {
        position: relative;
        font-size: 14px;
      }

      .apexcharts-legend-text *, .apexcharts-legend-marker * {
        pointer-events: none;
      }

      .apexcharts-legend-marker {
        position: relative;
        display: inline-block;
        cursor: pointer;
        margin-right: 3px;
      }
      
      .apexcharts-legend.right .apexcharts-legend-series, .apexcharts-legend.left .apexcharts-legend-series{
        display: inline-block;
      }

      .apexcharts-legend-series.no-click {
        cursor: auto;
      }

      .apexcharts-legend .apexcharts-hidden-zero-series, .apexcharts-legend .apexcharts-hidden-null-series {
        display: none !important;
      }

      .inactive-legend {
        opacity: 0.45;
      }
    </style>
     <style type="text/css">
        .card {
            border: 1px solid #f6f6f7!important;
            border-color: #CB8C4D !important;
        }
        .palabraVerContabilidad2, .palabraVerEstaciona2,.PalabraEditarPago2, .tituloTabla2
        {
            display: none;
        }
        @media only screen and (max-width: 800px)  {

            .PalabraEditarPago, .PalabraRealizarPago, .PalabraPagoConfirmar{
                display: none;
            }
            .palabraVerContabilidad{
                display: none;
            }
            .palabraVerContabilidad2{
                display: block;
            }
            .palabraVerEstaciona{
                display: none;
            }
            .palabraVerEstaciona2{
                display: block;
            }
            .PalabraEditarPago2{
                display: block;
            }
            .iconosMetaforas{
                display: none;    
            }
            .card-table{
                width: 100%
            }

        }
        @media only screen and (max-width: 200px)  {
            .botonesEditEli{
                width: 15px;
                height: 15px;
            }
            .iconosMetaforas2{
                width: 5px;
                height: 5px;    
            }
        }
        @media screen and (max-width: 480px) {
            .tituloTabla{
                display: none;
            }
            .tituloTabla2{
                display: block;
            }
            .iconosMetaforas2{
                width: 15px;
                height: 15px;    
            }
            .botonesEditEli{
                width: 30px;
                height: 30px;
                margin-top: 5px;
                    
            }
        }


    </style>
    <input type="hidden" id="colorView" value="#CB8C4D !important">
    <div class="container">
        <div class="row page-title">
            <div class="col-md-12">
                <nav aria-label="breadcrumb" class="float-right mt-1">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Balance General</li>
                    </ol>
                </nav>
                <h4 class="mb-1 mt-0">Balance General</h4>
            </div>
        </div>
        @include('flash::message')
        @if(count($errors))
            <div class="alert-list m-4">
                <div class="alert alert-danger alert-dismissible" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
                    <ul>
                        @foreach($errors->all() as $error)
                        <li>
                            {{$error}}
                        </li>
                        @endforeach

                    </ul>
                </div>
            </div>
        @endif
    </div>

    <div class="row">
        
    </div>
    <div class="card rounded card-tabla shadow p-3 mb-5 bg-white rounded" style="display: none;">
        <div class="row justify-content-center">        
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body" style="position: relative;">
                        <h4 class="header-title mt-0 mb-3">Basic Column Chart</h4>

                        <div id="apex-column-1" class="apex-charts" dir="ltr" style="min-height: 380px;">
                            <div id="apexcharts4huzlsld" class="apexcharts-canvas apexcharts4huzlsld light" style="width: 853px; height: 380px;">
                                <svg id="SvgjsSvg6934" width="853" height="380" xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:svgjs="http://svgjs.com/svgjs" class="apexcharts-svg" xmlns:data="ApexChartsNS" transform="translate(0, 0)" style="background: transparent;">
                                    <foreignObject x="0" y="0" width="853" height="380">
                                        <div class="apexcharts-legend center position-bottom" xmlns="http://www.w3.org/1999/xhtml" style="right: 0px; position: absolute; left: 0px; top: auto; bottom: 0px;">
                                            <div class="apexcharts-legend-series" rel="1" data:collapsed="false" style="margin: 0px 5px;">
                                                <span class="apexcharts-legend-marker" rel="1" data:collapsed="false" style="background: rgb(83, 105, 248); color: rgb(83, 105, 248); height: 12px; width: 12px; left: 0px; top: 0px; border-width: 0px; border-color: rgb(255, 255, 255); border-radius: 2px;"></span>
                                                <span class="apexcharts-legend-text" rel="1" data:collapsed="false" style="color: rgb(55, 61, 63); font-size: 12px; font-family: Helvetica, Arial, sans-serif;">Net Profit</span>
                                            </div>
                                            <div class="apexcharts-legend-series" rel="2" data:collapsed="false" style="margin: 0px 5px;">
                                                <span class="apexcharts-legend-marker" rel="2" data:collapsed="false" style="background: rgb(67, 211, 158); color: rgb(67, 211, 158); height: 12px; width: 12px; left: 0px; top: 0px; border-width: 0px; border-color: rgb(255, 255, 255); border-radius: 2px;"></span>
                                                <span class="apexcharts-legend-text" rel="2" data:collapsed="false" style="color: rgb(55, 61, 63); font-size: 12px; font-family: Helvetica, Arial, sans-serif;">Revenue</span>
                                            </div>
                                            <div class="apexcharts-legend-series" rel="3" data:collapsed="false" style="margin: 0px 5px;">
                                                <span class="apexcharts-legend-marker" rel="3" data:collapsed="false" style="background: rgb(247, 126, 83); color: rgb(247, 126, 83); height: 12px; width: 12px; left: 0px; top: 0px; border-width: 0px; border-color: rgb(255, 255, 255); border-radius: 2px;"></span>
                                                <span class="apexcharts-legend-text" rel="3" data:collapsed="false" style="color: rgb(55, 61, 63); font-size: 12px; font-family: Helvetica, Arial, sans-serif;">Free Cash Flow</span>
                                            </div>
                                        </div>
                                    </foreignObject>




                                    <g id="SvgjsG6936" class="apexcharts-inner apexcharts-graphical" transform="translate(65.546875, 40)">
                                        <defs id="SvgjsDefs6935">
                                            <linearGradient id="SvgjsLinearGradient6940" x1="0" y1="0" x2="0" y2="1">
                                                <stop id="SvgjsStop6941" stop-opacity="0.4" stop-color="rgba(216,227,240,0.4)" offset="0"></stop>
                                                <stop id="SvgjsStop6942" stop-opacity="0.5" stop-color="rgba(190,209,230,0.5)" offset="1"></stop>
                                                <stop id="SvgjsStop6943" stop-opacity="0.5" stop-color="rgba(190,209,230,0.5)" offset="1"></stop>
                                            </linearGradient>
                                            <clipPath id="gridRectMask4huzlsld">
                                                <rect id="SvgjsRect6945" width="789.453125" height="282.61199999999997" x="-1" y="-1" rx="0" ry="0" fill="#ffffff" opacity="1" stroke-width="0" stroke="none" stroke-dasharray="0"></rect>
                                            </clipPath>
                                            <clipPath id="gridRectMarkerMask4huzlsld">
                                                <rect id="SvgjsRect6946" width="789.453125" height="282.61199999999997" x="-1" y="-1" rx="0" ry="0" fill="#ffffff" opacity="1" stroke-width="0" stroke="none" stroke-dasharray="0"></rect>
                                            </clipPath>
                                        </defs>
    <rect id="SvgjsRect6944" width="16.040711805555556" height="280.61199999999997" x="559.0051976415847" y="0" rx="0" ry="0" fill="url(#SvgjsLinearGradient6940)" opacity="1" stroke-width="0" stroke-dasharray="3" class="apexcharts-xcrosshairs" y2="280.61199999999997" filter="none" fill-opacity="0.9" x1="559.0051976415847" x2="559.0051976415847"></rect><g id="SvgjsG6982" class="apexcharts-xaxis" transform="translate(0, 0)"><g id="SvgjsG6983" class="apexcharts-xaxis-texts-g" transform="translate(0, -4)"><text id="SvgjsText6984" font-family="Helvetica, Arial, sans-serif" x="43.747395833333336" y="309.61199999999997" text-anchor="middle" dominant-baseline="auto" font-size="12px" font-weight="400" fill="#373d3f" class="apexcharts-xaxis-label " style="font-family: Helvetica, Arial, sans-serif;"><tspan id="SvgjsTspan6985" style="font-family: Helvetica, Arial, sans-serif;">Feb</tspan><title>Feb</title></text><text id="SvgjsText6986" font-family="Helvetica, Arial, sans-serif" x="131.2421875" y="309.61199999999997" text-anchor="middle" dominant-baseline="auto" font-size="12px" font-weight="400" fill="#373d3f" class="apexcharts-xaxis-label " style="font-family: Helvetica, Arial, sans-serif;"><tspan id="SvgjsTspan6987" style="font-family: Helvetica, Arial, sans-serif;">Mar</tspan><title>Mar</title></text><text id="SvgjsText6988" font-family="Helvetica, Arial, sans-serif" x="218.73697916666666" y="309.61199999999997" text-anchor="middle" dominant-baseline="auto" font-size="12px" font-weight="400" fill="#373d3f" class="apexcharts-xaxis-label " style="font-family: Helvetica, Arial, sans-serif;"><tspan id="SvgjsTspan6989" style="font-family: Helvetica, Arial, sans-serif;">Apr</tspan><title>Apr</title></text><text id="SvgjsText6990" font-family="Helvetica, Arial, sans-serif" x="306.23177083333337" y="309.61199999999997" text-anchor="middle" dominant-baseline="auto" font-size="12px" font-weight="400" fill="#373d3f" class="apexcharts-xaxis-label " style="font-family: Helvetica, Arial, sans-serif;"><tspan id="SvgjsTspan6991" style="font-family: Helvetica, Arial, sans-serif;">May</tspan><title>May</title></text><text id="SvgjsText6992" font-family="Helvetica, Arial, sans-serif" x="393.72656250000006" y="309.61199999999997" text-anchor="middle" dominant-baseline="auto" font-size="12px" font-weight="400" fill="#373d3f" class="apexcharts-xaxis-label " style="font-family: Helvetica, Arial, sans-serif;"><tspan id="SvgjsTspan6993" style="font-family: Helvetica, Arial, sans-serif;">Jun</tspan><title>Jun</title></text><text id="SvgjsText6994" font-family="Helvetica, Arial, sans-serif" x="481.2213541666667" y="309.61199999999997" text-anchor="middle" dominant-baseline="auto" font-size="12px" font-weight="400" fill="#373d3f" class="apexcharts-xaxis-label " style="font-family: Helvetica, Arial, sans-serif;"><tspan id="SvgjsTspan6995" style="font-family: Helvetica, Arial, sans-serif;">Jul</tspan><title>Jul</title></text><text id="SvgjsText6996" font-family="Helvetica, Arial, sans-serif" x="568.7161458333333" y="309.61199999999997" text-anchor="middle" dominant-baseline="auto" font-size="12px" font-weight="400" fill="#373d3f" class="apexcharts-xaxis-label " style="font-family: Helvetica, Arial, sans-serif;"><tspan id="SvgjsTspan6997" style="font-family: Helvetica, Arial, sans-serif;">Aug</tspan><title>Aug</title></text><text id="SvgjsText6998" font-family="Helvetica, Arial, sans-serif" x="656.2109374999999" y="309.61199999999997" text-anchor="middle" dominant-baseline="auto" font-size="12px" font-weight="400" fill="#373d3f" class="apexcharts-xaxis-label " style="font-family: Helvetica, Arial, sans-serif;"><tspan id="SvgjsTspan6999" style="font-family: Helvetica, Arial, sans-serif;">Sep</tspan><title>Sep</title></text><text id="SvgjsText7000" font-family="Helvetica, Arial, sans-serif" x="743.7057291666665" y="309.61199999999997" text-anchor="middle" dominant-baseline="auto" font-size="12px" font-weight="400" fill="#373d3f" class="apexcharts-xaxis-label " style="font-family: Helvetica, Arial, sans-serif;"><tspan id="SvgjsTspan7001" style="font-family: Helvetica, Arial, sans-serif;">Oct</tspan><title>Oct</title></text></g><line id="SvgjsLine7002" x1="0" y1="281.61199999999997" x2="787.453125" y2="281.61199999999997" stroke="#d6ddea" stroke-dasharray="0" stroke-width="1"></line></g><g id="SvgjsG7012" class="apexcharts-grid"><g id="SvgjsG7013" class="apexcharts-gridlines-horizontal"><line id="SvgjsLine7023" x1="0" y1="0" x2="787.453125" y2="0" stroke="#f1f3fa" stroke-dasharray="0" class="apexcharts-gridline"></line><line id="SvgjsLine7024" x1="0" y1="70.15299999999999" x2="787.453125" y2="70.15299999999999" stroke="#f1f3fa" stroke-dasharray="0" class="apexcharts-gridline"></line><line id="SvgjsLine7025" x1="0" y1="140.30599999999998" x2="787.453125" y2="140.30599999999998" stroke="#f1f3fa" stroke-dasharray="0" class="apexcharts-gridline"></line><line id="SvgjsLine7026" x1="0" y1="210.45899999999997" x2="787.453125" y2="210.45899999999997" stroke="#f1f3fa" stroke-dasharray="0" class="apexcharts-gridline"></line><line id="SvgjsLine7027" x1="0" y1="280.61199999999997" x2="787.453125" y2="280.61199999999997" stroke="#f1f3fa" stroke-dasharray="0" class="apexcharts-gridline"></line></g><g id="SvgjsG7014" class="apexcharts-gridlines-vertical"></g><line id="SvgjsLine7015" x1="87.49479166666667" y1="281.61199999999997" x2="87.49479166666667" y2="287.61199999999997" stroke="#d6ddea" stroke-dasharray="0" class="apexcharts-xaxis-tick"></line><line id="SvgjsLine7016" x1="174.98958333333334" y1="281.61199999999997" x2="174.98958333333334" y2="287.61199999999997" stroke="#d6ddea" stroke-dasharray="0" class="apexcharts-xaxis-tick"></line><line id="SvgjsLine7017" x1="262.484375" y1="281.61199999999997" x2="262.484375" y2="287.61199999999997" stroke="#d6ddea" stroke-dasharray="0" class="apexcharts-xaxis-tick"></line><line id="SvgjsLine7018" x1="349.9791666666667" y1="281.61199999999997" x2="349.9791666666667" y2="287.61199999999997" stroke="#d6ddea" stroke-dasharray="0" class="apexcharts-xaxis-tick"></line><line id="SvgjsLine7019" x1="437.47395833333337" y1="281.61199999999997" x2="437.47395833333337" y2="287.61199999999997" stroke="#d6ddea" stroke-dasharray="0" class="apexcharts-xaxis-tick"></line><line id="SvgjsLine7020" x1="524.96875" y1="281.61199999999997" x2="524.96875" y2="287.61199999999997" stroke="#d6ddea" stroke-dasharray="0" class="apexcharts-xaxis-tick"></line><line id="SvgjsLine7021" x1="612.4635416666666" y1="281.61199999999997" x2="612.4635416666666" y2="287.61199999999997" stroke="#d6ddea" stroke-dasharray="0" class="apexcharts-xaxis-tick"></line><line id="SvgjsLine7022" x1="699.9583333333333" y1="281.61199999999997" x2="699.9583333333333" y2="287.61199999999997" stroke="#d6ddea" stroke-dasharray="0" class="apexcharts-xaxis-tick"></line><rect id="SvgjsRect7028" width="787.453125" height="70.15299999999999" x="0" y="0" rx="0" ry="0" fill="transparent" opacity="0.2" stroke-width="0" stroke="none" stroke-dasharray="0" class="apexcharts-gridRow"></rect><rect id="SvgjsRect7029" width="787.453125" height="70.15299999999999" x="0" y="70.15299999999999" rx="0" ry="0" fill="transparent" opacity="0.2" stroke-width="0" stroke="none" stroke-dasharray="0" class="apexcharts-gridRow"></rect><rect id="SvgjsRect7030" width="787.453125" height="70.15299999999999" x="0" y="140.30599999999998" rx="0" ry="0" fill="transparent" opacity="0.2" stroke-width="0" stroke="none" stroke-dasharray="0" class="apexcharts-gridRow"></rect><rect id="SvgjsRect7031" width="787.453125" height="70.15299999999999" x="0" y="210.45899999999997" rx="0" ry="0" fill="transparent" opacity="0.2" stroke-width="0" stroke="none" stroke-dasharray="0" class="apexcharts-gridRow"></rect><line id="SvgjsLine7033" x1="0" y1="280.61199999999997" x2="787.453125" y2="280.61199999999997" stroke="transparent" stroke-dasharray="0"></line><line id="SvgjsLine7032" x1="0" y1="1" x2="0" y2="280.61199999999997" stroke="transparent" stroke-dasharray="0"></line></g><g id="SvgjsG6948" class="apexcharts-bar-series apexcharts-plot-series"><g id="SvgjsG6949" class="apexcharts-series" rel="1" seriesName="NetxProfit" data:realIndex="0"><path id="SvgjsPath6951" d="M 19.686328125000003 280.61199999999997L 19.686328125000003 180.7311112847222Q 26.706684027777783 174.71075538194444 33.72703993055556 180.7311112847222L 33.72703993055556 280.61199999999997L 18.686328125000003 280.61199999999997" fill="rgba(83,105,248,0.85)" fill-opacity="1" stroke="transparent" stroke-opacity="1" stroke-linecap="butt" stroke-width="2" stroke-dasharray="0" class="apexcharts-bar-area" index="0" clip-path="url(#gridRectMask4huzlsld)" pathTo="M 19.686328125000003 280.61199999999997L 19.686328125000003 180.7311112847222Q 26.706684027777783 174.71075538194444 33.72703993055556 180.7311112847222L 33.72703993055556 280.61199999999997L 18.686328125000003 280.61199999999997" pathFrom="M 19.686328125000003 280.61199999999997L 19.686328125000003 280.61199999999997L 33.72703993055556 280.61199999999997L 33.72703993055556 280.61199999999997L 18.686328125000003 280.61199999999997" cy="177.7209333333333" cx="106.18111979166667" j="0" val="44" barHeight="102.89106666666666" barWidth="16.040711805555556"></path><path id="SvgjsPath6952" d="M 107.18111979166667 280.61199999999997L 107.18111979166667 155.00834461805553Q 114.20147569444445 148.98798871527777 121.22183159722223 155.00834461805553L 121.22183159722223 280.61199999999997L 106.18111979166667 280.61199999999997" fill="rgba(83,105,248,0.85)" fill-opacity="1" stroke="transparent" stroke-opacity="1" stroke-linecap="butt" stroke-width="2" stroke-dasharray="0" class="apexcharts-bar-area" index="0" clip-path="url(#gridRectMask4huzlsld)" pathTo="M 107.18111979166667 280.61199999999997L 107.18111979166667 155.00834461805553Q 114.20147569444445 148.98798871527777 121.22183159722223 155.00834461805553L 121.22183159722223 280.61199999999997L 106.18111979166667 280.61199999999997" pathFrom="M 107.18111979166667 280.61199999999997L 107.18111979166667 280.61199999999997L 121.22183159722223 280.61199999999997L 121.22183159722223 280.61199999999997L 106.18111979166667 280.61199999999997" cy="151.99816666666663" cx="193.67591145833336" j="1" val="55" barHeight="128.61383333333333" barWidth="16.040711805555556"></path><path id="SvgjsPath6953" d="M 194.67591145833336 280.61199999999997L 194.67591145833336 150.33147795138888Q 201.69626736111113 144.3111220486111 208.71662326388892 150.33147795138888L 208.71662326388892 280.61199999999997L 193.67591145833336 280.61199999999997" fill="rgba(83,105,248,0.85)" fill-opacity="1" stroke="transparent" stroke-opacity="1" stroke-linecap="butt" stroke-width="2" stroke-dasharray="0" class="apexcharts-bar-area" index="0" clip-path="url(#gridRectMask4huzlsld)" pathTo="M 194.67591145833336 280.61199999999997L 194.67591145833336 150.33147795138888Q 201.69626736111113 144.3111220486111 208.71662326388892 150.33147795138888L 208.71662326388892 280.61199999999997L 193.67591145833336 280.61199999999997" pathFrom="M 194.67591145833336 280.61199999999997L 194.67591145833336 280.61199999999997L 208.71662326388892 280.61199999999997L 208.71662326388892 280.61199999999997L 193.67591145833336 280.61199999999997" cy="147.32129999999998" cx="281.17070312500005" j="2" val="57" barHeight="133.2907" barWidth="16.040711805555556"></path><path id="SvgjsPath6954" d="M 282.17070312500005 280.61199999999997L 282.17070312500005 152.66991128472222Q 289.19105902777784 146.64955538194445 296.2114149305556 152.66991128472222L 296.2114149305556 280.61199999999997L 281.17070312500005 280.61199999999997" fill="rgba(83,105,248,0.85)" fill-opacity="1" stroke="transparent" stroke-opacity="1" stroke-linecap="butt" stroke-width="2" stroke-dasharray="0" class="apexcharts-bar-area" index="0" clip-path="url(#gridRectMask4huzlsld)" pathTo="M 282.17070312500005 280.61199999999997L 282.17070312500005 152.66991128472222Q 289.19105902777784 146.64955538194445 296.2114149305556 152.66991128472222L 296.2114149305556 280.61199999999997L 281.17070312500005 280.61199999999997" pathFrom="M 282.17070312500005 280.61199999999997L 282.17070312500005 280.61199999999997L 296.2114149305556 280.61199999999997L 296.2114149305556 280.61199999999997L 281.17070312500005 280.61199999999997" cy="149.65973333333332" cx="368.66549479166673" j="3" val="56" barHeight="130.95226666666665" barWidth="16.040711805555556"></path><path id="SvgjsPath6955" d="M 369.66549479166673 280.61199999999997L 369.66549479166673 140.97774461805554Q 376.6858506944445 134.95738871527777 383.70620659722226 140.97774461805554L 383.70620659722226 280.61199999999997L 368.66549479166673 280.61199999999997" fill="rgba(83,105,248,0.85)" fill-opacity="1" stroke="transparent" stroke-opacity="1" stroke-linecap="butt" stroke-width="2" stroke-dasharray="0" class="apexcharts-bar-area" index="0" clip-path="url(#gridRectMask4huzlsld)" pathTo="M 369.66549479166673 280.61199999999997L 369.66549479166673 140.97774461805554Q 376.6858506944445 134.95738871527777 383.70620659722226 140.97774461805554L 383.70620659722226 280.61199999999997L 368.66549479166673 280.61199999999997" pathFrom="M 369.66549479166673 280.61199999999997L 369.66549479166673 280.61199999999997L 383.70620659722226 280.61199999999997L 383.70620659722226 280.61199999999997L 368.66549479166673 280.61199999999997" cy="137.96756666666664" cx="456.1602864583334" j="4" val="61" barHeight="142.64443333333332" barWidth="16.040711805555556"></path><path id="SvgjsPath6956" d="M 457.1602864583334 280.61199999999997L 457.1602864583334 147.99304461805554Q 464.1806423611112 141.97268871527777 471.20099826388895 147.99304461805554L 471.20099826388895 280.61199999999997L 456.1602864583334 280.61199999999997" fill="rgba(83,105,248,0.85)" fill-opacity="1" stroke="transparent" stroke-opacity="1" stroke-linecap="butt" stroke-width="2" stroke-dasharray="0" class="apexcharts-bar-area" index="0" clip-path="url(#gridRectMask4huzlsld)" pathTo="M 457.1602864583334 280.61199999999997L 457.1602864583334 147.99304461805554Q 464.1806423611112 141.97268871527777 471.20099826388895 147.99304461805554L 471.20099826388895 280.61199999999997L 456.1602864583334 280.61199999999997" pathFrom="M 457.1602864583334 280.61199999999997L 457.1602864583334 280.61199999999997L 471.20099826388895 280.61199999999997L 471.20099826388895 280.61199999999997L 456.1602864583334 280.61199999999997" cy="144.98286666666664" cx="543.655078125" j="5" val="58" barHeight="135.62913333333333" barWidth="16.040711805555556"></path><path id="SvgjsPath6957" d="M 544.655078125 280.61199999999997L 544.655078125 136.30087795138888Q 551.6754340277778 130.28052204861112 558.6957899305556 136.30087795138888L 558.6957899305556 280.61199999999997L 543.655078125 280.61199999999997" fill="rgba(83,105,248,0.85)" fill-opacity="1" stroke="transparent" stroke-opacity="1" stroke-linecap="butt" stroke-width="2" stroke-dasharray="0" class="apexcharts-bar-area" index="0" clip-path="url(#gridRectMask4huzlsld)" pathTo="M 544.655078125 280.61199999999997L 544.655078125 136.30087795138888Q 551.6754340277778 130.28052204861112 558.6957899305556 136.30087795138888L 558.6957899305556 280.61199999999997L 543.655078125 280.61199999999997" pathFrom="M 544.655078125 280.61199999999997L 544.655078125 280.61199999999997L 558.6957899305556 280.61199999999997L 558.6957899305556 280.61199999999997L 543.655078125 280.61199999999997" cy="133.2907" cx="631.1498697916667" j="6" val="63" barHeight="147.32129999999998" barWidth="16.040711805555556"></path><path id="SvgjsPath6958" d="M 632.1498697916667 280.61199999999997L 632.1498697916667 143.31617795138888Q 639.1702256944444 137.29582204861111 646.1905815972223 143.31617795138888L 646.1905815972223 280.61199999999997L 631.1498697916667 280.61199999999997" fill="rgba(83,105,248,0.85)" fill-opacity="1" stroke="transparent" stroke-opacity="1" stroke-linecap="butt" stroke-width="2" stroke-dasharray="0" class="apexcharts-bar-area" index="0" clip-path="url(#gridRectMask4huzlsld)" pathTo="M 632.1498697916667 280.61199999999997L 632.1498697916667 143.31617795138888Q 639.1702256944444 137.29582204861111 646.1905815972223 143.31617795138888L 646.1905815972223 280.61199999999997L 631.1498697916667 280.61199999999997" pathFrom="M 632.1498697916667 280.61199999999997L 632.1498697916667 280.61199999999997L 646.1905815972223 280.61199999999997L 646.1905815972223 280.61199999999997L 631.1498697916667 280.61199999999997" cy="140.30599999999998" cx="718.6446614583333" j="7" val="60" barHeight="140.30599999999998" barWidth="16.040711805555556"></path><path id="SvgjsPath6959" d="M 719.6446614583333 280.61199999999997L 719.6446614583333 129.2855779513889Q 726.665017361111 123.26522204861111 733.6853732638889 129.2855779513889L 733.6853732638889 280.61199999999997L 718.6446614583333 280.61199999999997" fill="rgba(83,105,248,0.85)" fill-opacity="1" stroke="transparent" stroke-opacity="1" stroke-linecap="butt" stroke-width="2" stroke-dasharray="0" class="apexcharts-bar-area" index="0" clip-path="url(#gridRectMask4huzlsld)" pathTo="M 719.6446614583333 280.61199999999997L 719.6446614583333 129.2855779513889Q 726.665017361111 123.26522204861111 733.6853732638889 129.2855779513889L 733.6853732638889 280.61199999999997L 718.6446614583333 280.61199999999997" pathFrom="M 719.6446614583333 280.61199999999997L 719.6446614583333 280.61199999999997L 733.6853732638889 280.61199999999997L 733.6853732638889 280.61199999999997L 718.6446614583333 280.61199999999997" cy="126.27539999999999" cx="806.1394531249999" j="8" val="66" barHeight="154.33659999999998" barWidth="16.040711805555556"></path><g id="SvgjsG6950" class="apexcharts-datalabels"></g></g><g id="SvgjsG6960" class="apexcharts-series" rel="2" seriesName="Revenue" data:realIndex="1"><path id="SvgjsPath6962" d="M 35.72703993055556 280.61199999999997L 35.72703993055556 105.90124461805554Q 42.74739583333334 99.88088871527776 49.76775173611112 105.90124461805554L 49.76775173611112 280.61199999999997L 34.72703993055556 280.61199999999997" fill="rgba(67,211,158,0.85)" fill-opacity="1" stroke="transparent" stroke-opacity="1" stroke-linecap="butt" stroke-width="2" stroke-dasharray="0" class="apexcharts-bar-area" index="1" clip-path="url(#gridRectMask4huzlsld)" pathTo="M 35.72703993055556 280.61199999999997L 35.72703993055556 105.90124461805554Q 42.74739583333334 99.88088871527776 49.76775173611112 105.90124461805554L 49.76775173611112 280.61199999999997L 34.72703993055556 280.61199999999997" pathFrom="M 35.72703993055556 280.61199999999997L 35.72703993055556 280.61199999999997L 49.76775173611112 280.61199999999997L 49.76775173611112 280.61199999999997L 34.72703993055556 280.61199999999997" cy="102.89106666666666" cx="122.22183159722223" j="0" val="76" barHeight="177.7209333333333" barWidth="16.040711805555556"></path><path id="SvgjsPath6963" d="M 123.22183159722223 280.61199999999997L 123.22183159722223 84.85534461805553Q 130.2421875 78.83498871527775 137.2625434027778 84.85534461805553L 137.2625434027778 280.61199999999997L 122.22183159722223 280.61199999999997" fill="rgba(67,211,158,0.85)" fill-opacity="1" stroke="transparent" stroke-opacity="1" stroke-linecap="butt" stroke-width="2" stroke-dasharray="0" class="apexcharts-bar-area" index="1" clip-path="url(#gridRectMask4huzlsld)" pathTo="M 123.22183159722223 280.61199999999997L 123.22183159722223 84.85534461805553Q 130.2421875 78.83498871527775 137.2625434027778 84.85534461805553L 137.2625434027778 280.61199999999997L 122.22183159722223 280.61199999999997" pathFrom="M 123.22183159722223 280.61199999999997L 123.22183159722223 280.61199999999997L 137.2625434027778 280.61199999999997L 137.2625434027778 280.61199999999997L 122.22183159722223 280.61199999999997" cy="81.84516666666664" cx="209.71662326388892" j="1" val="85" barHeight="198.76683333333332" barWidth="16.040711805555556"></path><path id="SvgjsPath6964" d="M 210.71662326388892 280.61199999999997L 210.71662326388892 47.44041128472221Q 217.73697916666669 41.42005538194443 224.75733506944448 47.44041128472221L 224.75733506944448 280.61199999999997L 209.71662326388892 280.61199999999997" fill="rgba(67,211,158,0.85)" fill-opacity="1" stroke="transparent" stroke-opacity="1" stroke-linecap="butt" stroke-width="2" stroke-dasharray="0" class="apexcharts-bar-area" index="1" clip-path="url(#gridRectMask4huzlsld)" pathTo="M 210.71662326388892 280.61199999999997L 210.71662326388892 47.44041128472221Q 217.73697916666669 41.42005538194443 224.75733506944448 47.44041128472221L 224.75733506944448 280.61199999999997L 209.71662326388892 280.61199999999997" pathFrom="M 210.71662326388892 280.61199999999997L 210.71662326388892 280.61199999999997L 224.75733506944448 280.61199999999997L 224.75733506944448 280.61199999999997L 209.71662326388892 280.61199999999997" cy="44.43023333333332" cx="297.2114149305556" j="2" val="101" barHeight="236.18176666666665" barWidth="16.040711805555556"></path><path id="SvgjsPath6965" d="M 298.2114149305556 280.61199999999997L 298.2114149305556 54.455711284722206Q 305.23177083333337 48.435355381944426 312.2521267361111 54.455711284722206L 312.2521267361111 280.61199999999997L 297.2114149305556 280.61199999999997" fill="rgba(67,211,158,0.85)" fill-opacity="1" stroke="transparent" stroke-opacity="1" stroke-linecap="butt" stroke-width="2" stroke-dasharray="0" class="apexcharts-bar-area" index="1" clip-path="url(#gridRectMask4huzlsld)" pathTo="M 298.2114149305556 280.61199999999997L 298.2114149305556 54.455711284722206Q 305.23177083333337 48.435355381944426 312.2521267361111 54.455711284722206L 312.2521267361111 280.61199999999997L 297.2114149305556 280.61199999999997" pathFrom="M 298.2114149305556 280.61199999999997L 298.2114149305556 280.61199999999997L 312.2521267361111 280.61199999999997L 312.2521267361111 280.61199999999997L 297.2114149305556 280.61199999999997" cy="51.445533333333316" cx="384.70620659722226" j="3" val="98" barHeight="229.16646666666665" barWidth="16.040711805555556"></path><path id="SvgjsPath6966" d="M 385.70620659722226 280.61199999999997L 385.70620659722226 80.17847795138887Q 392.72656250000006 74.15812204861109 399.7469184027778 80.17847795138887L 399.7469184027778 280.61199999999997L 384.70620659722226 280.61199999999997" fill="rgba(67,211,158,0.85)" fill-opacity="1" stroke="transparent" stroke-opacity="1" stroke-linecap="butt" stroke-width="2" stroke-dasharray="0" class="apexcharts-bar-area" index="1" clip-path="url(#gridRectMask4huzlsld)" pathTo="M 385.70620659722226 280.61199999999997L 385.70620659722226 80.17847795138887Q 392.72656250000006 74.15812204861109 399.7469184027778 80.17847795138887L 399.7469184027778 280.61199999999997L 384.70620659722226 280.61199999999997" pathFrom="M 385.70620659722226 280.61199999999997L 385.70620659722226 280.61199999999997L 399.7469184027778 280.61199999999997L 399.7469184027778 280.61199999999997L 384.70620659722226 280.61199999999997" cy="77.16829999999999" cx="472.20099826388895" j="4" val="87" barHeight="203.44369999999998" barWidth="16.040711805555556"></path><path id="SvgjsPath6967" d="M 473.20099826388895 280.61199999999997L 473.20099826388895 38.08667795138887Q 480.22135416666674 32.06632204861109 487.2417100694445 38.08667795138887L 487.2417100694445 280.61199999999997L 472.20099826388895 280.61199999999997" fill="rgba(67,211,158,0.85)" fill-opacity="1" stroke="transparent" stroke-opacity="1" stroke-linecap="butt" stroke-width="2" stroke-dasharray="0" class="apexcharts-bar-area" index="1" clip-path="url(#gridRectMask4huzlsld)" pathTo="M 473.20099826388895 280.61199999999997L 473.20099826388895 38.08667795138887Q 480.22135416666674 32.06632204861109 487.2417100694445 38.08667795138887L 487.2417100694445 280.61199999999997L 472.20099826388895 280.61199999999997" pathFrom="M 473.20099826388895 280.61199999999997L 473.20099826388895 280.61199999999997L 487.2417100694445 280.61199999999997L 487.2417100694445 280.61199999999997L 472.20099826388895 280.61199999999997" cy="35.07649999999998" cx="559.6957899305556" j="5" val="105" barHeight="245.53549999999998" barWidth="16.040711805555556"></path><path id="SvgjsPath6968" d="M 560.6957899305556 280.61199999999997L 560.6957899305556 70.82474461805553Q 567.7161458333334 64.80438871527775 574.7365017361112 70.82474461805553L 574.7365017361112 280.61199999999997L 559.6957899305556 280.61199999999997" fill="rgba(67,211,158,0.85)" fill-opacity="1" stroke="transparent" stroke-opacity="1" stroke-linecap="butt" stroke-width="2" stroke-dasharray="0" class="apexcharts-bar-area" index="1" clip-path="url(#gridRectMask4huzlsld)" pathTo="M 560.6957899305556 280.61199999999997L 560.6957899305556 70.82474461805553Q 567.7161458333334 64.80438871527775 574.7365017361112 70.82474461805553L 574.7365017361112 280.61199999999997L 559.6957899305556 280.61199999999997" pathFrom="M 560.6957899305556 280.61199999999997L 560.6957899305556 280.61199999999997L 574.7365017361112 280.61199999999997L 574.7365017361112 280.61199999999997L 559.6957899305556 280.61199999999997" cy="67.81456666666665" cx="647.1905815972223" j="6" val="91" barHeight="212.79743333333332" barWidth="16.040711805555556"></path><path id="SvgjsPath6969" d="M 648.1905815972223 280.61199999999997L 648.1905815972223 17.040777951388883Q 655.2109375 11.020422048611104 662.2312934027779 17.040777951388883L 662.2312934027779 280.61199999999997L 647.1905815972223 280.61199999999997" fill="rgba(67,211,158,0.85)" fill-opacity="1" stroke="transparent" stroke-opacity="1" stroke-linecap="butt" stroke-width="2" stroke-dasharray="0" class="apexcharts-bar-area" index="1" clip-path="url(#gridRectMask4huzlsld)" pathTo="M 648.1905815972223 280.61199999999997L 648.1905815972223 17.040777951388883Q 655.2109375 11.020422048611104 662.2312934027779 17.040777951388883L 662.2312934027779 280.61199999999997L 647.1905815972223 280.61199999999997" pathFrom="M 648.1905815972223 280.61199999999997L 648.1905815972223 280.61199999999997L 662.2312934027779 280.61199999999997L 662.2312934027779 280.61199999999997L 647.1905815972223 280.61199999999997" cy="14.030599999999993" cx="734.6853732638889" j="7" val="114" barHeight="266.5814" barWidth="16.040711805555556"></path><path id="SvgjsPath6970" d="M 735.6853732638889 280.61199999999997L 735.6853732638889 63.809444618055544Q 742.7057291666666 57.789088715277764 749.7260850694445 63.809444618055544L 749.7260850694445 280.61199999999997L 734.6853732638889 280.61199999999997" fill="rgba(67,211,158,0.85)" fill-opacity="1" stroke="transparent" stroke-opacity="1" stroke-linecap="butt" stroke-width="2" stroke-dasharray="0" class="apexcharts-bar-area" index="1" clip-path="url(#gridRectMask4huzlsld)" pathTo="M 735.6853732638889 280.61199999999997L 735.6853732638889 63.809444618055544Q 742.7057291666666 57.789088715277764 749.7260850694445 63.809444618055544L 749.7260850694445 280.61199999999997L 734.6853732638889 280.61199999999997" pathFrom="M 735.6853732638889 280.61199999999997L 735.6853732638889 280.61199999999997L 749.7260850694445 280.61199999999997L 749.7260850694445 280.61199999999997L 734.6853732638889 280.61199999999997" cy="60.799266666666654" cx="822.1801649305555" j="8" val="94" barHeight="219.8127333333333" barWidth="16.040711805555556"></path><g id="SvgjsG6961" class="apexcharts-datalabels"></g></g><g id="SvgjsG6971" class="apexcharts-series" rel="3" seriesName="FreexCashxFlow" data:realIndex="2"><path id="SvgjsPath6973" d="M 51.767751736111116 280.61199999999997L 51.767751736111116 201.7770112847222Q 58.788107638888896 195.75665538194443 65.80846354166667 201.7770112847222L 65.80846354166667 280.61199999999997L 50.767751736111116 280.61199999999997" fill="rgba(247,126,83,0.85)" fill-opacity="1" stroke="transparent" stroke-opacity="1" stroke-linecap="butt" stroke-width="2" stroke-dasharray="0" class="apexcharts-bar-area" index="2" clip-path="url(#gridRectMask4huzlsld)" pathTo="M 51.767751736111116 280.61199999999997L 51.767751736111116 201.7770112847222Q 58.788107638888896 195.75665538194443 65.80846354166667 201.7770112847222L 65.80846354166667 280.61199999999997L 50.767751736111116 280.61199999999997" pathFrom="M 51.767751736111116 280.61199999999997L 51.767751736111116 280.61199999999997L 65.80846354166667 280.61199999999997L 65.80846354166667 280.61199999999997L 50.767751736111116 280.61199999999997" cy="198.7668333333333" cx="138.2625434027778" j="0" val="35" barHeight="81.84516666666666" barWidth="16.040711805555556"></path><path id="SvgjsPath6974" d="M 139.2625434027778 280.61199999999997L 139.2625434027778 187.7464112847222Q 146.28289930555556 181.72605538194443 153.30325520833335 187.7464112847222L 153.30325520833335 280.61199999999997L 138.2625434027778 280.61199999999997" fill="rgba(247,126,83,0.85)" fill-opacity="1" stroke="transparent" stroke-opacity="1" stroke-linecap="butt" stroke-width="2" stroke-dasharray="0" class="apexcharts-bar-area" index="2" clip-path="url(#gridRectMask4huzlsld)" pathTo="M 139.2625434027778 280.61199999999997L 139.2625434027778 187.7464112847222Q 146.28289930555556 181.72605538194443 153.30325520833335 187.7464112847222L 153.30325520833335 280.61199999999997L 138.2625434027778 280.61199999999997" pathFrom="M 139.2625434027778 280.61199999999997L 139.2625434027778 280.61199999999997L 153.30325520833335 280.61199999999997L 153.30325520833335 280.61199999999997L 138.2625434027778 280.61199999999997" cy="184.7362333333333" cx="225.75733506944448" j="1" val="41" barHeight="95.87576666666666" barWidth="16.040711805555556"></path><path id="SvgjsPath6975" d="M 226.75733506944448 280.61199999999997L 226.75733506944448 199.43857795138885Q 233.77769097222225 193.41822204861109 240.79804687500004 199.43857795138885L 240.79804687500004 280.61199999999997L 225.75733506944448 280.61199999999997" fill="rgba(247,126,83,0.85)" fill-opacity="1" stroke="transparent" stroke-opacity="1" stroke-linecap="butt" stroke-width="2" stroke-dasharray="0" class="apexcharts-bar-area" index="2" clip-path="url(#gridRectMask4huzlsld)" pathTo="M 226.75733506944448 280.61199999999997L 226.75733506944448 199.43857795138885Q 233.77769097222225 193.41822204861109 240.79804687500004 199.43857795138885L 240.79804687500004 280.61199999999997L 225.75733506944448 280.61199999999997" pathFrom="M 226.75733506944448 280.61199999999997L 226.75733506944448 280.61199999999997L 240.79804687500004 280.61199999999997L 240.79804687500004 280.61199999999997L 225.75733506944448 280.61199999999997" cy="196.42839999999995" cx="313.25212673611117" j="2" val="36" barHeight="84.1836" barWidth="16.040711805555556"></path><path id="SvgjsPath6976" d="M 314.25212673611117 280.61199999999997L 314.25212673611117 222.8229112847222Q 321.27248263888896 216.80255538194444 328.2928385416667 222.8229112847222L 328.2928385416667 280.61199999999997L 313.25212673611117 280.61199999999997" fill="rgba(247,126,83,0.85)" fill-opacity="1" stroke="transparent" stroke-opacity="1" stroke-linecap="butt" stroke-width="2" stroke-dasharray="0" class="apexcharts-bar-area" index="2" clip-path="url(#gridRectMask4huzlsld)" pathTo="M 314.25212673611117 280.61199999999997L 314.25212673611117 222.8229112847222Q 321.27248263888896 216.80255538194444 328.2928385416667 222.8229112847222L 328.2928385416667 280.61199999999997L 313.25212673611117 280.61199999999997" pathFrom="M 314.25212673611117 280.61199999999997L 314.25212673611117 280.61199999999997L 328.2928385416667 280.61199999999997L 328.2928385416667 280.61199999999997L 313.25212673611117 280.61199999999997" cy="219.8127333333333" cx="400.74691840277785" j="3" val="26" barHeight="60.79926666666666" barWidth="16.040711805555556"></path><path id="SvgjsPath6977" d="M 401.74691840277785 280.61199999999997L 401.74691840277785 178.3926779513889Q 408.76727430555565 172.37232204861112 415.7876302083334 178.3926779513889L 415.7876302083334 280.61199999999997L 400.74691840277785 280.61199999999997" fill="rgba(247,126,83,0.85)" fill-opacity="1" stroke="transparent" stroke-opacity="1" stroke-linecap="butt" stroke-width="2" stroke-dasharray="0" class="apexcharts-bar-area" index="2" clip-path="url(#gridRectMask4huzlsld)" pathTo="M 401.74691840277785 280.61199999999997L 401.74691840277785 178.3926779513889Q 408.76727430555565 172.37232204861112 415.7876302083334 178.3926779513889L 415.7876302083334 280.61199999999997L 400.74691840277785 280.61199999999997" pathFrom="M 401.74691840277785 280.61199999999997L 401.74691840277785 280.61199999999997L 415.7876302083334 280.61199999999997L 415.7876302083334 280.61199999999997L 400.74691840277785 280.61199999999997" cy="175.3825" cx="488.24171006944454" j="4" val="45" barHeight="105.22949999999999" barWidth="16.040711805555556"></path><path id="SvgjsPath6978" d="M 489.24171006944454 280.61199999999997L 489.24171006944454 171.37737795138887Q 496.26206597222233 165.3570220486111 503.28242187500007 171.37737795138887L 503.28242187500007 280.61199999999997L 488.24171006944454 280.61199999999997" fill="rgba(247,126,83,0.85)" fill-opacity="1" stroke="transparent" stroke-opacity="1" stroke-linecap="butt" stroke-width="2" stroke-dasharray="0" class="apexcharts-bar-area" index="2" clip-path="url(#gridRectMask4huzlsld)" pathTo="M 489.24171006944454 280.61199999999997L 489.24171006944454 171.37737795138887Q 496.26206597222233 165.3570220486111 503.28242187500007 171.37737795138887L 503.28242187500007 280.61199999999997L 488.24171006944454 280.61199999999997" pathFrom="M 489.24171006944454 280.61199999999997L 489.24171006944454 280.61199999999997L 503.28242187500007 280.61199999999997L 503.28242187500007 280.61199999999997L 488.24171006944454 280.61199999999997" cy="168.36719999999997" cx="575.7365017361111" j="5" val="48" barHeight="112.24479999999998" barWidth="16.040711805555556"></path><path id="SvgjsPath6979" d="M 576.7365017361111 280.61199999999997L 576.7365017361111 162.02364461805556Q 583.7568576388888 156.0032887152778 590.7772135416667 162.02364461805556L 590.7772135416667 280.61199999999997L 575.7365017361111 280.61199999999997" fill="rgba(247,126,83,0.85)" fill-opacity="1" stroke="transparent" stroke-opacity="1" stroke-linecap="butt" stroke-width="2" stroke-dasharray="0" class="apexcharts-bar-area" index="2" clip-path="url(#gridRectMask4huzlsld)" pathTo="M 576.7365017361111 280.61199999999997L 576.7365017361111 162.02364461805556Q 583.7568576388888 156.0032887152778 590.7772135416667 162.02364461805556L 590.7772135416667 280.61199999999997L 575.7365017361111 280.61199999999997" pathFrom="M 576.7365017361111 280.61199999999997L 576.7365017361111 280.61199999999997L 590.7772135416667 280.61199999999997L 590.7772135416667 280.61199999999997L 575.7365017361111 280.61199999999997" cy="159.01346666666666" cx="663.2312934027777" j="6" val="52" barHeight="121.59853333333332" barWidth="16.040711805555556"></path><path id="SvgjsPath6980" d="M 664.2312934027777 280.61199999999997L 664.2312934027777 159.68521128472221Q 671.2516493055555 153.66485538194445 678.2720052083333 159.68521128472221L 678.2720052083333 280.61199999999997L 663.2312934027777 280.61199999999997" fill="rgba(247,126,83,0.85)" fill-opacity="1" stroke="transparent" stroke-opacity="1" stroke-linecap="butt" stroke-width="2" stroke-dasharray="0" class="apexcharts-bar-area" index="2" clip-path="url(#gridRectMask4huzlsld)" pathTo="M 664.2312934027777 280.61199999999997L 664.2312934027777 159.68521128472221Q 671.2516493055555 153.66485538194445 678.2720052083333 159.68521128472221L 678.2720052083333 280.61199999999997L 663.2312934027777 280.61199999999997" pathFrom="M 664.2312934027777 280.61199999999997L 664.2312934027777 280.61199999999997L 678.2720052083333 280.61199999999997L 678.2720052083333 280.61199999999997L 663.2312934027777 280.61199999999997" cy="156.67503333333332" cx="750.7260850694444" j="7" val="53" barHeight="123.93696666666665" barWidth="16.040711805555556"></path><path id="SvgjsPath6981" d="M 751.7260850694444 280.61199999999997L 751.7260850694444 187.7464112847222Q 758.7464409722221 181.72605538194443 765.766796875 187.7464112847222L 765.766796875 280.61199999999997L 750.7260850694444 280.61199999999997" fill="rgba(247,126,83,0.85)" fill-opacity="1" stroke="transparent" stroke-opacity="1" stroke-linecap="butt" stroke-width="2" stroke-dasharray="0" class="apexcharts-bar-area" index="2" clip-path="url(#gridRectMask4huzlsld)" pathTo="M 751.7260850694444 280.61199999999997L 751.7260850694444 187.7464112847222Q 758.7464409722221 181.72605538194443 765.766796875 187.7464112847222L 765.766796875 280.61199999999997L 750.7260850694444 280.61199999999997" pathFrom="M 751.7260850694444 280.61199999999997L 751.7260850694444 280.61199999999997L 765.766796875 280.61199999999997L 765.766796875 280.61199999999997L 750.7260850694444 280.61199999999997" cy="184.7362333333333" cx="838.220876736111" j="8" val="41" barHeight="95.87576666666666" barWidth="16.040711805555556"></path><g id="SvgjsG6972" class="apexcharts-datalabels"></g></g></g><line id="SvgjsLine7034" x1="0" y1="0" x2="787.453125" y2="0" stroke="#b6b6b6" stroke-dasharray="0" stroke-width="1" class="apexcharts-ycrosshairs"></line><line id="SvgjsLine7035" x1="0" y1="0" x2="787.453125" y2="0" stroke-dasharray="0" stroke-width="0" class="apexcharts-ycrosshairs-hidden"></line><g id="SvgjsG7036" class="apexcharts-yaxis-annotations"></g><g id="SvgjsG7037" class="apexcharts-xaxis-annotations"></g><g id="SvgjsG7038" class="apexcharts-point-annotations"></g></g><g id="SvgjsG7003" class="apexcharts-yaxis" rel="0" transform="translate(34.546875, 0)"><g id="SvgjsG7004" class="apexcharts-yaxis-texts-g"><text id="SvgjsText7005" font-family="Helvetica, Arial, sans-serif" x="20" y="41.4" text-anchor="end" dominant-baseline="auto" font-size="11px" font-weight="regular" fill="#373d3f" class="apexcharts-yaxis-label " style="font-family: Helvetica, Arial, sans-serif;">120</text><text id="SvgjsText7006" font-family="Helvetica, Arial, sans-serif" x="20" y="111.65299999999999" text-anchor="end" dominant-baseline="auto" font-size="11px" font-weight="regular" fill="#373d3f" class="apexcharts-yaxis-label " style="font-family: Helvetica, Arial, sans-serif;">90</text><text id="SvgjsText7007" font-family="Helvetica, Arial, sans-serif" x="20" y="181.90599999999998" text-anchor="end" dominant-baseline="auto" font-size="11px" font-weight="regular" fill="#373d3f" class="apexcharts-yaxis-label " style="font-family: Helvetica, Arial, sans-serif;">60</text><text id="SvgjsText7008" font-family="Helvetica, Arial, sans-serif" x="20" y="252.15899999999996" text-anchor="end" dominant-baseline="auto" font-size="11px" font-weight="regular" fill="#373d3f" class="apexcharts-yaxis-label " style="font-family: Helvetica, Arial, sans-serif;">30</text><text id="SvgjsText7009" font-family="Helvetica, Arial, sans-serif" x="20" y="322.4119999999999" text-anchor="end" dominant-baseline="auto" font-size="11px" font-weight="regular" fill="#373d3f" class="apexcharts-yaxis-label " style="font-family: Helvetica, Arial, sans-serif;">0</text></g><g id="SvgjsG7010" class="apexcharts-yaxis-title"><text id="SvgjsText7011" font-family="Helvetica, Arial, sans-serif" x="18.9375" y="180.30599999999998" text-anchor="end" dominant-baseline="auto" font-size="11px" font-weight="regular" fill="#373d3f" class="apexcharts-yaxis-title-text " style="font-family: Helvetica, Arial, sans-serif;" transform="rotate(-90 -14.890625 176.96875)">$ (thousands)</text></g></g></svg><div class="apexcharts-tooltip dark" style="left: 632.572px; top: 90.8333px;"><div class="apexcharts-tooltip-series-group active" style="display: flex;"><span class="apexcharts-tooltip-marker" style="background-color: rgb(67, 211, 158);"></span><div class="apexcharts-tooltip-text" style="font-family: Helvetica, Arial, sans-serif; font-size: 12px;"><div class="apexcharts-tooltip-y-group"><span class="apexcharts-tooltip-text-label">Revenue: </span><span class="apexcharts-tooltip-text-value">$ 91 thousands</span></div><div class="apexcharts-tooltip-z-group"><span class="apexcharts-tooltip-text-z-label"></span><span class="apexcharts-tooltip-text-z-value"></span></div></div></div><div class="apexcharts-tooltip-series-group" style="display: none;"><span class="apexcharts-tooltip-marker" style="background-color: rgb(67, 211, 158);"></span><div class="apexcharts-tooltip-text" style="font-family: Helvetica, Arial, sans-serif; font-size: 12px;"><div class="apexcharts-tooltip-y-group"><span class="apexcharts-tooltip-text-label">Revenue: </span><span class="apexcharts-tooltip-text-value">$ 91 thousands</span></div><div class="apexcharts-tooltip-z-group"><span class="apexcharts-tooltip-text-z-label"></span><span class="apexcharts-tooltip-text-z-value"></span></div></div></div><div class="apexcharts-tooltip-series-group" style="display: none;"><span class="apexcharts-tooltip-marker" style="background-color: rgb(67, 211, 158);"></span><div class="apexcharts-tooltip-text" style="font-family: Helvetica, Arial, sans-serif; font-size: 12px;"><div class="apexcharts-tooltip-y-group"><span class="apexcharts-tooltip-text-label">Revenue: </span><span class="apexcharts-tooltip-text-value">$ 91 thousands</span></div><div class="apexcharts-tooltip-z-group"><span class="apexcharts-tooltip-text-z-label"></span><span class="apexcharts-tooltip-text-z-value"></span></div></div></div></div></div></div>
                                    <div class="resize-triggers"><div class="expand-trigger"><div style="width: 894px; height: 456px;"></div></div><div class="contract-trigger"></div></div>
                                </div> <!-- end card-body -->
                                </div>
            </div>
        </div>
    </div>






<!-- --------------------------------------------FIN REGISTRAR ContabilidadS------------------------------------------------------ -->

    

                
            



@endsection

<script type="text/javascript">

    function select(accion, id, idem, tipo, status) {

        if (accion==1) {
            $('#VerContabilidad').modal('show');
            $('#ver_idem').val(idem);
            $('#ver_tipo').val(tipo);
            $('#ver_status').val(status);
        }
        if(accion==2){
            editar(id, idem, tipo, status);
            $('#editarContabilidad').modal('show');
        }
        if (accion==3) {
            $('#id').val(id);
            $('#eliminarContabilidad').modal('show');
        } else {

        }
    }

    // function eliminar(id) {
    //     $('#id').val(id);
    // }

    function mensual(accion, id) {

        $('#selectO').val(0);
        if (accion==1) {
            $('#SelectAnio1').val(0);
            $('#createMensualidad').modal('show');
            $('#buttonCreate').empty();
            $('#createMensuality1').empty();
            $('#createMensuality2').empty();
            $('#idCreateM').val(id);
            // $('#anioCreateM').val(anio);
        }
        if(accion==2){
            $('#SelectAnio2').val(0);
            $('#editMensuality1').empty();
            $('#editMensuality2').empty();
            $('#buttonEdit').empty();
            $('#editarMensualidad').modal('show');
            $('#idEditM').val(id);
            // $('#anioEditM').val(anio);
        }
        if (accion==3) {
            $('#deleteMensualidad').modal('show');
            $('#idDeleteM').val(id);
            // $('#anioDeleteM').val(anio);
        } 
        if (accion==4){
            $('#buttonShow').empty();
            $('#fechasM').empty();
            $('#MesesM').empty();
            $('#idShowM').val(id);
            $('#VerMensualidades').modal('show');

            $.get('Contabilidads/'+id+'/buscar_anios', function(data) {
        
                beforeSend: $('#MesesM').append('Cargando...');
                complete: $('#MesesM').empty();
                    
                if (data.length > 0) {

                    $('#fechasM').append(
                        '<div class="row">'+
                            '<div class="col-md-12">'+
                                '<div class="form-group">'+
                                    '<label>Especifique el año para ver la mensualidad</label>'+
                                        '<select class="form-control" onchange="accionM(4,this.value);" id="verFechaMensual">'+
                                            '<option value="0">Seleccionar año</option>'+
                                        '</div>'+
                                    '</div>'+
                                '</div>'+
                            '</div>'+
                        '</div>'
                    );

                    for (var i = 0; i < data.length; i++) {
                        $('#verFechaMensual').append('<option value="'+data[i].anio+'">'+data[i].anio+'</option>');
                    }
                    
                }else
                    $('#fechasM').append('El Contabilidad no posee mensualidades');

            });
        }else {

        }
    }


    function mostrarC(opcion) {
        if (opcion==1) {
            $('#createMensuality1').show();
            $('#createMensuality2').hide();
            $('#montoAnioC').attr('disabled',true);
            $('#accionCreate').val(1);
        } else {
            $('#createMensuality1').hide();
            $('#createMensuality2').show();
            $('#montoAnioC').attr('disabled',false);
            $('#accionCreate').val(2);
        }
    }

    function mostrarE(opcion) {
        if (opcion==1) {
            $('#montoAnio_e').attr('disabled',true);
            $('#editMensuality1').show();
            $('#editMensuality2').hide();
            $('#accionEdit').val(1);
        } else {
            $('#montoAnio_e').attr('disabled',false);
            $('#editMensuality1').hide();
            $('#editMensuality2').show();
            $('#accionEdit').val(2);
        }
    }

    function accionM(accion, anio) {

        var mes = ['','Enero','Febrero','Marzo','Abril','Mayo','Junio','Julio','Agosto','Septiembre','Octubre','Noviembre','Diciembre',''];
        var f = new Date();
        var m = f.getMonth()+1;
        var a = f.getFullYear();

        if (accion == 1) {
            var id = $('#idCreateM').val();
            $('#anioCreateM').val(anio);

            $.get('Contabilidads/'+id+'/'+anio+'/buscar_mensualidad', function(data) {
        

                $('#montoAnio').empty();
                $('#buttonCreate').empty();
                $('#createMensuality1').empty();
                $('#createMensuality2').empty();

                beforeSend: $('#createMensuality1').append('Cargando...');
                complete: $('#createMensuality1').empty();

                if (data.length > 0) {

                    
                    $('#createMensuality1').append('Ya existen registros para este año');
                    $('#buttonC').attr('disabled',true);

                }else{

                    $('#buttonCreate').append(
                        "<div class='card-box'>"+
                            "<div class='row'>"+
                                "<div class='col-md-6' width='100%'>"+
                                    "<a href='#' class='btn btn-block btn-success' onclick='mostrarC(1)'>Montos por mes</a>"+
                                "</div>"+
                                "<div class='col-md-6' width='100%'>"+
                                    "<a href='#' class='btn btn-block btn-warning' onclick='mostrarC(2)'>Monto por año</a>"+
                                "</div>"+
                            "</div>"+
                        "</div"
                    );
                    $('#createMensuality1').append('<label>Montos por mes</label><br>');

                    if(a == anio){
                        for (var i = 0; i < 13; i++) {
                        
                            if(i>=m){
                                $('#createMensuality1').append(
                                    '<div class="row">'+
                                        '<div class="col-md-4">'+
                                            '<div class="form-group">'+
                                                '<input type="hidden" name="mes[]" class="form-control-plaintext">'+
                                                '<label>'+mes[i]+'</label>'+
                                            '</div>'+
                                        '</div>'+
                                        '<div class="col-md-6">'+
                                            '<div class="form-group">'+
                                                '<div class="input-group mb-2">'+
                                                    '<div class="input-group-prepend">'+
                                                        '<div class="input-group-text">$</div>'+
                                                    '</div>'+
                                                    '<input type="number" name="monto[]" class="form-control" placeholder="10">'+
                                                '</div>'+
                                            '</div>'+
                                        '</div>'+
                                    '</div>'
                                );
                            }
                        }

                    }

                    else{
                        for (var i = 1; i < 13; i++) {
                            $('#createMensuality1').append(
                                '<div class="row">'+
                                    '<div class="col-md-4">'+
                                        '<div class="form-group">'+
                                            '<input type="hidden" name="mes[]" class="form-control-plaintext">'+
                                            '<label>'+mes[i]+'</label>'+
                                        '</div>'+
                                    '</div>'+
                                    '<div class="col-md-6">'+
                                        '<div class="form-group">'+
                                            '<div class="input-group mb-2">'+
                                                '<div class="input-group-prepend">'+
                                                    '<div class="input-group-text">$</div>'+
                                                '</div>'+
                                                '<input type="number" name="monto[]" class="form-control" placeholder="10">'+
                                            '</div>'+
                                        '</div>'+
                                    '</div>'+
                                '</div>'
                            );
                        } 
                    }
                    $('#createMensuality2').append(
                        '<div class="row">'+
                            '<div class="col-md-12">'+
                                '<div class="form-group">'+
                                    '<label>Monto por todo el año</label>'+
                                    '<div class="input-group mb-2">'+
                                        '<div class="input-group-prepend">'+
                                            '<div class="input-group-text">$</div>'+
                                        '</div>'+
                                        '<input type="text" id="montoAnioC" name="montoaAnio" class="form-control" id="montoAnio_e" placeholder="10">'+
                                    '</div>'+
                                '</div>'+
                            '</div>'+
                        '</div>'
                    );
                    $('#createMensuality2').css('display','none');

                    $('#buttonC').attr('disabled',false);
                }
            });

        }
        if (accion == 2) {

            var id = $('#idEditM').val();
            $('#anioEditM').val(anio);

            $.get('Contabilidads/'+id+'/'+anio+'/buscar_mensualidad', function(data) {
        
                var m = f.getMonth()-1;
                $('#montoAnio').empty();
                $('#buttonEdit').empty();
                $('#editMensuality1').empty();
                $('#editMensuality2').empty();

                beforeSend: $('#editMensuality1').append('Cargando...');
                complete: $('#editMensuality1').empty();

                if (data.length == 0) {

                    $('#editMensuality1').append('No existen registros de este año para editar');
                    $('#buttonEdit').attr('disabled',true);

                }else{
                    var montoT=data.length-1;
                    $('#buttonEdit').append(
                        "<div class='card-box'>"+
                            "<div class='row'>"+
                                "<div class='col-md-6' width='100%'>"+
                                    "<a href='#' class='btn btn-block btn-success' onclick='mostrarE(1)'>Montos por mes</a>"+
                                "</div>"+
                                "<div class='col-md-6' width='100%'>"+
                                    "<a href='#' class='btn btn-block btn-warning' onclick='mostrarE(2)'>Monto por año</a>"+
                                "</div>"+
                            "</div>"+
                        "</div"
                    );
                    $('#editMensuality1').append('<label>Montos por mes</label><br>');

                    
                    for (var i = 0; i < data.length; i++) {
                            
                            console.log(i);
                            $('#editMensuality1').append(
                                '<div class="row">'+
                                    '<div class="col-md-4">'+
                                        '<div class="form-group">'+
                                            '<input type="hidden" value="'+data[i].mes+'" name="mes[]" class="form-control-plaintext">'+
                                            '<label>'+mes[data[i].mes]+'</label>'+
                                        '</div>'+
                                    '</div>'+
                                    '<div class="col-md-6">'+
                                        '<div class="form-group">'+
                                            '<div class="input-group mb-2">'+
                                                '<div class="input-group-prepend">'+
                                                    '<div class="input-group-text">$</div>'+
                                                '</div>'+
                                                '<input type="number" value="'+data[i].monto+'" name="monto[]" class="form-control" placeholder="10">'+
                                            '</div>'+
                                        '</div>'+
                                    '</div>'+
                                '</div>'
                            );

                    }
                    $('#editMensuality2').append(
                        '<div class="row">'+
                            '<div class="col-md-12">'+
                                '<div class="form-group">'+
                                    '<label>Monto por todo el año</label>'+
                                    '<div class="input-group mb-2">'+
                                        '<div class="input-group-prepend">'+
                                            '<div class="input-group-text">$</div>'+
                                        '</div>'+
                                        '<input type="text" name="montoaAnio" value="'+data[montoT].monto+'" class="form-control" id="montoAnio_e" placeholder="10" disabled="disabled">'+
                                    '</div>'+
                                '</div>'+
                            '</div>'+
                        '</div>'
                    );
                    $('#editMensuality2').css('display','none');

                    $('#buttonE').attr('disabled',false);
                }
            });
        }
        if (accion == 3) {

            $('#deleteMensuality').empty();
            var id = $('#idDeleteM').val();
            $('#anioDeleteM').val(anio);

            $.get('Contabilidads/'+id+'/'+anio+'/buscar_mensualidad', function(data) {
        
                for (var i = 0; i < 13; i++) {
                    $('#montoMese_e'+i).empty();
                }
                $('#montoAnio_e').empty();

                beforeSend: $('#deleteMensuality').append('Cargando...');
                    
                if (data.length > 0) {

                    $('#deleteMensuality').empty();
                    $('#deleteMensuality').append('<h3>Existen registros para este año</h3><br><p>¿Eliminar mensualidad de este año? No habrá vuelta atrás</p>');
                    $('#buttonD').attr('disabled', false);

                }else{
                    $('#deleteMensuality').empty();
                    $('#deleteMensuality').append('No hay registros de este año');
                    $('#buttonD').attr('disabled', true);
                }


            });
        } 
        if (accion == 4){

            var id = $('#idShowM').val();
            $('#MesesM').empty();
            $.get('Contabilidads/'+id+'/'+anio+'/buscar_mensualidad', function(data) {
        
                $('#buttonShow').empty();

                beforeSend: $('#MesesM').append('Cargando...');
                complete: $('#MesesM').empty();

                if (data.length > 0) {

                    var montoT=data.length-1;
                    // $('#buttonShow').append(
                    //     "<div class='card-box'>"+
                    //         "<div class='row'>"+
                    //             "<div class='col-md-6' width='100%'>"+
                    //                 "<a href='#' class='btn btn-success' onclick='mostrarS(1)'>Montos por mes</a>"+
                    //             "</div>"+
                    //             "<div class='col-md-6' width='100%'>"+
                    //                 "<a href='#' class='btn btn-warning' onclick='mostrarS(2)'>Monto por año</a>"+
                    //             "</div>"+
                    //         "</div>"+
                    //     "</div"
                    // );
                    $('#MesesM').append('<label>Montos por mes</label><br>');

                    
                    for (var i = 0; i < data.length; i++) {
                            
                        $('#MesesM').append(
                            '<div class="row">'+
                                '<div class="col-md-4">'+
                                    '<div class="form-group">'+
                                        '<button type="button" style="width=100% !important" class="btn btn-block btn-outline-info">'+mes[data[i].mes]+'</button>'+
                                    '</div>'+
                                '</div>'+
                                '<div class="col-md-8">'+
                                    '<button class="btn btn-block btn-success" style="width=100% !important">$ <strong>'+data[i].monto+'</strong></button>'+
                                '</div>'+
                            '</div>'
                        );

                    }
                    $('#MesesM').append('<label>Montos por Año</label><br>');

                    $('#MesesM').append(
                        '<div class="row justify-content-center">'+
                            '<div class="col-md-4">'+
                                    '<button type="button" class="btn btn-block btn-outline-warning">'+anio+'</button>'+
                            '</div>'+
                            '<div class="col-md-8">'+
                                    '<button class="btn btn-block btn-warning" style="width=100% !important">$ <strong>'+data[montoT].monto+'</strong></button>'+
                                '</div>'+
                        '</div>'
                    );
                    $('#editMensuality2').css('display','none');

                    $('#buttonE').attr('disabled',false);
                }
            });
        }
    }

    function editar(id, idem, tipo,status) {

        $('#id_e').val(id);
        $('#idem').val(idem);
        $('#tipo').val(tipo);
        $('#status_e').val(status);
    }

    function opcion(opcion) {
        var f = new Date();
        var anio=f.getFullYear();
        // var mes=['','Enero','Febrero','Marzo','Abril','Mayo','Junio','Julio','Agosto','Septiembre','Octubre','Noviembre','Diciembre'];
        $('#opcion').val(opcion);
        $('#opcion_e').val(opcion);

        if (opcion==2) {
            for (var i = 0; i < 13; i++) {
                $('#montoMeses'+i).prop('disabled',true).val(null).prop('required',false);
            }
            $('#montoAnio').prop('disabled',false).prop('required',true);
        }else {
            for (var i = 0; i < 13; i++) {
                $('#montoMeses'+i).prop('disabled',false).val(null).prop('required',true);
            }
            $('#montoAnio').prop('disabled',true).val(null).prop('required',false);
        }

    }
    
</script>