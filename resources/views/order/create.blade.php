@extends('dashboard.master')
@section('title', 'order')
@section('nav')
    @include('dashboard.nav')
@endsection
@section('page', 'order')
@section('main')
    @include('dashboard.main')

<!-- Tables -->
    <div class="container-fluid py-4">
      <div class="row">
        <div class="col-12">
          <div class="card mb-4">
            <div class="card-header pb-0">
              <h6>New order</h6>
            </div>
            <div class="card-body px-0 pt-0 pb-2">
              <div class="table-responsive p-0">
                <div class="card border-1 m-3 pt-3">
                  <form action="{{ route('order.store')}}" id="formorder" method="POST" enctype="multipart/form-data">
                      @csrf
                      <div class="mb-2 ms-3 me-3">
                        <label for="customer_id" class="form-label">customer name</label>
                        <select id="customer_id" name="customer_id" class="ps-2 form-select" aria-label="Default select example">
                            <option selected disabled>Select Category</option>
                            @foreach ($customername as $customer)
                                <option value="{{ $customer->id }}">{{ $customer->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-2 ms-3 me-3">
                        <label for="order_date" class="form-label">order date</label>
                        <input type="date" class="ps-2 form-control border border-secondary-subtle" id="order_date" name="order_date">
                    </div>
                    <div class="mb-2 ms-3 me-3">
                        <label for="total_amount" class="form-label">total amount</label>
                        <input type="text" class="ps-2 form-control border border-secondary-subtle" id="total_amount" name="total_amount">
                    </div>
                    <div class="mb-2 ms-3 me-3">
                        <label for="status" class="form-label">status</label>
                        <input type="text" class="ps-2 form-control border border-secondary-subtle" id="status" name="status">
                    </div>
                    <div class="ms-3 me-3 text-end">
                          <a href="{{ route('order.index') }}" type="button" class="btn bg-gradient-primary ws-15 my-4 mb-2">Cancel</a>
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
      const pci = document.getElementById("product_category_id");
      const mn = document.getElementById("product_name");
      const desk = document.getElementById("description");
      const hrg = document.getElementById("price");
      const stk = document.getElementById("stok_quantity");
      const ft1 = document.getElementById("image1_url");
      const ft2 = document.getElementById("image2_url");
      const ft3 = document.getElementById("image3_url");
      const sts = document.getElementById("status");
  
      function simpan() {
          let emptyFields = [];
  
          if (mn.value === "") {
              emptyFields.push("Menu");
          }
          if (hrg.value === "") {
              emptyFields.push("Price");
          }
          if (stk.value === "") {
              emptyFields.push("Stock");
          }
          if (ft1.value === "") {
              emptyFields.push("Photo 1");
          }
          if (desk.value === "") {
              emptyFields.push("Description");
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