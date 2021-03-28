<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Laporan</title>
  <style>
    @page {margin-right:20px;margin-left:20px;margin-top:3px;margin-bottom:5px;font-family:'Helvetica';font-size:16px;}.text-center{text-align:center;}.center{text-align:center;}.no-space{margin:0;padding:0; }.no-space-h{margin-bottom:0;padding-bottom:0;text-transform: uppercase}.text-xs{font-size:11px;}.text-sm{font-size:13px;}.text-md{font-size:14px;}.bold{font-weight:bold}.table{line-height:18px;}.ttd-space{padding-top:60px;}.cap-space{padding-bottom:13px;}.text-lg{font-size: 15}.text-right{text-align: right}.text-center{text-align: center}.header{background-color: #cccccc; text-transform: uppercase;}.font-weight-bold{font-weight: bold;}.periode{margin-top: 0; padding-top: 0;}td{padding-right: 5px; padding-left: 5px}
  </style>
</head>
<body>
  <img style="float: left; margin: 1.2rem;" src="" alt="Logo Toko" width="90">
  <!-- Header -->
  <div class="row">
    <div class="col">
      <h3 style="margin-top: 2rem;" class="no-space-h">{{ 'SMK BAKTI NUSANTARA 666' }}</h3>
    </div>
  <div class="row text-sm">
    <div class="col">
      {{ 'Jawa Barat' . ', ' . 'Kabupaten Bandung' . ' ' . 'Jalan Percobaan' }}
    </div>
  </div>
  <div class="row text-sm">
    <div class="col">
      Telp. {{ '085321757616' . ' Email : ' . 'smkbn666@gmail.com' }}
    </div>
  </div>
  <div class="row text-sm">
    <div class="col">
      Web : {{ 'repo.smkbn666.com' }}
    </div>
  </div>
  <hr style="height:1px;border:none;color:#333;background-color:#333; margin-top: 1rem; margin-bottom: 0rem;">

  @yield('content')

</body>
</html>