@extends('dashboard.master')
@section('title', 'Discount Categorie')
@section('nav')
    @include('dashboard.nav')
@endsection
@section('page', 'Discount Categorie')
@section('main')
    @include('dashboard.main')

    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="card mb-4">
                    <div class="card-header pb-0">
                        <h6>Edit discount-Category</h6>
                    </div>
                    <div class="card-body px-0 pt-0 pb-2">
                        <div class="table-responsive p-0">
                            <div class="card border-1 m-3 pt-3">
                                <form action="{{ route('discountcat.update', $discountcat->id) }}" id="formdiscountcat" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')
                                    <div class="mb-3 ms-3 me-3">
                                        <label for="category_name">Category Name</label>
                                        <input type="text" name="category_name" id="category_name" class="ps-2 form-control border border-secondary-subtle @error('category_name') is-invalid @enderror" value="{{ old('category_name', $discountcat->category_name) }}" placeholder="Category Name">
                                    </div>
                                    <div class="ms-3 me-3 text-end">
                                        <a href="{{ route('discountcat.index') }}" type="button" class="btn bg-gradient-primary ws-15 my-4 mb-2">Cancel</a>
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
        const formEdit = document.getElementById("formdiscountcat");

        function update() {
            let category_name = document.getElementById("category_name").value;

            if (category_name.trim() === "") {
                Swal.fire({
                    icon: 'error',
                    title: 'Error!',
                    text: 'Product category name is still empty',
                });
                document.getElementById("category_name").focus();
            } else {
                formEdit.submit();
            }
        }

        btnUpdate.onclick = function () {
            update();
        };

    </script>

@endsection