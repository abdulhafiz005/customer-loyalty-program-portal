{{-- Extends layout --}}
	@extends('layout.default')

	{{-- Content --}}
	@section('content')

	{{-- Dashboard 1 --}}
<style>
	.dataTables_filter, .dt-buttons { display: none; }
	#kt_datatable_info { float:right; }
</style>
	<div class="row">

		{{--<div class=" col-md-4 col-sm-12 card-stretch">--}}
			{{--<div class="card card-custom h-100 ">--}}
				{{--<div class="card-header border-0">--}}
					{{--<h3 class="card-title font-weight-bolder text-dark">Customer Interactions by Cities</h3>--}}
				{{--</div>--}}

				{{--<div class="card-body pt-2">--}}
					{{--<div id="interception_by_cities"></div>--}}
				{{--</div>--}}
			{{--</div>--}}
		{{--</div>--}}


		<div class="col-md-12 col-sm-12 card-stretch">
			<div class="card card-custom h-100">
				<div class="card-header border-0">
					<h3 class="card-title font-weight-bolder text-dark">Sales</h3>
				</div>
				<div class="card-body p-1">
					<div id="coversion_bar"></div>
				</div>
			</div>
		</div>

	</div>

	<div class="clearfix mb-2"></div>



	<div class="row">
		<div class="d-flex align-items-center mb-8 ar_dashboard">
			<div class="symbol symbol-circle symbol-40 symbol-light mr-3 flex-shrink-0">
				<div class="symbol-label">
					<i class="flaticon2-pie-chart"></i>
				</div>
			</div>
			{{--<div>--}}
				{{--<a href="#" class="title text-dark-75 text-hover-primary font-weight-bolder">Consistent Performer</a>--}}
				{{--<div class="title-short text-muted font-weight-bold mt-1 consistant_performer">Mehkan Ali</div>--}}
			{{--</div>--}}
		</div>

		<!-- <button type="button" class="btn btn-primary mr-2" data-toggle="modal" data-target="#user_update">Modal - xl</button> -->



		<div class="col-md-12">
			<!--begin::Card-->
			<div class="card card-custom">
				<div class="card-header pl-2">
					<div class="card-title col-md-3">
						{{ Metronic::getSVG("media/svg/icons/Shopping/Chart-line1.svg", "svg-icon-2x svg-icon-primary d-block my-2 p-1 ml-2") }}
						<h3 class="card-label">Ustad Mechanic</h3>

					</div>
				</div>

				<div class="card-body">


                <div class="row d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">

<div class="col-md-4 my-2 my-md-0">
    <div class="input-icon">
        <input type="text" class="form-control" placeholder="Search..." id="generalSearch" />
        <span>
            <i class="flaticon2-search-1 text-muted"></i>
        </span>
    </div>
</div>

@if($role -> hasPermissionTo('Export Data'))
    <div class="card-toolbar">
        <!--begin::Dropdown-->
        <div class="dropdown dropdown-inline mr-2">
            <button type="button" class="btn btn-light-primary font-weight-bolder dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <span class="svg-icon svg-icon-md">
                <!--begin::Svg Icon | path:/metronic/theme/html/demo1/dist/assets/media/svg/icons/Design/PenAndRuller.svg-->
                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                        <rect x="0" y="0" width="24" height="24" />
                        <path d="M3,16 L5,16 C5.55228475,16 6,15.5522847 6,15 C6,14.4477153 5.55228475,14 5,14 L3,14 L3,12 L5,12 C5.55228475,12 6,11.5522847 6,11 C6,10.4477153 5.55228475,10 5,10 L3,10 L3,8 L5,8 C5.55228475,8 6,7.55228475 6,7 C6,6.44771525 5.55228475,6 5,6 L3,6 L3,4 C3,3.44771525 3.44771525,3 4,3 L10,3 C10.5522847,3 11,3.44771525 11,4 L11,19 C11,19.5522847 10.5522847,20 10,20 L4,20 C3.44771525,20 3,19.5522847 3,19 L3,16 Z" fill="#000000" opacity="0.3" />
                        <path d="M16,3 L19,3 C20.1045695,3 21,3.8954305 21,5 L21,15.2485298 C21,15.7329761 20.8241635,16.200956 20.5051534,16.565539 L17.8762883,19.5699562 C17.6944473,19.7777745 17.378566,19.7988332 17.1707477,19.6169922 C17.1540423,19.602375 17.1383289,19.5866616 17.1237117,19.5699562 L14.4948466,16.565539 C14.1758365,16.200956 14,15.7329761 14,15.2485298 L14,5 C14,3.8954305 14.8954305,3 16,3 Z" fill="#000000" />
                    </g>
                </svg>
                <!--end::Svg Icon-->
            </span>Export</button>
            <!--begin::Dropdown Menu-->
            <div class="dropdown-menu dropdown-menu-sm dropdown-menu-right">
                <!--begin::Navigation-->
                <ul class="navi flex-column navi-hover py-2">
                    <li class="navi-header font-weight-bolder text-uppercase font-size-sm text-primary pb-2">Choose an option:</li>
                    <li class="navi-item">
                        <a id="export_print" class="navi-link" href="#" onclick="btnPress(this);">
                            <span class="navi-icon">
                                <i class="la la-print"></i>
                            </span>
                            <span class="navi-text">Print</span>
                        </a>
                    </li>
                    <li class="navi-item">
                        <a id="export_copy" class="navi-link" href="#" onclick="btnPress(this);">
                            <span class="navi-icon">
                                <i class="la la-copy"></i>
                            </span>
                            <span class="navi-text">Copy</span>
                        </a>
                    </li>
                    <li class="navi-item">
                        <a id="export_excel" class="navi-link" href="#" onclick="btnPress(this);">
                            <span class="navi-icon">
                                <i class="la la-file-excel-o"></i>
                            </span>
                            <span class="navi-text">Excel</span>
                        </a>
                    </li>
                    <li class="navi-item">
                        <a id="export_csv" class="navi-link" href="#" onclick="btnPress(this);">
                            <span class="navi-icon">
                                <i class="la la-file-text-o"></i>
                            </span>
                            <span class="navi-text">CSV</span>
                        </a>
                    </li>
                    <li class="navi-item">
                        <a id="export_pdf" class="navi-link" href="#" onclick="btnPress(this);">
                            <span class="navi-icon">
                                <i class="la la-file-pdf-o"></i>
                            </span>
                            <span class="navi-text">PDF</span>
                        </a>
                    </li>
                </ul>
                <!--end::Navigation-->
            </div>
            <!--end::Dropdown Menu-->
        </div>
        <!--end::Dropdown-->
    </div>
@endif
</div>

<hr/>
<table class="table table-separate table-head-custom table-checkable" id="kt_datatable">
<thead>
    <tr>
        <th class="export">Full Name</th>
        <th class="export">User Name</th>
        <th class="export">Loyalty Card Number</th>
        <th class="export">Mechanic Supervisor</th>
        <th class="export">Phone</th>
        <th class="export">CNIC</th>
        <th class="export">Date of Birth</th>
        {{-- <th>Password</th> --}}
        <th class="export">Registration City</th>
        <th class="export">Registered Date</th>
        <th class="export">Sales</th>
        <th class="export">Liters</th>
        <th class="export">Points</th>
        @if($role -> hasPermissionTo('Write Ustad'))
            <th>Action</th>
        @endif
    </tr>
</thead>
<tbody>
</tbody>
</table>
				</div>
			</div>
			<!--end::Card-->
		</div>

	</div>

	@endsection

	{{-- Scripts Section --}}
	@section('scripts')
		<script src="{{ asset('js/pages/widgets.js') }}" type="text/javascript"></script>
        <script src="{{ asset('js/pages/functions.js') }}" type="text/javascript"></script>
		<script src="{{ asset('plugins/custom/datatables/datatables.bundle.js') }}"></script>
		<script src="{{ asset('js/pages/crud/forms/widgets/bootstrap-datepicker.js') }}" type="text/javascript"></script>
        <script src="{{ asset('js/pages/crud/datatables/extensions/buttons.js') }}"></script>

		<script type="text/javascript">

            var firstRender = false;
            var best_performing_member, top_converted_brands;

            function getData(){
                var city     = getSelectedCity();
                var dateData = getSelectedDate();

                return $.ajax({
                    type: "Get",
                    url:"{{ route('ajax-dashboard-stats') }}",
                    data: {
                        start: dateData.start_date,
                        end  : dateData.end_date,
                        city : city,
                    },
                    async: false,
                    cache: false,
                    success: function (response) {
                        data = JSON.parse(response);
                        console.log(data);

                        coversion_bar.updateSeries([
                            {
                                data: data.sales,
                            }
                            /*,{
                                name: 'Conversions',
                                data: data.converted_interceptions
                            }*/
                        ]);

                        $('#p_liter').html(data.activity.purchaseLiters);
                        $('#t_ba').html(data.activity.totalBA);
                        $('#t_interceptions').html(data.activity.totalInterceptions);

                        actitvyChart.updateSeries([
                            {
                                name: 'Sales',
                                data: data.activity.activityGraph,
                            }
                        ]);


                        if (firstRender)
                        {
                            best_performing_member.destroy();
                            top_converted_brands.destroy();
                        }

                        bestPerformingOptions.series = data.top_users.user_counts;
                        bestPerformingOptions.labels = data.top_users.user_label;
                        best_performing_member = new ApexCharts(document.querySelector("#best_performing_member"), bestPerformingOptions);
                        best_performing_member.render().then(() => firstRender = true);


                        top_converted_brands_options.series = data.top_brands.switch_from_counts;
                        top_converted_brands_options.labels = data.top_brands.switch_from_label;
                        top_converted_brands = new ApexCharts(document.querySelector("#top_converted_brands"), top_converted_brands_options);
                        top_converted_brands.render().then(() => firstRender = true);

                        interceptionByCities.updateSeries([
                            {
                                name: 'Interception',
                                data: [data.top_cities.total_karachi_interceptions]
                            },
                            {
                                name: 'Interception',
                                data: [data.top_cities.total_lahore_interceptions]
                            },
                            {
                                name: 'Interception',
                                data: [data.top_cities.total_islamabad_interceptions]
                            }
                        ]);

                        reg_mechs.updateSeries([
                            {
                                name: 'Registered Mechanics',
                                data: [data.registered_mechanics.karachi]
                            },
                            {
                                name: 'Registered Mechanics',
                                data: [data.registered_mechanics.lahore]
                            },
                            {
                                name: 'Registered Mechanics',
                                data: [data.registered_mechanics.islamabad]
                            }

                        ]);

                        customerChart.updateSeries([
                            {
                                name : 'New',
                                data : [ data.customers.new ]
                            },
                            {
                                name : 'Old',
                                data : [ data.customers.old ]
                            }
                        ]);

                        loop_Activity(data.activity_list);


                    }
                });
            }

            function loop_Activity($data){
                var wrapper = "";
                for (var i = 0; i < $data.length; i++) {
                    var tag_color = '';
                    switch($data[i].activity_type)
                    {
                        default:
                            tag_color = 'bg-warning';
                            break;
                        case 'login':
                            tag_color = 'bg-success';
                            break;
                        case 'logout':
                            tag_color = 'bg-danger';
                            break;
                    }
                    wrapper +=
                        '<div class="d-flex align-items-center space_border"><span class="bullet bullet-bar '+ tag_color +' align-self-stretch mr-3"></span><div class="d-flex flex-column flex-grow-1"><a href="#" class="text-dark-75 text-hover-primary font-weight-bold font-size-md mb-1">'+ capitalize($data[i].first_name) + ' ' + capitalize($data[i].last_name) + '</a><span class="text-muted font-weight-bold">'+ capitalize($data[i].activity_type) + ': ' + $data[i].created_at +'</span> </div> </div>';

                }

                $('.activity_list').prepend(wrapper);
            }
            function capitalize(s)
            {
                return s[0].toUpperCase() + s.slice(1);
            }

            function city_function(city){
                $('#city_holder').html(city);
                localStorage.setItem("city", city);
                getData();
            }

            $(function() {

                $('#kt_dashboard_daterangepicker').on('apply.daterangepicker', function(ev, picker) {
                    console.log('on apple date range values');
                    var start = $('#kt_dashboard_daterangepicker').data('daterangepicker').startDate.format('YYYY-MM-DD');
                    var end =   $('#kt_dashboard_daterangepicker').data('daterangepicker').endDate.format('YYYY-MM-DD');

                    console.log (start);
                    console.log (end);
                    localStorage.setItem('start_date', start);
                    localStorage.setItem('end_date', end);

                    getData();
                });
                getData();

            });

            var coversionBar_options = {
                chart: {
                    type: 'bar',
                    height: 400,
                    stacked: false,
                    foreColor: '#999',
                    toolbar: {
                        show: false
                    },
                },
                yaxis: {
                    tickAmount: 5,
                },
                responsive: [
                    {
                        breakpoint: 480,
                        options: {
                            legend: {
                                position: 'bottom',
                                offsetX: -10,
                                offsetY: 0
                            }
                        }
                    }
                ],

                colors: ["#47C4AB", '#BA95BE'],
                series: [
                ],
                dataLabels: {
                    enabled: true,
                    position: 'top',
                    style: {
                        colors: ['#444']
                    },
                    offsetY: -20
                },
                plotOptions: {
                    bar: {
                        dataLabels: {
                            position: 'top'
                        }
                    }
                },
                grid: {
                    xaxis: {
                        lines: {
                            show: false
                        },
                    },
                },
                legend: {
                    floating: true,
                    position: 'top',
                    horizontalAlign: 'right',
                    offsetY: -26,
                    markers: {
                        width: 20,
                    }
                },
                tooltip: {
                    shared: true
                }
            }
            var coversion_bar = new ApexCharts(document.querySelector('#coversion_bar'), coversionBar_options);
            coversion_bar.render();
            /* End Conversion Bar */


            /* Begin Activity Chart */
            var element = document.getElementById("activity_chart");
            var height = parseInt(KTUtil.css(element, 'height'));

            var strokeColor = '#D13647';

            var activityChartOptions = {
                series: [
                    /*{
                        name: 'Sales',
                        data: [500, 22, 30, 28, 25, 26, 30, 800, 22, 24, 25, 35]
                    }*/
                ],
                chart: {
                    type: 'area',
                    height: height,
                    toolbar: {
                        show: false
                    },
                    zoom: {
                        enabled: false
                    },
                    sparkline: {
                        //enabled: false
                    },
                    dropShadow: {
                        enabled: true,
                        enabledOnSeries: undefined,
                        top: 5,
                        left: 0,
                        blur: 3,
                        color: strokeColor,
                        opacity: 1
                    }
                },
                plotOptions: {},
                legend: {
                    show: false
                },
                dataLabels: {
                    enabled: false
                },
                fill: {
                    type: 'solid',
                    opacity: 1
                },
                stroke: {
                    curve: 'straight',
                    show: true,
                    width: 1,
                    colors: [strokeColor]
                },
                xaxis: {
                    axisBorder: {
                        show: false,
                    },
                    axisTicks: {
                        show: false
                    },
                    labels: {
                        show: false,
                        style: {
                            colors: '#9E9E9E',
                            fontSize: '12px',
                        }
                    },
                    crosshairs: {
                        show: false,
                        position: 'front',
                        stroke: {
                            color: '#9E9E9E',
                            width: 1,
                            dashArray: 3
                        }
                    }
                },
                tooltip: {
                    style: {
                        fontSize: '12px',
                    },
                    y: {
                        formatter: function (val) {
                            return  val + " Liter"
                        }
                    },
                    marker: {
                        show: false
                    }
                },
                colors: ['#EE8E90'],
                markers: {
                    colors: [],
                    strokeColor: [strokeColor],
                    strokeWidth: 3
                }
            }

            var actitvyChart = new ApexCharts(element, activityChartOptions);
            actitvyChart.render();
            /* End Activity Chart */

            var reg_mechs_options = {
                series: [
                    /*{
                        name: 'Registered Mechanics',
                        data: [10]
                    },
                    {
                        name: 'Registered Mechanics',
                        data: [10]
                    },
                    {
                        name: 'Registered Mechanics',
                        data: [7]
                    }*/
                ],
                chart: {
                    type: 'bar',
                    height: 300,
                    width: '100%',
                    parentHeightOffset: 0,
                    toolbar: {
                        show: false
                    },
                },
                tooltip: {
                    enabled: true,
                    x: {show: false},
                },
                plotOptions: {
                    bar: {
                        horizontal: false,
                        columnWidth: '80%',
                        endingShape: 'flat'
                    },
                },
                dataLabels: {
                    enabled: true
                },
                stroke: {
                    show: true,
                    width: 2,
                    colors: ['transparent']
                },
                xaxis: {
                    categories: ['Karachi', 'Lahore', 'Islamabad'],

                    labels: {
                        show: true,
                        rotate: 0,
                        rotateAlways: false,
                        trim: false,
                        style: {
                            fontSize: '12px',
                        },
                        offsetX: 0,
                        offsetY: 0,
                    },
                },
                fill: {
                    opacity: 1,
                    colors:['#74c51b','#8950fc', '#3699ff']
                },
                legend: {
                    show: false,
                    floating: true,
                    position: 'top',
                    horizontalAlign: 'right',
                    offsetY: -20,
                },
                colors:['#74c51b','#8950fc', '#3699ff']
            };

			var myPage = (function() {

				var that = {};

				that.init = function () {


                    $(document).ready(function() {
			oTable = $('#kt_datatable').DataTable( {
				dom: 'Bfrtip',
                responsive: true,
				buttons: [
                    {
                        extend: 'print',
                        exportOptions: {
                            columns: '.export',
                            orthogonal: 'export',
                        }
                    },
                    {
                        extend: 'copyHtml5',
                        exportOptions: {
                            columns: '.export',
                            orthogonal: 'export',
                        }
                    },
                    {
                        extend: 'excelHtml5',
                        exportOptions: {
                            columns: '.export',
                            orthogonal: 'export',
                        }
                    },
                    {
                        extend: 'csvHtml5',
                        exportOptions: {
                            columns: '.export',
                            orthogonal: 'export',
                        }
                    },
                    {
                        extend: 'pdfHtml5',
                        exportOptions: {
                            columns: '.export',
                            orthogonal: 'export',
                        }
                    },
				],
					"aaSorting": [],
					"order": [],
					ajax: {
                        url:"{{ route('ajax-role-list') }}",
                        method: "POST",
                        data: {
                            "_token": "{{ csrf_token() }}",
                            'date_filter' : function(){
                                return $('#kt_datepicker_3').val();
                            },
                            'role_id': 4
                        },
					},
				columns: [
                    { data: 'first_name' },//, render: function (data, type, row) {
                        //     return row.first_name+" "+row.last_name
                        // } },
                    { data: 'user_name' },
                    { data: 'loyalty_card_number' },
                    { data: 'assign_to_first_name' },
                    { data: 'phone' },
                    { data: 'cnic' },
                    { data: 'd_o_b' },
                    // { data: 'password_text' },
                    { data: 'location_to_be_place' },
                    { data: 'date' },
                    { data: 'purchases'},
                    { data: 'liters'},
                    { data: 'points'},
                    @if($role -> hasPermissionTo('Write Ustad'))
                        { data: 'action' }
                    @endif
				],
                columnDefs: [
                    {
                        targets: 0,
                        render: function(data, type, row, meta) {
                            if(type === 'export'){
                                return row.first_name + ` ` + row.last_name;
                            }else{ 
                                var output = `<a href="/user-managment-details/` + row.id + `" title="View User Profile"
                                                <div class="d-flex align-items-center">
                                                    <div class="symbol symbol-50 symbol-light-success" flex-shrink-0">
                                                        <div class="symbol-label font-size-h5">` + row.first_name.substring(0, 1) + `</div>
                                                    </div>
                                                    <div class="ml-3">
                                                        <span class="text-dark-75 font-weight-bold line-height-sm d-block pb-2">` + row.first_name + ` ` + row.last_name + `</span>
                                                    </div>
                                                </div>
                                            </a>
                                            `;
                                return output;
                            }
                        }
                    },
                    {
                        targets: 3,
                        render: function(data, type, row, meta) {
                            if(type === 'export'){
                                return row.first_name + ` ` + row.last_name;
                            }else{ 
                                var output = `<a href="`;
                                if(row.assign_to_Id == null){
                                    output += '#" ';
                                }else{
                                    output += `/user-managment-details/` + row.assign_to_Id + `" `;
                                }
                                output += `title="View User Profile"
                                                <div class="d-flex align-items-center">
                                                    <div class="symbol symbol-50 symbol-light-success" flex-shrink-0">
                                                        <div class="symbol-label font-size-h5">`;
                                                        if(row.assign_to_first_name == null){
                                                                output += "No Data.".substring(0, 1);
                                                            }else{
                                                                output += row.assign_to_first_name.substring(0, 1);
                                                            }
                                                        output += `</div>
                                                    </div>
                                                    <div class="ml-3">
                                                        <span class="text-dark-75 font-weight-bold line-height-sm d-block pb-2">`;
                                                        if(row.assign_to_first_name == null){
                                                            output += "No Data.";
                                                        }else{
                                                            output += row.assign_to_first_name + ` ` + row.assign_to_last_name;
                                                        }
                                                        output += `</span>
                                                    </div>
                                                </div>
                                            </a>
                                            `;
                                return output;
                            }
                        }
                    },
                    {
                        targets: 10,
                        render: function(data, type, row, meta) {
                            if(row.liters == null){
                                output = 0;
                            }else{
                                output = row.liters;
                            }
                            return output;
                        }
                    },
                    {
                        targets: 11,
                        render: function(data, type, row, meta) {
                            if(row.points == null){
                                output = 0;
                            }else{
                                output = row.points;
                            }
                            return output;
                        }
                    },
                ],
			} );
		} );

		$('#generalSearch').keyup(function(){
			oTable.search($(this).val()).draw() ;
		});

				}


	    		return that;

			})();



			$(document).ready(function() {
				myPage.init();

			});

        function btnPress(btn){
			if(btn.id == 'export_print'){
				pBtn = document.getElementsByClassName('buttons-print')[0];
			}else if(btn.id == 'export_copy'){
				pBtn = document.getElementsByClassName('buttons-copy')[0];
			}else if(btn.id == 'export_excel'){
				pBtn = document.getElementsByClassName('buttons-excel')[0];
			}else if(btn.id == 'export_csv'){
				pBtn = document.getElementsByClassName('buttons-csv')[0];
			}else if(btn.id == 'export_pdf'){
				pBtn = document.getElementsByClassName('buttons-pdf')[0];
			}
			pBtn.click();
		}

			function assign_value(values){
				//console.log(values.id);
				$('#role_'+values.id).html(values.total);
			}

    
		</script>
		<!--end::Page Vendors-->
	@endsection


