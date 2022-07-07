{{-- Mixed Widget 1 --}}

<div class="row">

    <div class="col-12 col-sm-6 col-xxl-4 mb-4 order-1">

        <div class="card bg-gray-100 {{ @$class }}">
            <div class="card-header border-0 bg-area py-5">
                <h3 class="card-title font-weight-bolder text-white">Activity</h3>
                <div class="card-toolbar">
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

    <div class="col-12 col-sm-6 col-xxl-4 mb-4 order-4 order-md-2">
        <div class="card h-100 ">
            <div class="card-header border-0">
                <h3 class="card-title font-weight-bolder text-dark">Registered Mechanics</h3>
            </div>

            <div class="card-body pt-2">
                <div id="registered-mechanics"></div>
            </div>
        </div>
    </div>

    <div class="col-12 col-sm-6 col-xxl-4 mb-4 order-2 order-md-3">
        <!--begin::List Widget 4-->
        <div class="card h-100">
            <!--begin::Header-->
            <div class="card-header border-0">
                <h3 class="card-title font-weight-bolder text-dark">Recent Activites</h3>
            </div>

            <div class="card-body pt-2 activity_list" style="height: 400px;">

            </div>
        </div>
    </div>

    <div class="col-12 col-sm-6 col-xxl-4 mb-4 order-5 order-md-4">
        <div class="card card-custom h-100">
            <div class="card-header border-0">
                <h3 class="card-title font-weight-bolder text-dark">Best Performing Ustaad Mechanic</h3>
            </div>

            <div class="card-body pt-2">
                <div id="best_performing_member"></div>
            </div>
        </div>
    </div>


    <div class="col-12 col-xxl-8 mb-4 order-3 order-md-5">
        <div class="card card-custom h-100">
            <div class="card-header border-0">
                <h3 class="card-title font-weight-bolder text-dark">Sales</h3>
            </div>
            <div class="card-body p-1">
                <div id="coversion_bar"></div>
            </div>
        </div>
    </div>

    <div class="col-12 col-sm-6 col-xxl-4 mb-4 order-6">
        <div class="card card-custom h-100">
            <div class="card-header border-0">
                <h3 class="card-title font-weight-bolder text-dark">Top Converting Brands</h3>
            </div>

            <div class="card-body pt-2">
                <div id="top_converted_brands"></div>
            </div>
        </div>
    </div>

    <div class="col-12 col-sm-6 col-xxl-4 mb-4 order-7">
        <div class="card card-custom h-100 ">
            <div class="card-header border-0">
                <h3 class="card-title font-weight-bolder text-dark">Customer Interactions by Cities</h3>
            </div>

            <div class="card-body pt-2">
                <div id="interception_by_cities"></div>
            </div>
        </div>
    </div>

    <div class="col-12 col-sm-6 col-xxl-4 mb-4 order-8">
        <div class="card card-custom h-100">
            <div class="card-header border-0">
                <h3 class="card-title font-weight-bolder text-dark">Customers</h3>
            </div>

            <div class="card-body pt-2">
                <div id="customer_chart"></div>
            </div>
        </div>
    </div>

</div>

<div class="clearfix mb-2"></div>
