@extends('dashboard.master')
@extends('landing.master')
@include('landing.main')

<table class="table align-items-center mb-0">
    <thead>
      <tr>
        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">No</th>
        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">name</th>
        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Order date</th>
        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">total amount</th>
        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">status</th>
        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Action</th>
      </tr>
    </thead>
    <tbody>
      @foreach ($myorder as $idx => $dt)
      <tr>
        <td>
          <div class="d-flex px-2 py-1">
            {{ $idx + 1 . " . " }}
          </div>
        </td>
        <td>
         {{ $dt->customer->name }}
        </td>
        <td>
         {{ $dt->order_date }}
        </td>
        <td>
         ${{ $dt->total_amount }}
        </td>
        <td>
          @if ($dt->status === 'paid')
            <span style="color: rgb(85, 227, 85); font-weight: bold;">{{ $dt->status }}</span>
          @else
            <span style="color: red; font-weight: bold;">{{ $dt->status }}</span>
          @endif
        </td>

        <td class="align-middle text-center text-sm">
          @if ($dt->status === 'paid')
          <a href="{{ route('checkout.index', $dt->id) }}"><span class="badge badge-sm bg-gradient-info">Detail</span></a>
          @else
            <a href="{{ route('checkout.index', $dt->id) }}"><span class="badge badge-sm bg-gradient-success">Pay</span></a>
            <form action="{{ route('yourorder.delete', $dt->id) }}" method="POST" style="display:inline;">
                @csrf
                @method('DELETE')
                <button type="submit" class="badge badge-sm bg-gradient-danger" onclick="return confirm('Are you sure you want to Cancel this order?')">Cancel</button>
            </form>
          @endif
        </td>
      </tr>
      @endforeach
    </tbody>
  </table>