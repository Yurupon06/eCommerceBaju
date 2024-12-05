@extends('dashboard.master')
@section('title', 'discount')
@section('nav')
    @include('dashboard.nav')
@endsection
@section('page', 'discount')
@section('main')
    @include('dashboard.main')

    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="card mb-4">
                    <div class="card-header pb-0">
                        <h6>Edit discount</h6>
                    </div>
                    <div class="card-body px-0 pt-0 pb-2">
                        <div class="table-responsive p-0">
                            <div class="card border-1 m-3 pt-3">
                                <form action="{{ route('discount.update', $discount->id) }}" id="formdiscount" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')
                                    <div class="mb-3">
                                        <label for="category_discount_id" class="form-label">Category</label>
                                        <select id="category_discount_id" name="category_discount_id" class="ps-2 form-select" aria-label="Default select example">
                                            @foreach ($discountcat as $category)
                                                <option value="{{ $category->id }}" {{ $category->id == $discount->category_discount_id ? 'selected' : '' }}>{{ $category->category_name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label for="product_id" class="form-label">Product</label>
                                        <select id="product_id" name="product_id" class="ps-2 form-select" aria-label="Default select example">
                                            @foreach ($products as $product)
                                                <option value="{{ $product->id }}" {{ $product->id == $discount->product_id ? 'selected' : '' }}>{{ $product->product_name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label for="start_date" class="form-label">Start Date</label>
                                        <input type="date" class="ps-2 form-control border border-secondary-subtle" id="start_date" name="start_date" value="{{ $discount->start_date }}">
                                    </div>
                                    <div class="mb-3">
                                        <label for="end_date" class="form-label">End Date</label>
                                        <input type="date" class="ps-2 form-control border border-secondary-subtle" id="end_date" name="end_date" value="{{ $discount->end_date }}">
                                    </div>
                                    <div class="mb-3">
                                        <label for="percentage" class="form-label">Percentage</label>
                                        <input type="number" class="ps-2 form-control border border-secondary-subtle" id="percentage" name="percentage" min="0" max="100" value="{{ $discount->percentage }}">
                                    </div>
                                    
                                    <div class="ms-3 me-3 text-end">
                                        <a href="{{ route('customer.index') }}" type="button" class="btn bg-gradient-primary ws-15 my-4 mb-2">Cancel</a>
                                        <button type="submit" class="btn bg-gradient-success ws-15 my-4 mb-2" id="update">Update</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    </div>

    <script>
        const btnUpdate = document.getElementById("update");
        const formDiscount = document.getElementById("formdiscount");
        const cat = document.getElementById("category_discount_id");
        const product = document.getElementById("product_id");
        const start = document.getElementById("start_date");
        const end = document.getElementById("end_date");
        const persen = document.getElementById("percentage");

        function update() {
          let emptyFields = [];
  
          if (cat.value === "") {
              emptyFields.push("Name");
          }
          if (product.value === "") {
              emptyFields.push("Email");
          }
          if (start.value === "") {
              emptyFields.push("Password");
          }
          if (end.value === "") {
              emptyFields.push("Telephone");
          }
          if (persen.value === "") {
              emptyFields.push("Alamat");
          }
  
          if (emptyFields.length > 0) {
              const errorMessage = "Incomplete Data. Please fill in the following fields: " + emptyFields.join(", ");
              swal("Error", errorMessage, "error");
          } else {
              formEdit.submit();
          }
      }

        btnUpdate.onclick = function () {
            update();
        };

    </script>

@endsection