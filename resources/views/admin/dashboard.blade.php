<x-admin-layout title="Dashboard">
    <x-slot name="subHeader">
        <x-admin.sub-header headerTitle="Dashboard">
            {{-- <x-admin.breadcrumbs>
                    <x-admin.breadcrumbs-item href="{{ route('admin.dashboard') }}" value="Dashboard" />
            </x-admin.breadcrumbs> --}}
            <x-slot name="toolbar">
            </x-slot>
        </x-admin.sub-header>
</x-slot>
<div class="kt-portlet">
    <div class="kt-portlet__body  kt-portlet__body--fit">
        <div class="row row-no-padding row-col-separator-xl">
            <div class="col-md-12 col-lg-6 col-xl-4">
                <div class="kt-widget24">
                    <div class="kt-widget24__details">
                        <div class="kt-widget24__info">
                            <h4 class="kt-widget24__title">
                                Total Property or Provider
                            </h4>
                            <span class="kt-widget24__desc">
                                Total active property available in this system
                            </span>
                        </div>
                        <span class="kt-widget24__stats kt-font-brand">
                            {{$count['propertyCount']}}
                        </span>
                    </div>
                    <div class="progress progress--sm">
                        <div class="progress-bar kt-bg-brand" role="progressbar" style="width: {{$count['propertyCount']}}%;" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                        <div class="kt-widget24__action">
                        <a class="kt-widget24__change" href="{{ route('providers.index') }}">
                            View
                        </a>
                    </div> 
                </div>
            </div>
            <div class="col-md-12 col-lg-6 col-xl-4">
                <div class="kt-widget24">
                    <div class="kt-widget24__details">
                        <div class="kt-widget24__info">
                            <h4 class="kt-widget24__title">
                                Total Property/Provider Building
                            </h4>
                            <span class="kt-widget24__desc">
                                Total active property building available in this system
                            </span>
                        </div>
                        <span class="kt-widget24__stats kt-font-warning">
                            {{$count['buildingCount']}}
                        </span>
                    </div>
                    <div class="progress progress--sm">
                        <div class="progress-bar kt-bg-warning" role="progressbar" style="width: {{$count['buildingCount']}}%;" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                    <div class="kt-widget24__action">
                        <a class="kt-widget24__change" href="{{ route('buildings.index') }}">
                            View
                        </a>
                    </div>
                </div>
            </div>
            <div class="col-md-12 col-lg-6 col-xl-4">
                <div class="kt-widget24">
                    <div class="kt-widget24__details">
                        <div class="kt-widget24__info">
                            <h4 class="kt-widget24__title">
                               Total Building Unit
                            </h4>
                            <span class="kt-widget24__desc">
                                Total active building unit available in this system
                            </span>
                        </div>
                        <span class="kt-widget24__stats kt-font-danger">
                            {{$count['unitCount']}}
                        </span>
                    </div>
                    <div class="progress progress--sm">
                        <div class="progress-bar kt-bg-danger" role="progressbar" style="width: {{$count['unitCount']}}%;" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                    </div>
                    <div class="kt-widget24__action">
                        <a class="kt-widget24__change" href="{{ route('provider-unit.index') }}">
                            View
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-6">
        <div class="kt-portlet kt-portlet--height-fluid ">
            <div class="kt-portlet__head">
                <div class="kt-portlet__head-label">
                    <h3 class="kt-portlet__head-title">
                        Analytics
                    </h3>
                </div>
            </div>
            <div class="kt-portlet__body kt-portlet__body--fluid kt-portlet__body--fit">
                <div class="kt-widget4 kt-widget4--sticky">
                    <div class="kt-widget4__items kt-portlet__space-x kt-margin-t-15">
                        

                        <div class="kt-widget4__item">
                            <span class="kt-widget4__icon">
                                <i class="flaticon2-analytics-2  kt-font-success"></i>
                            </span>
                            <a href="{{route('supports.index')}}" class="kt-widget4__title">
                                Trouble Ticket
                            </a>
                            <span class="kt-widget4__number kt-font-success">{{$count['ticketCount']}}</span>
                        </div>
                        <div class="kt-widget4__item">
                            <span class="kt-widget4__icon">
                                <i class="flaticon2-drop  kt-font-danger"></i>
                            </span>
                            <a href="{{route('service-type.index')}}" class="kt-widget4__title">
                                Service Type
                            </a>
                            <span class="kt-widget4__number kt-font-danger">{{$count['serviceCount']}}</span>
                        </div>
                        <div class="kt-widget4__item">
                            <span class="kt-widget4__icon">
                                <i class="flaticon2-pie-chart-4 kt-font-warning"></i>
                            </span>
                            <a href="{{route('business-category.index')}}" class="kt-widget4__title">
                                Business Category
                            </a>
                            <span class="kt-widget4__number kt-font-warning">{{$count['businessCount']}}</span>
                        </div> 
                    </div>
                        <div class="kt-widget4__chart kt-margin-t-15">
                        <!-- <canvas id="kt_chart_latest_updates" style="height: 150px;"></canvas> -->
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="kt-portlet kt-portlet--height-fluid ">
            <div class="kt-portlet__head">
                <div class="kt-portlet__head-label">
                    <h3 class="kt-portlet__head-title">
                    Analytics
                    </h3>
                </div>
            </div>
            <div class="kt-portlet__body kt-portlet__body--fluid kt-portlet__body--fit">
                <div class="kt-widget4 kt-widget4--sticky">
                    <div class="kt-widget4__items kt-portlet__space-x kt-margin-t-15">
                        <div class="kt-widget4__item">
                            <span class="kt-widget4__icon">
                                <i class="flaticon2-graphic  kt-font-brand"></i>
                            </span>
                            <a href="{{route('titles.index')}}" class="kt-widget4__title">
                                User Title 
                            </a>
                            <span class="kt-widget4__number kt-font-brand">{{$count['titleCount']}}</span>
                        </div>
                        <div class="kt-widget4__item">
                            <span class="kt-widget4__icon">
                                <i class="flaticon2-analytics-2  kt-font-success"></i>
                            </span>
                            <a href="{{route('providers.index')}}" class="kt-widget4__title">
                                Property Type 
                            </a>
                            <span class="kt-widget4__number kt-font-success">{{$count['providertypeCount']}}</span>
                        </div>
                        <div class="kt-widget4__item">
                            <span class="kt-widget4__icon">
                                <i class="flaticon2-drop  kt-font-danger"></i>
                            </span>
                            <a href="{{route('deals.index')}}" class="kt-widget4__title">
                                Deal
                            </a>
                            <span class="kt-widget4__number kt-font-danger">{{$count['dealCount']}}</span>
                        </div>
                        
                        
                    </div>
                        <div class="kt-widget4__chart kt-margin-t-15">
                        <!-- <canvas id="kt_chart_latest_updates" style="height: 150px;"></canvas> -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-6 col-lg-6 col-xl-6">
        <div class="kt-portlet">
            <canvas id="myChart" style="width:100%;max-width:600px;" width="703" height="351" ></canvas>
        </div>
    </div>
    <div class="col-md-6 col-lg-6 col-xl-6">
        <div class="kt-portlet">
            <canvas id="myChart2" style="width:100%;max-width:600px" width="703" height="351"></canvas>
        </div>
    </div>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.min.js"></script>


@push('scripts')
<script>
      var xValues = ['Provider User','Merchant User','Consumer'];
        var yValues = [@php echo $count['providerCount'] .','. $count['consumerCount'].','. $count['merchantCount'] @endphp];
        var barColors = [
        "#b91d47",
        "#00aba9",
        "#2b5797"];

        new Chart("myChart", {
        type: "doughnut",
        data: {
            labels: xValues,
            datasets: [{
            backgroundColor: barColors,
            data: yValues
            }]
        },
        options: {
            title: {
            display: true,
            text: "User Statistics"
            }
        }
        });
        var kValues = [@php
                        foreach($business as $value) {
                            echo "'".$value->business_name."',";
                        }
                      @endphp];
        var lValues = [@php
                        foreach($business as $count) {
                            echo "'".$count->locations_count."',";
                        }
                      @endphp];
        var i = ['brown','green','blue','red','purple'];
         var barColors = [@php
                            foreach($business as $data) {
                                echo "'brown',";
                            }
                         @endphp];
 
    new Chart("myChart2", {
    type: "bar",
    data: {
        labels: kValues,
        datasets: [{
        backgroundColor: barColors,
        data: lValues
        }]
    },
    options: {
        legend: {display: false},
        title: {
        display: true,
        text: "Business Location Statistics"
        }
    }
    });
</script>
@endpush

</x-admin-layout>