@if(Session::has('success'))
    <script type="text/javascript">
    swal({
        icon: 'success',
        text: '{{Session::get("success")}}',
        button: false,
        timer: 1500
    });
    </script>
    <?php
        Session::forget('success');
    ?>
    @endif
    @if(Session::has('gagal'))
    <script type="text/javascript">
    swal({
        icon: 'warning',
        title: 'Oops !',
        button: false,
        text: '{{Session::get("gagal")}}',
        timer: 1500
    });
    </script>
    <?php
        Session::forget('gagal');
    ?>
@endif
