@extends('pegawai.layouts.main')

@section('isi')

    <div class="container-fluid py-4">
        {{-- <h1>
        HALAMAN HRD
    </h1> --}}

    <br>

    <?php #region ?>
      <div class="row">
        <div class="col-xl-4 col-sm-6 mb-xl-0 mb-4">
          <div class="card">
            <div class="card-header p-3 pt-2">
              <div class="icon icon-lg icon-shape bg-gradient-info shadow-primary text-center border-radius-xl mt-n4 position-absolute">
                <i class="material-icons opacity-10">person</i>
              </div>
              <div class="text-end pt-1">
                <p class="text-sm mb-0 text-capitalize">PEGAWAI</p>
                <h4 class="mb-0">{{$user->count()}}</h4>
              </div>
            </div>
            {{-- <hr class="dark horizontal my-0">
            <div class="card-footer p-3">
              <p class="mb-0"><span class="text-success text-sm font-weight-bolder">+3% </span>than last month</p>
            </div> --}}
          </div>
        </div>
        <div class="col-xl-4 col-sm-6 mb-xl-0 mb-4">
          <div class="card">
            <div class="card-header p-3 pt-2">
              <div class="icon icon-lg icon-shape bg-gradient-primary shadow-dark text-center border-radius-xl mt-n4 position-absolute">
                <i class="material-icons opacity-10">weekend</i>
              </div>
              <div class="text-end pt-1">
                <p class="text-sm mb-0 text-capitalize">UANG KELUAR</p>
                <h4 class="mb-0">@rp($uangKeluar)</h4>
              </div>
            </div>
          </div>
        </div>
        <div class="col-xl-4 col-sm-6 mb-xl-0 mb-4">
          <div class="card">
            <div class="card-header p-3 pt-2">
              <div class="icon icon-lg icon-shape bg-gradient-success shadow-success text-center border-radius-xl mt-n4 position-absolute">
                <i class="material-icons opacity-10">weekend</i>
              </div>
              <div class="text-end pt-1">
                <p class="text-sm mb-0 text-capitalize">SALDO PETTY CASH</p>
                
                <h4 class="mb-0">@rp($saldoTotal)</h4>
              </div>
            </div>
            {{-- <hr class="dark horizontal my-0">
            <div class="card-footer p-3">
              <p class="mb-0 font-weight-bolder">Bulan {{date('M')}} Mengalami</p>
            </div> --}}
          </div>
        </div>
      </div>

      <div class="col-xl-4 col-sm-6 mb-xl-0 mb-4 mt-4">
          <div class="card">
            <div class="card-header p-3 pt-2">
                <form action="/hrd/dashboard" method="get" style="display: flex">
                            <div class="col-4">
                                <label class="text-xl text-dark font-weight-bolder col-6">Tahun</label>
                                <input type="number" id="tanggal" class="form-control ms-1" style="height: 30px" name="tahun" placeholder="dd-mm-yy" value="{{ request('tahun') }}">
                            </div>
                            <div class="col-4 mx-4">
                                <button type="submit" class="btn bg-gradient-info col-10 w-15 my-4 mb-2">C</button>
                            </div>
                        </form>
            </div>
          </div>
      </div>

      <script>

      </script>

      <div class="row mt-4">
        <div class="col-lg-12 col-md-12 mt-4 mb-4">
          <div class="card z-index-2 ">
            <div class="card-header p-0 position-relative mt-n4 mx-3 z-index-2 bg-transparent">
              <div class="bg-gradient-primary shadow-primary border-radius-lg py-3 pe-1">
                <div class="chart">
                    @include('Admin.chart.pie')
                </div>
              </div>
            </div>

          </div>
        </div>

      </div>

    </div>

    <script>
        var dataChart= {{json_encode($dataChart)}}
        var dataLabel= @json($dataLabel)

    </script>

@endsection
