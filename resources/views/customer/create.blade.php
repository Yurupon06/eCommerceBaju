@extends('dashboard.master')
@section('title', 'customer')
@section('nav')
    @include('dashboard.nav')
@endsection
@section('page', 'customer')
@section('main')
    @include('dashboard.main')

<!-- Tables -->
    <div class="container-fluid py-4">
      <div class="row">
        <div class="col-12">
          <div class="card mb-4">
            <div class="card-header pb-0">
              <h6>New customer</h6>
            </div>
            <div class="card-body px-0 pt-0 pb-2">
              <div class="table-responsive p-0">
                <div class="card border-1 m-3 pt-3">
                  <form action="{{ route('customer.store')}}" id="formCustomer" method="POST" enctype="multipart/form-data">
                      @csrf
                      <div class="mb-3 ms-3 me-3">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" class="ps-2 form-control border border-secondary-subtle" placeholder="Name" aria-label="name" id="name" name="name">
                      </div>
                      <div class="mb-3 ms-3 me-3">
                        <label for="email" class="form-label">email</label>
                        <input type="text" class="ps-2 form-control border border-secondary-subtle" placeholder="email" aria-label="email" id="email" name="email">
                      </div>
                      <div class="mb-3 ms-3 me-3">
                        <label for="password" class="form-label">password</label>
                        <input type="password" class="ps-2 form-control border border-secondary-subtle" placeholder="password" aria-label="password" id="password" name="password">
                      </div>
                      <div class="mb-3 ms-3 me-3">
                        <label for="phone" class="form-label">phone</label>
                        <input type="text" class="ps-2 form-control border border-secondary-subtle" placeholder="phone" aria-label="phone" id="phone" name="phone">
                      </div>
                      <div class="mb-3 ms-3 me-3">
                        <label for="alamat1" class="form-label">alamat1</label>
                        <textarea class="ps-2 form-control border border-secondary-subtle" placeholder="alamat1" aria-label="alamat1" id="alamat1" name="alamat1"></textarea>
                      </div>
                      <div class="mb-3 ms-3 me-3">
                        <label for="alamat2" class="form-label">alamat2</label>
                        <textarea class="ps-2 form-control border border-secondary-subtle" placeholder="alamat2" aria-label="alamat2" id="alamat2" name="alamat2"></textarea>
                      </div>
                      <div class="mb-3 ms-3 me-3">
                        <label for="alamat3" class="form-label">alamat3</label>
                        <textarea class="ps-2 form-control border border-secondary-subtle" placeholder="alamat3" aria-label="alamat3" id="alamat3" name="alamat3"></textarea>
                      </div>
                      <div class="ms-3 me-3 text-end">
                          <a href="{{ route('customer.index')}}" type="button" class="btn bg-gradient-primary ws-15 my-4 mb-2">Cancel</a>
                          <button type="button" class="btn bg-gradient-success ws-15 my-4 mb-2" id="save">Save</button>
                      </div>
                  </form>
                </div>
              </div>
          </div>
          </div>
        </div>
      </div>
    </div>

    <script>
        const btnSimpan = document.getElementById("save");
        const form = document.getElementById("formCustomer");
        const name = document.getElementById("name");
        const email = document.getElementById("email");
        const pass = document.getElementById("password");
        const telp = document.getElementById("phone");
        const almt1 = document.getElementById("alamat1");
        const almt2 = document.getElementById("alamat2");
        const almt3 = document.getElementById("alamat3");

        function simpan() {
          let emptyFields = [];
  
          if (name.value === "") {
              emptyFields.push("Name");
          }
          if (email.value === "") {
              emptyFields.push("Email");
          }
          if (pass.value === "") {
              emptyFields.push("Password");
          }
          if (telp.value === "") {
              emptyFields.push("Telephone");
          }
          if (almt1.value === "") {
              emptyFields.push("Alamat");
          }
  
          if (emptyFields.length > 0) {
              const errorMessage = "Incomplete Data. Please fill in the following fields: " + emptyFields.join(", ");
              swal("Error", errorMessage, "error");
          } else {
              form.submit();
          }
      }
        btnSimpan.onclick = function(){
          simpan();
        }
      </script>
  


@endsection