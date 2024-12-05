@extends('dashboard.master')
@section('title', 'deliverie')
@section('nav')
    @include('dashboard.nav')
@endsection
@section('page', 'deliverie')
@section('main')
    @include('dashboard.main')

    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-12">
                <div class="card mb-4">
                    <div class="card-header pb-0">
                        <h6>Edit deliverie</h6>
                    </div>
                    <div class="card-body px-0 pt-0 pb-2">
                        <div class="table-responsive p-0">
                            <div class="card border-1 m-3 pt-3">
                                <form action="{{ route('deliverie.update', $deliverie->id) }}" id="formdiscount" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')
                                    <div class="mb-3">
                                        <label for="status" class="form-label">Status</label>
                                        <select class="ps-2 form-control border border-secondary-subtle" id="status" name="status" {{ $deliverie->status == 'Done' ? 'disabled' : '' }}>
                                            <option value="being processed" {{ $deliverie->status == 'being processed' ? 'selected' : '' }}>Being Processed</option>
                                            <option value="Delivered" {{ $deliverie->status == 'Delivered' ? 'selected' : '' }}>Delivered</option>
                                            <option disabled value="Delivered" {{ $deliverie->status == 'Done' ? 'selected' : '' }}>Done</option>
                                        </select>
                                    </div>

                                    <div class="mb-3">
                                        <label for="foto_kurir" class="form-label">Foto Kurir</label>
                                        <input type="file" class="form-control border border-secondary-subtle" id="foto_kurir" name="foto_kurir">
                                        @if ($deliverie->foto_kurir)
                                            <img src="{{ asset('storage/' . $deliverie->foto_kurir) }}" alt="Current Foto Kurir" width="150">
                                        @endif
                                    </div>

                                    <div class="ms-3 me-3 text-end">
                                        <a href="{{ route('deliverie.index') }}" type="button" class="btn bg-gradient-primary ws-15 my-4 mb-2">Cancel</a>
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
