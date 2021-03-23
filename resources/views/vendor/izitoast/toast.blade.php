<script>
    @if (session('success'))
        iziToast.show({
            title: 'Berhasil',
            message: `{{ session('success') }}`,
            color: 'green',
            icon: 'fas fa-check',
            position: 'topRight'
        });
    @endif
</script>