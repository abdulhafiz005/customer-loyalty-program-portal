{{-- Subheader V1 --}}

<div class="subheader py-2 {{ Metronic::printClasses('subheader', false) }}" id="kt_subheader">
    <div class="{{ Metronic::printClasses('subheader-container', false) }} d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">

		{{-- Info --}}
        <div class="d-flex align-items-center flex-wrap mr-1">

			{{-- Page Title --}}
            <!-- <h5 class="text-dark font-weight-bold my-2 mr-5">
                {{ @$page_title }}

                @if (isset($page_description) && config('layout.subheader.displayDesc'))
                    <small>{{ @$page_description }}</small>
                @endif
            </h5> -->

            @if (!empty($page_breadcrumbs))
				{{-- Separator --}}
                <div class="subheader-separator subheader-separator-ver my-2 mr-4 d-none"></div>

				{{-- Breadcrumb --}}
                <ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2">
                    <li class="breadcrumb-item"><a href="#"><i class="flaticon2-shelter text-muted icon-1x"></i></a></li>
                    @foreach ($page_breadcrumbs as $k => $item)
						<li class="breadcrumb-item">
                        	<a href="{{ url($item['page']) }}" class="text-muted">
                            	{{ $item['title'] }}
                        	</a>
						</li>
                    @endforeach
                </ul>
            @endif
        </div>

		{{-- Toolbar --}}
        <div class="d-flex align-items-center">

            @hasSection('page_toolbar')
                @section('page_toolbar')
            @endif

        </div>

        @if (config('layout.ar.main'))
            <div class="d-flex align-items-center">
                @if (config('layout.subheader.displayDaterangepicker'))
                    <a href="#" class="btn btn-light btn-sm font-weight-bold mr-2" id="kt_dashboard_daterangepicker" data-toggle="tooltip" title="Select dashboard daterange" data-placement="left">
                        <span class="text-muted font-weight-bold" id="kt_dashboard_daterangepicker_title">Today</span>&nbsp;
                        <span class="text-primary font-weight-bold" id="kt_dashboard_daterangepicker_date">Aug 17</span>
                        {{-- <i class="flaticon2-calendar-1"></i> --}}
                        {{ Metronic::getSVG("media/svg/icons/Communication/Chat-check.svg", "svg-icon-sm svg-icon-primary ml-1") }}
                    </a>
                @endif

                <!-- <a href="#" class="btn btn-clean btn-hover-light-primary-  btn-sm font-weight-bold font-size-base mr-1">
                    Year
                </a> -->

                <div class="btn-group">
                    <button class="btn btn-primary font-weight-bold btn-sm dropdown-toggle" type="button" id="city_holder" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        All Cities
                    </button>
                    <div class="dropdown-menu" id="city">
                        <a class="dropdown-item" href="#" onclick="city_function('All Cities');return false;" >All Cities</a>
                        @foreach($cities as $city)
                            <a class="dropdown-item" href="#" onclick="city_function('{{$city->city}}');return false;" >{{$city->city}}</a>
                        @endforeach
                        <!-- <a class="dropdown-item" href="#" onclick="city_function('Karachi');return false;" >Karachi</a>
                        <a class="dropdown-item" href="#" onclick="city_function('Lahore');return false;" >Lahore</a>
                        <a class="dropdown-item" href="#" onclick="city_function('Islamabad');return false;" >Islamabad</a> -->
                    </div>
                </div>

            </div>
         @endif
    </div>
</div>
