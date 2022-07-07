{{-- Mixed Widget 1 --}}

<div class="row">

    <div class=" col-md-4 col-sm-12">

        <div class="card bg-gray-100 {{ @$class }}">
            <div class="card-header border-0 bg-area py-5">
                <h3 class="card-title font-weight-bolder text-white">Activity</h3>
                <div class="card-toolbar">
                    <!-- <div class="dropdown dropdown-inline" style="float: right;">
                        <a href="#" class="btn btn-transparent-white btn-sm font-weight-bolder dropdown-toggle px-5" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="background-color: black;">Export</a>
                            <div class="dropdown-menu dropdown-menu-sm dropdown-menu-right" style=""> -->
                                <!--begin::Navigation-->
                                <!-- <ul class="navi navi-hover">
                                    <li class="navi-header pb-1">
                                        <span class="text-primary text-uppercase font-weight-bold font-size-sm">CSV</span>
                                    </li>
                                </ul> -->
                                                            <!--end::Navigation-->
                         <!--    </div>
                    </div> -->
                </div>
            </div>

            <div class="card-body p-0 position-relative overflow-hidden">
                {{-- Chart --}}
                <div id="activity_chart" class="card-rounded-bottom bg-area" style="height: 200px"></div>

                {{-- Stats --}}
                <div class="card-spacer mt-n25">

                    <div class="row m-0">
                        <div class="col bg-white pt-2 mr-2 mb-2">
                            <div class="dt_sm_card pt-1">
                                {{ Metronic::getSVG("media/svg/icons/Design/Layers.svg", "svg-icon-2x svg-icon-danger my-2 p-1") }}
                                <div class="dt_sm_card2">
                                    <span class="display4 display4-lg font-weight-boldest" id="p_liter"></span><br>
                                    <span class="text-muted font-size-sm font-weight-bold">Sales</span>
                                </div>
                            </div>
                        </div>

                        <div class="col bg-white pt-2 mr-2 mb-2">
                            <div class="dt_sm_card pt-1">
                                {{ Metronic::getSVG("media/svg/icons/Home/Library.svg", "svg-icon-2x svg-icon-primary d-block my-2 p-1") }}
                                <div class="dt_sm_card2">
                                    <span class="display4 display4-lg font-weight-boldest" id="lp_members"></span><br>
                                    <span class="text-muted font-size-sm font-weight-bold">Loyalty Program Members</span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row m-0">
                        <div class="col bg-white pt-2 mr-2 mb-2">
                            <div class="dt_sm_card pt-1">
                                {{ Metronic::getSVG("media/svg/icons/Communication/Urgent-mail.svg", "svg-icon-2x svg-icon-warning d-block my-2 p-1") }}
                                <div class="dt_sm_card2">
                                    <span class="display4 display4-lg font-weight-boldest" id="t_ba"></span><br>
                                    <span class="text-muted font-size-sm font-weight-bold">Active BA</span>
                                </div>
                            </div>
                        </div>

                        <div class="col bg-white pt-2 mr-2 mb-2">
                            <div class="dt_sm_card pt-1">
                                {{ Metronic::getSVG("media/svg/icons/Design/PenAndRuller.svg", "svg-icon-2x svg-icon-danger d-block my-2 p-1") }}
                                <div class="dt_sm_card2">
                                    <span class="display4 display4-lg font-weight-boldest" id="t_interceptions"></span><br>
                                    <span class="text-muted font-size-sm font-weight-bold">Interceptions</span>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

        </div>
    </div>

    <div class="col-md-4 col-sm-12 card-stretch">
        <div class="card h-100 ">
            <div class="card-header border-0">
                <h3 class="card-title font-weight-bolder text-dark">Registered Mechanics</h3>
            </div>

            <div class="card-body pt-2">
                <div id="registered-mechanics"></div>
            </div>
        </div>
    </div>

    <div class="col-md-4 col-sm-12 card-stretch">
        <!--begin::List Widget 4-->
        <div class="card h-100">
            <!--begin::Header-->
            <div class="card-header border-0">
                <h3 class="card-title font-weight-bolder text-dark">Recent Activites</h3>
            </div>

            <div class="card-body pt-2 activity_list" style="height: 400px;">

                <!-- @foreach($activities as $part)
                    <div class="d-flex align-items-center space_border">
                        <span class="bullet bullet-bar bg-warning align-self-stretch mr-3"></span>
                        <div class="d-flex flex-column flex-grow-1">
                            <a href="#" class="text-dark-75 text-hover-primary font-weight-bold font-size-md mb-1">
                                {{ $part->acticvty }}
                            </a>
                            <span class="text-muted font-weight-bold">
                                {{ $diff = Carbon\Carbon::parse($part->created_at)->diffForHumans() }}
                            </span>
                        </div>
                    </div>
                @endforeach -->

            </div>
        </div>
    </div>

</div>

<div class="clearfix mb-2"></div>
