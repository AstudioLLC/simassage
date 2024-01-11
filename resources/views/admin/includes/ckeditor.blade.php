<script src="{{ asset('cms') }}/vendor/ckeditor/ckeditor.js"></script>
<script src="{{ asset('cms') }}/vendor/ckfinder/ckfinder.js"></script>
<script>
    CKFinder.config( { connectorPath: {!! json_encode(route('ckfinder_connector'))  !!} } );
</script>
