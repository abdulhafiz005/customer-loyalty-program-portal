{{-- Footer --}}

<div class="footer bg-white py-4 d-flex flex-lg-column {{ Metronic::printClasses('footer', false) }}" id="kt_footer">
    {{-- Container --}}
    <div class="{{ Metronic::printClasses('footer-container', false) }} d-flex flex-column flex-md-row align-items-center justify-content-between">
        {{-- Copyright --}}
         <div class="container-fluid d-flex flex-column text-center align-items-center justify-content-between">
            <!--begin::Copyright-->
                <div class="text-dark order-2 order-md-1">
                    <span class="text-muted font-weight-bold mr-2">Copyright {{date('Y')}} &#169; </span>
                    <a href="#" class="text-dark-75 text-hover-primary">Shell Pakistan</a>
                </div>
            <!--end::Copyright-->
        </div>
    </div>
</div>