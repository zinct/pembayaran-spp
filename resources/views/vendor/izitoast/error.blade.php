<script>
  @if (session('error'))
      iziToast.show({
          title: 'Gagal',
          message: `{{ session('error') }}`,
          color: 'red',
          icon: 'fas fa-times',
          position: 'topRight'
      });
  @endif
</script>