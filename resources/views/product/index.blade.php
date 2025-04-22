@extends('dashboard.master')
@section('nav')
    @include('dashboard.nav')

@endsection

@section('page-title', 'Product')
@section('page', 'Product')
@section('main')
    @include('dashboard.main')


<div class="container-fluid py-4">
    <div class="row">
      <div class="col-12">
        <div class="card mb-4">
          <div class="card-header pb-0">
            <a href="{{route('product.create')}}"><span class="badge badge-sm bg-gradient-primary mb-3 fs-6 ">add new item</span></a>
            <h6>Product</h6>
          </div>
          <div class="card-body px-0 pt-0 pb-2">
            <div class="table-responsive p-0">
              <table class="table align-items-center mb-0" id="datatable">
                <thead>
                  <tr>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">No</th>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Category</th>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Product name</th>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">description</th>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">price</th>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">stok</th>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">image1</th>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">image2</th>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">image3</th>
                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Action</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach ($product as $idx => $dt)
                  <tr>
                    <td>
                      <div class="d-flex px-2 py-1">
                        {{ $idx + 1 . " . " }}
                      </div>
                    </td>
                    <td>
                     {{ $dt->category->category_name }}
                    </td>
                    <td>
                     {{ $dt->product_name }}
                    </td>
                    @if ( strlen($dt->description) > 10)
                    <td data-bs-toggle="tooltip" data-bs-placement="right" data-bs-custom-class="custom-tooltip" data-bs-title="{{ $dt->description }}" style="cursor: help;">
                      {{ substr($dt->description, 0, 10) . '...'}}
                    </td>
                    @else
                      <td>{{ $dt->description }}</td>
                    @endif
                    <td>
                     ${{ $dt->price }}
                    </td>
                    <td>
                     {{ $dt->stok_quantity }}
                    </td>
                    <td>
                      <img src="{{ asset('storage/' . $dt->image1_url) }}" class="img-thumbnail" alt="" style="max-width: 100px; max-height: 100px;">
                    </td>
                    <td>
                      <img src="{{ asset('storage/' . $dt->image2_url) }}" class="img-thumbnail" alt="" style="max-width: 100px; max-height: 100px;">
                    </td>
                    <td>
                      <img src="{{ asset('storage/' . $dt->image3_url) }}" class="img-thumbnail" alt="" style="max-width: 100px; max-height: 100px;">
                    </td>
                    <td class="align-middle text-center text-sm">
                      <a href="{{route('product.edit', $dt->id)}}"><span class="badge badge-sm bg-gradient-success">edit</span></a>
                      <form action="{{ route('product.destroy', $dt->id) }}" method="POST" class="d-inline">
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