
<script>
    $(function() {
        @if ($errors->any())
            @foreach($errors->all() as $error)
                toastr.error('{{ $error }}')
            @endforeach
        @endif

        @if (session('success'))
            toastr.success('{{ session('success') }}')
        @elseif(session('error'))
            toastr.error('{{ session('error') }}')
        @elseif(session('warning'))
            toastr.warning('{{ session('warning') }}')
        @elseif(session('info'))
            toastr.info('{{ session('info') }}')
        @endif
    })

</script>
