@if(session()->has('flash_notification.message'))
    <script>
        $(document).ready(function() {
            Materialize.toast('@if(session('flash_notification.icon'))<i class="{{ session('flash_notification.icon') }}" style="margin-right:5px"></i>@endif {{ session('flash_notification.message') }}', 3000, '{{ session('flash_notification.level') }}');
        })
    </script>
@endif
