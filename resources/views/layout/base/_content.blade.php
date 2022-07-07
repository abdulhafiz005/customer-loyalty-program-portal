{{-- Content --}}
@if (config('layout.content.extended'))
   
@else
    <div class="d-flex flex-column-fluid">
        <div class="container-fluid">
            @yield('content')
        </div>
    </div>
@endif
