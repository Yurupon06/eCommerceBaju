@extends('dashboard.master')
@section('title', 'customer')
@section('nav')
    @include('dashboard.nav')
@endsection
@section('page', 'customer')
@section('main')
    @include('dashboard.main')

    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="card mb-4">
                    <div class="card-header pb-0">
                        <h6>Edit Product-Category</h6>
                    </div>
                    <div class="card-body px-0 pt-0 pb-2">
                        <div class="table-responsive p-0">
                            <div class="card border-1 m-3 pt-3">
                                <form action="{{ route('customer.update', $customer->id) }}" id="formCustomer" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')
                                    <div class="mb-3 ms-3 me-3">
                                        <label for="name">Name</label>
                                        <input type="text" name="name" id="name" class="ps-2 form-control border border-secondary-subtle @error('name') is-invalid @enderror" value="{{ old('name', $customer->name) }}" placeholder="Category Name">
                                    </div>
                                    <div class="mb-3 ms-3 me-3">
                                        <label for="email">email</label>
                                        <input type="text" name="email" id="email" class="ps-2 form-control border border-secondary-subtle @error('email') is-invalid @enderror" value="{{ old('email', $customer->email) }}" placeholder="Category Name">
                                    </div>
                                    <div class="mb-3 ms-3 me-3">
                                        <label for="password">Password</label>
                                        <input type="password" name="password" id="password" class="ps-2 form-control border border-secondary-subtle @error('password') is-invalid @enderror" value="{{ old('password', $customer->password) }}" placeholder="Category Name">
                                    </div>
                                    <div class="mb-3 ms-3 me-3">
                                        <label for="phone">Phone</label>
                                        <input type="text" name="phone" id="phone" class="ps-2 form-control border border-secondary-subtle @error('phone') is-invalid @enderror" value="{{ old('phone', $customer->phone) }}" placeholder="Category Name">
                                    </div>
                                    <div class="mb-3 ms-3 me-3">
                                        <label for="alamat1">Category Name</label>
                                        <textarea type="text" name="alamat1" id="alamat1" class="ps-2 form-control border border-secondary-subtle @error('alamat1') is-invalid @enderror" value="{{ old('alamat1', $customer->alamat1) }}" placeholder="Category Name"></textarea>
                                    </div>
                                    <div class="mb-3 ms-3 me-3">
                                        <label for="alamat2">Category Name</label>
                                        <textarea type="text" name="alamat2" id="alamat2" class="ps-2 form-control border border-secondary-subtle @error('alamat2') is-invalid @enderror" value="{{ old('alamat2', $customer->alamat2) }}" placeholder="Category Name"></textarea>
                                    </div>
                                    <div class="mb-3 ms-3 me-3">
                                        <label for="alamat3">Category Name</label>
                                        <textarea type="text" name="alamat3" id="alamat3" class="ps-2 form-control border border-secondary-subtle @error('alamat3') is-invalid @enderror" value="{{ old('alamat3', $customer->alamat3) }}" placeholder="Category Name"></textarea>
                                    </div>
                                    <div class="ms-3 me-3 text-end">
                                        <a href="{{ route('customer.index') }}" type="button" class="btn bg-gradient-primary ws-15 my-4 mb-2">Cancel</a>
                                        <button type="button" class="btn bg-gradient-success ws-15 my-4 mb-2" id="update">Update</button>
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
        const formEdit = document.getElementById("formCustomer");
        const name = document.getElementById("name");
        const email = document.getElementById("email");
        const pass = document.getElementById("password");
        const telp = document.getElementById("phone");
        const almt1 = document.getElementById("alamat1");
        const almt2 = document.getElementById("alamat2");
        const almt3 = document.getElementById("alamat3");

        function update() {
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
              formEdit.submit();
          }
      }

        btnUpdate.onclick = function () {
            update();
        };

    </script>

@endsection