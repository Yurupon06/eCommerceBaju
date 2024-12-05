@extends('landing.master')
@include('landing.main')

<style>
    /* Style for the container */
.container {
    max-width: 800px;
    margin: 0 auto;
    padding: 20px;
}

/* Navigation links styling */
.navigation-links {
    display: flex;
    justify-content: space-between;
    margin-bottom: 20px;
}

.navigation-links a {
    text-decoration: none;
    color: #007BFF;
    font-weight: bold;
}

.navigation-links a:hover {
    text-decoration: underline;
}

/* Profile section styling */
.profile-section {
    background-color: #f9f9f9;
    padding: 20px;
    border-radius: 10px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}

.profile-section h1 {
    margin-bottom: 20px;
    font-size: 24px;
    color: #333;
}

.profile-field {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 15px;
}

.profile-field span {
    font-size: 18px;
    color: #555;
}

.profile-field a {
    text-decoration: none;
    color: #007BFF;
    font-weight: bold;
    font-size: 16px;
}

.profile-field a:hover {
    text-decoration: underline;
}

</style>
<div class="container">
    <div class="navigation-links">
        <a href="{{ route('landing.index') }}">Back</a>
        <a href="{{ route('yourorder.index') }}">Your Order</a>
        <a href="{{route('yourdeliverie.index')}}">Your Deliveries</a>
    </div>

    <div class="profile-section">
        <h1>Profile</h1>
        <div class="profile-field">
            <span>Name: {{ $customer->name }}</span>
        </div>
        <div class="profile-field">
            <span>Email: {{ $customer->email }}</span>
        </div>
        <div class="profile-field">
            <span>Phone: {{ $customer->phone }}</span>
        </div>
        <div class="profile-field">
            <span>Address: {{ $customer->alamat1 }}</span> 
            <a href="#" data-toggle="modal" data-target="#editAddressModal">Edit</a>
        </div>
        <!-- Add more fields as needed -->
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="editAddressModal" tabindex="-1" role="dialog" aria-labelledby="editAddressModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="editAddressModalLabel">Change Address</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="{{ route('profile.update') }}" method="POST">
          @csrf
          <div class="modal-body">
            <div class="form-group">
              <label for="alamat1" class="col-form-label">Address:</label>
              <input type="text" class="form-control" id="alamat1" name="alamat1" value="{{ Auth::guard('customer')->user()->alamat1 }}" required>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Save changes</button>
          </div>
        </form>
      </div>
    </div>
  </div>