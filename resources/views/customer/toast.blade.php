			@if(session('success'))
			<div class="position-fixed bottom-0 end-0 p-3" style="z-index: 11">
				<div id="success" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
					<div class="toast-header bg-success">
						<strong class="me-auto text-white">Success</strong>
						<button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
					</div>
					<div class="toast-body">
						{{session('success')}}
					</div>
				</div>
			</div>
			@endif
			@if(session('error'))
			<div class="position-fixed bottom-0 end-0 p-3" style="z-index: 11">
				<div id="error" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
					<div class="toast-header bg-danger">
						<strong class="me-auto text-white">Error</strong>
						<button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
					</div>
					<div class="toast-body">
						{{session('error')}}
					</div>
				</div>
			</div>
			@endif
			@if(session('success'))
			<script>
				document.addEventListener('DOMContentLoaded', function () {
					var toastElement = document.getElementById('success');
					var toast = new bootstrap.Toast(toastElement);
					toast.show();
				});
			</script>
			@endif
			@if(session('error'))
			<script>
				document.addEventListener('DOMContentLoaded', function () {
					var toastElement = document.getElementById('error');
					var toast = new bootstrap.Toast(toastElement);
					toast.show();
				});
			</script>
			@endif