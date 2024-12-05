@extends('dashboard.master')
@section('title', 'wishlist')
@section('nav')
    @include('dashboard.nav')
@endsection
@section('page', 'wishlist')
@section('main')
    @include('dashboard.main')

<!-- Tables -->
    <div class="container-fluid py-4">
      <div class="row">
        <div class="col-12">
          <div class="card mb-4">
            <div class="card-header pb-0">
              <h6>New wishlist</h6>
            </div>
            <div class="card-body px-0 pt-0 pb-2">
              <div class="table-responsive p-0">
                <div class="card border-1 m-3 pt-3">
                  <form action="{{ route('wishlist.store')}}" id="formwishlist" method="POST" enctype="multipart/form-data">
                      @csrf
                      <div class="mb-2 ms-3 me-3">
                        <label for="customer_id" class="form-label">customer</label>
                        <select id="customer_id" name="customer_id" class="ps-2 form-select" aria-label="Default select example">
                            <option selected disabled>Select Category</option>
                            @foreach ($customers as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-2 ms-3 me-3">
                        <label for="product_id" class="form-label">Product</label>
                        <select id="product_id" name="product_id" class="ps-2 form-select" aria-label="Default select example">
                            <option selected disabled>Select Product</option>
                            @foreach ($products as $product)
                                <option value="{{ $product->id }}">{{ $product->product_name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="ms-3 me-3 text-end">
                          <a href="{{ route('discount.index') }}" type="button" class="btn bg-gradient-primary ws-15 my-4 mb-2">Cancel</a>
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
      const body = document.getElementById("master");
      const form = document.getElementById("formproduct");
      const pci = document.getElementById("customer_id");
      const mn = document.getElementById("product_name");
      const sts = document.getElementById("status");
  
      function simpan() {
          let emptyFields = [];
  
          if (mn.value === "") {
              emptyFields.push("Menu");
          }
  
          if (emptyFields.length > 0) {
              const errorMessage = "Incomplete Data. Please fill in the following fields: " + emptyFields.join(", ");
              swal("Error", errorMessage, "error");
          } else {
              form.submit();
          }
      }
      function cekMenu(){
        if(sts.innerHTML === "duplicate"){
          mn.focus()
          swal("Duplicate", 'The menu with name "' + mn.value + '" already exists')
        }
      }
  
      btnSave.onclick = function () {
          simpan();
      }
    //   hrg.onkeypress = function (){
    //     angka(event)
    //   };
      body.onload = function () {
        cekMenu()
      }

@endsection