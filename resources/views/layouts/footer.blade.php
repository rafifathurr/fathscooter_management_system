<footer class="footer">
    <div class="container-fluid">
        {{-- <nav class="pull-left">
            <ul class="nav">
                <li class="nav-item">
                    <a class="nav-link" href="#">
                        About us
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">
                        Help
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">
                        Contact us
                    </a>
                </li>
            </ul>
        </nav> --}}
        <div class="copyright ml-auto">
            Copyright ©2022<a class="ml-1" href="#">FathScooter</a>
        </div>
    </div>
</footer>
<!--   Core JS Files   -->
<script src="{{ asset('js/core/jquery.3.2.1.min.js') }}"></script>
<script src="{{ asset('js/core/popper.min.js') }}"></script>
<script src="{{ asset('js/core/bootstrap.min.js') }}"></script>
<!-- jQuery UI -->
<script src="{{ asset('js/plugin/jquery-ui-1.12.1.custom/jquery-ui.min.js') }}"></script>
<script src="{{ asset('js/plugin/jquery-ui-touch-punch/jquery.ui.touch-punch.min.js') }}"></script>
<!-- jQuery Scrollbar -->
<script src="{{ asset('js/plugin/jquery-scrollbar/jquery.scrollbar.min.js') }}"></script>
<!-- Chart JS -->
<script src="{{ asset('js/plugin/chart.js/chart.min.js') }}"></script>
<!-- jQuery Sparkline -->
<script src="{{ asset('js/plugin/jquery.sparkline/jquery.sparkline.min.js') }}"></script>
<!-- Chart Circle -->
<script src="{{ asset('js/plugin/chart-circle/circles.min.js') }}"></script>
<!-- Datatables -->
<script src="{{ asset('js/plugin/datatables/datatables.min.js') }}"></script>
<!-- Bootstrap Notify -->
<script src="{{ asset('js/plugin/bootstrap-notify/bootstrap-notify.min.js') }}"></script>
<!-- Sweet Alert -->
<script src="{{ asset('js/plugin/sweetalert/sweetalert.min.js') }}"></script>
<!-- Atlantis JS -->
<script src="{{ asset('js/atlantis.min.js') }}"></script>
<!-- Atlantis DEMO methods, don't include it in your project! -->
<script src="{{ asset('js/setting-demo.js') }}"></script>
<script src="{{ asset('js/demo.js') }}"></script>
<script src="{{url('js/plugin/inputmask/jquery.inputmask.bundle.js')}}"></script>

<script type="text/javascript">

    function AlertData(){
        swal({
            title: "Incomplete Data!",
            text: "Please Complete The Data First",
            icon: "warning",
            button: false,
            timer: 2000
        });
    }

    $('.numeric').inputmask({
        alias:"numeric",
        prefix: "Rp.",
        digits:0,
        repeat:20,
        digitsOptional:false,
        decimalProtect:true,
        groupSeparator:".",
        radixPoint:",",
        radixFocus:true,
        autoGroup:true,
        autoUnmask:false,
        clearMaskOnLostFocus: false,
        onBeforeMask: function (value, opts) {
            return value;
        },
        removeMaskOnSubmit:true
    });

</script>
