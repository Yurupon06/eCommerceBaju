@extends('dashboard.master')
@section('nav')
    @include('dashboard.nav')

@endsection

@section('page-title', 'order')
@section('page', 'order')
@section('main')
    @include('dashboard.main')


<div class="container-fluid py-4">
    <div class="row">
      <div class="col-12">
        <div class="card mb-4">
          <div class="card-header pb-0">
            <h6>order</h6>
          </div>
          <div class="card-body px-0 pt-0 pb-2">
            <div class="table-responsive p-0">
              <table class="table align-items-center mb-0" id="datatable">
                <thead>
                  <tr>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">No</th>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Customer name</th>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Order date</th>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">total amount</th>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">status</th>
                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Action</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($order as $idx => $dt)
                  <tr>
                    <td>
                      <div class="d-flex px-2 py-1">
                        {{ $idx + 1 . " . " }}
                      </div>
                    </td>
                    <td>
                     {{ $dt->customer->name }}
                    </td>
                    <td>
                     {{ $dt->order_date }}
                    </td>
                    <td>
                     ${{ $dt->total_amount }}
                    </td>
                    <td>
                     {{ $dt->status }}
                    </td>
                    <td class="align-middle text-center text-sm">
                      <a href="{{route('order.edit', $dt->id)}}"><span class="badge badge-sm bg-gradient-success">edit</span></a>
                      <form action="{{ route('order.destroy', $dt->id) }}" method="POST" class="d-inline">
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