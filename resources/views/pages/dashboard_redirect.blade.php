<script type="text/javascript">
	@if(Auth::user()->role_id == 3)
		window.location.href = "{{ route('trucker-profile') }}";
	@else
		window.location.href = "{{ route('purchase') }}";
	@endif
</script>