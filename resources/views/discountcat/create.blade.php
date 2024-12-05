@extends('dashboard.master')
@section('title', 'Discount Categorie')
@section('nav')
    @include('dashboard.nav')
@endsection
@section('page', 'Discount Categorie')
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
                  <form action="{{ route('discountcat.store')}}" id="formdiscountcat" method="POST" enctype="multipart/form-data">
                      @csrf
                      <div class="mb-3 ms-3 me-3">
                        <label for="category_name" class="form-label">Category Name</label>
                        <input type="text" class="ps-2 form-control border border-secondary-subtle" placeholder="Discount Categories" aria-label="Name" id="category_name" name="category_name">
                      </div>
                      <div class="ms-3 me-3 text-end">
                          <a href="{{ route('discountcat.index') }}" type="button" class="btn bg-gradient-primary ws-15 my-4 mb-2">Cancel</a>
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

    <script>
      const btnSimpan = document.getElementById("save");
      const form = document.getElementById("formdiscountcat");
      const cat_name = document.getElementById("category_name");
      let pesan = ""
      function simpan(){
        if(cat_name.value === ""){
          cat_name.focus()
          swal("Error!","Category Name is required","error")
        }else{
          form.submit()
        }
      }
      btnSimpan.onclick = function(){
        simpan();
      }
    </script>


@endsection