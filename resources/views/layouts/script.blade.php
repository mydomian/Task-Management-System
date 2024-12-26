<script src="{{ asset('/storage/assets/vendor/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('/storage/assets/vendor/popper.js/umd/popper.min.js') }}"> </script>
<script src="{{ asset('/storage/assets/vendor/bootstrap/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('/storage/assets/vendor/jquery-validation/jquery.validate.min.js') }}"></script>
<script src="{{ asset('/storage/assets/js/front.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>

    function confirmDelete(taskId) {
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById(`delete-task-${taskId}`).submit();
            }
        });
    }
    function confirmLogout(event) {
        event.preventDefault();
        Swal.fire({
        title: 'Are you sure?',
        text: "You will be logged out!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Yes, logout!',
        cancelButtonText: 'Cancel'
        }).then((result) => {
        if (result.isConfirmed) {
            window.location.href = '{{ route('logout') }}';
        }
        });
    }

    @if (Session::has('success'))
        toastr.options = {
            "closeButton": true,
            "progressBar": true
        }
        toastr.success("{{ session('success') }}");
    @endif

    @if (Session::has('error'))
        toastr.options = {
            "closeButton": true,
            "progressBar": true
        }
        toastr.error("{{ session('error') }}");
    @endif

    @if (Session::has('info'))
        toastr.options = {
            "closeButton": true,
            "progressBar": true
        }
        toastr.info("{{ session('info') }}");
    @endif

    @if (Session::has('warning'))
        toastr.options = {
            "closeButton": true,
            "progressBar": true
        }
        toastr.warning("{{ session('warning') }}");
    @endif
</script>
@stack('scripts')
