@extends('dashboard.master')
@section('title', 'Categories')
@section('nav')
    @include('dashboard.nav')
@endsection
@section('page', 'Categories')
@section('main')
    @include('dashboard.main')

<!-- Tables -->
    <div class="container-fluid py-4">
      <div class="row">
        <div class="col-12">
          <div class="card mb-4">
            <div class="card-header pb-0">
              <h6>New Categories</h6>
            </div>
            <div class="card-body px-0 pt-0 pb-2">
              <div class="table-responsive p-0">
                <div class="card border-1 m-3 pt-3">
                  <form action="{{ route('product.store')}}" id="formproduct" method="POST" enctype="multipart/form-data">
                      @csrf
                      <div class="mb-2 ms-3 me-3">
                        <label for="product_category_id" class="form-label">Nama category_name</label>
                        <select id="product_category_id" name="product_category_id" class="ps-2 form-select" aria-label="Default select example">
                          <option @if (!isset($product_category_id)) selected @endif selected>Open this select menu</option>
                          @foreach ($category_name as $data)
                          <option value="{{$data->id}}" @if(isset($product_category_id) and $data->id === $product_category_id) selected @endif>{{$data->category_name}}</option>
                          @endforeach
                        </select>
                    </div>
                      <div class="mb-3 ms-3 me-3">
                        <label for="product_name" class="form-label">Product Name</label>
                        <input type="text" class="ps-2 form-control border border-secondary-subtle" placeholder="Product Categories" aria-label="Name" id="product_name" name="product_name">
                      </div>
                      <div class="mb-3 ms-3 me-3">
                        <label for="description" class="form-label">description</label>
                        <textarea class="ps-2 form-control border border-secondary-subtle" name="description" id="description" placeholder="Deskiripsi"></textarea>
                    </div>
                    <div class="mb-3 ms-3 me-3">
                        <label for="price" class="form-label">price</label>
                        <input id="price" name="price" type="text" class="ps-2 form-control border border-secondary-subtle" placeholder="price">
                    </div>
                    <div class="mb-3 ms-3 me-3">
                        <label for="stok_quantity" class="form-label">stok_quantity</label>
                        <input type="number" name="stok_quantity" id="stok_quantity" class="ps-2 form-control border border-secondary-subtle" placeholder="stok_quantity">
                    </div>
                    <div class="mb-3 ms-3 me-3">
                        <label for="image1_url" class="formlabel">image _url1</label>
                        <input class="ps-2 form-control border border-secondary-subtle @error('image1_url') isinvalid @enderror" type="file" id="image1_url" name="image1_url">
                    </div>
                    <div class="mb-3 ms-3 me-3">
                        <label for="image2_url" class="formlabel">image _url2</label>
                        <input class="ps-2 form-control border border-secondary-subtle @error('image2_url') isinvalid @enderror" type="file" id="image2_url" name="image2_url">
                    </div>
                    <div class="mb-3 ms-3 me-3">
                        <label for="image3_url" class="formlabel">image _url3</label>
                        <input class="ps-2 form-control border border-secondary-subtle @error('image3_url') isinvalid @enderror" type="file" id="image3_url" name="image3_url">
                    </div>
                    <div class="ms-3 me-3 text-end">
                          <a href="{{ route('product.index') }}" type="button" class="btn bg-gradient-primary ws-15 my-4 mb-2">Cancel</a>
                          <button type="submit" class="btn bg-gradient-success ws-15 my-4 mb-2" id="save">Save</button>
                    </div>
                  </form>
                </div>
              </div>
          </div>
          </div>
        </div>
      </div>

<!-- Close Tables -->

    </div>
    <div style="visibility: hidden;" id="status">{{ $status ?? '' }}</div>

    <script>
      const btnSave = document.getElementById("save");
      const form = document.getElementById("formproduct");
  
      btnSave.onclick = function () {
          form.submit();
      }
      document.addEventListener("DOMContentLoaded", function() {
          if (document.getElementById("status").innerHTML === "duplicate") {
              swal("Duplicate", 'The product with name "' + document.getElementById("product_name").value + '" already exists');
          }
      });
    </script>

@endsection
