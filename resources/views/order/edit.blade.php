@extends('dashboard.master')
@section('title', 'order')
@section('nav')
    @include('dashboard.nav')
@endsection
@section('page', 'order')
@section('main')
    @include('dashboard.main')

    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="card mb-4">
                    <div class="card-header pb-0">
                        <h6>Edit order</h6>
                    </div>
                    <div class="card-body px-0 pt-0 pb-2">
                        <div class="table-responsive p-0">
                            <div class="card border-1 m-3 pt-3">
                                <form action="{{ route('order.update', $order->id) }}" id="formorder" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')
                                    <div class="mb-3">
                                        <label for="customer_id" class="form-label">customer name</label>
                                        <select id="customer_id" name="customer_id" class="ps-2 form-select" aria-label="Default select example">
                                            @foreach ($customername as $customer)
                                                <option value="{{ $customer->id }}" {{ $customer->id == $order->customer_id ? 'selected' : '' }}>{{ $customer->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label for="order_date" class="form-label">order date</label>
                                        <input type="date" class="ps-2 form-control border border-secondary-subtle" id="order_date" name="order_date" value="{{ $order->order_date }}">
                                    </div>
                                    <div class="mb-3">
                                        <label for="total_amount" class="form-label">total amount</label>
                                        <input type="text" class="ps-2 form-control border border-secondary-subtle" id="total_amount" name="total_amount" value="{{ $order->total_amount }}">
                                    </div>
                                    <div class="mb-3">
                                        <label for="status" class="form-label">status</label>
                                        <input type="text" class="ps-2 form-control border border-secondary-subtle" id="status" name="status" min="0" value="{{ $order->status }}">
                                    </div>
                                    
                                    <div class="ms-3 me-3 text-end">
                                        <a href="{{ route('order.index') }}" type="button" class="btn bg-gradient-primary ws-15 my-4 mb-2">Cancel</a>
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