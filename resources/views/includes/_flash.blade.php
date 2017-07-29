@if (session('message'))
    <script>
      toastr.options = {
        "closeButton": false,
        "debug": false,
        "newestOnTop": false,
        "progressBar": false,
        "positionClass": "toast-bottom-right",
        "preventDuplicates": false,
        "onclick": null,
        "showDuration": "30",
        "hideDuration": "80",
        "timeOut": "{{ session('timeOut') ?? 490 }}",
        "extendedTimeOut": "150",
        "showEasing": "swing",
        "hideEasing": "linear",
        "showMethod": "fadeIn",
        "hideMethod": "fadeOut"
      }
      toastr["{{ session('notification') ?? 'info' }}"]("{{ session('message') }}")
    </script>
@endif
