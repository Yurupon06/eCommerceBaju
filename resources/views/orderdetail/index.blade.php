@extends('dashboard.master')
@section('nav')
    @include('dashboard.nav')

@endsection

@section('page-title', 'orderdetail')
@section('page', 'orderdetail')
@section('main')
    @include('dashboard.main')


<div class="container-fluid py-4">
    <div class="row">
      <div class="col-12">
        <div class="card mb-4">
          <div class="card-header pb-0">
            <h6>orderdetail</h6>
          </div>
          <div class="card-body px-0 pt-0 pb-2">
            <div class="table-responsive p-0">
              <table class="table align-items-center mb-0" id="datatable">
                <thead>
                  <tr>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">No</th>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Product name</th>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2"></th>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Order id</th>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">quantity</th>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">subtotal</th>
                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Action</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($orderdetail as $idx => $dt)
                  <tr>
                    <td>
                      <div class="d-flex px-2 py-1">
                        {{ $idx + 1 . " . " }}
                      </div>
                    </td>
                    <td>
                        {{ $dt->product->product_name }}
                    </td>
                    <td>
                      <img src="storage/{{ $dt->product->image1_url }}" class="img-thumbnail" alt="" style="max-width: 100px; max-height: 100px;">
                    </td>
                    <td>
                     {{ $dt->order->id }}
                    </td>
                    <td>
                     {{ $dt->quantity }}x
                    </td>
                    <td>
                     ${{ $dt->subtotal }}
                    </td>
                    <td class="align-middle text-center text-sm">
                      <a href=""><span class="badge badge-sm bg-gradient-success">edit</span></a>
                      <form action="" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="badge badge-sm bg-gradient-danger" onclick="return confirm('Are you sure you want to delete this product?')">hapus</button>
                    </form>
                    </td>
                  </tr>
                  @endforeach
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>

    <input type="hidden" id="sts" class="form-control" value="{{ $status ?? '' }}" />
    <input type="hidden" id="psn" class="form-control" value="{{ $pesan ?? '' }}" /> 

    <script>
      const body = document.getElementById("master");
      const sts = document.getElementById("sts");
      const psn = document.getElementById("psn");
    
      function pesanSimpan() {
        if (sts.value === 'simpan') {
          swal("Good job", psn.value, "success");
        }
      }
    
      body.onload = function() {
        pesanSimpan();
      };
    </script>

  </div>
  @endsection