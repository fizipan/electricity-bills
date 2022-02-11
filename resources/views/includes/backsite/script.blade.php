<!-- BEGIN: Vendor JS-->
<script src="{{ asset('/back-design/app-assets/vendors/js/vendors.min.js') }}"></script>
<!-- BEGIN Vendor JS-->

<!-- BEGIN: Page Vendor JS-->
<script src="{{ asset('/back-design/app-assets/vendors/js/tables/datatable/datatables.min.js') }}"></script>
<script src="{{ asset('/back-design/app-assets/vendors/js/tables/datatable/dataTables.responsive.min.js') }}"></script>
<script src="{{ asset('/back-design/app-assets/vendors/js/forms/select/select2.full.min.js') }}"></script>
<script src="{{ asset('/back-design/app-assets/vendors/js/ui/jquery.sticky.js') }}"></script>
<script src="{{ asset('/back-design/app-assets/vendors/js/charts/jquery.sparkline.min.js') }}"></script>
<script src="{{ asset('/back-design/app-assets/vendors/js/forms/tags/form-field.js') }}"></script>
<script src="{{ asset('/back-design/app-assets/vendors/js/pagination/jquery.twbsPagination.min.js') }}"></script>
<!-- END: Page Vendor JS-->

<!-- BEGIN: Theme JS-->
<script src="{{ asset('/back-design/app-assets/js/core/app-menu.min.js') }}"></script>
<script src="{{ asset('/back-design/app-assets/js/core/app.min.js') }}"></script>
<!-- END: Theme JS-->

<!-- BEGIN: Page JS-->
<script src="{{ asset('/back-design/app-assets/js/scripts/forms/select/form-select2.js') }}"></script>
<script src="{{ asset('/back-design/app-assets/js/scripts/tables/datatables/datatable-api.js') }}"></script>
<script src="{{ asset('/back-design/app-assets/js/scripts/forms/custom-file-input.js') }}"></script>
<script src="{{ asset('/back-design/app-assets/js/scripts/tooltip/tooltip.js') }}"></script>
<script src="{{ asset('/back-design/app-assets/js/scripts/popover/popover.js') }}"></script>
<script src="{{ asset('/back-design/app-assets/js/scripts/modal/components-modal.js') }}"></script>
<script src="{{ asset('/back-design/app-assets/js/scripts/pagination/pagination.js') }}"></script>
<!-- END: Page JS-->

{{-- third party --}}
<script src="{{ url('https://unpkg.com/boxicons@latest/dist/boxicons.js') }}"></script>

{{-- inputmask --}}
<script src="{{ asset('/back-design/third-party/inputmask/dist/jquery.inputmask.js') }}"></script>
<script src="{{ asset('/back-design/third-party/inputmask/dist/inputmask.js') }}"></script>
<script src="{{ asset('/back-design/third-party/inputmask/dist/bindings/inputmask.binding.js') }}"></script>

{{-- formater --}}
<script src="{{ asset('/back-design/third-party/formatter/dist/jquery.formatter.min.js') }}"></script>
<script src="{{ asset('/back-design/third-party/formatter/dist/formatter.min.js') }}"></script>

{{-- ordering datatable --}}
<script>
    $(function () {
        $(":input").inputmask();
    });
</script>