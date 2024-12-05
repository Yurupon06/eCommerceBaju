@extends('dashboard.master')
@extends('landing.master')
@include('landing.main')

<div class="card-body px-0 pt-0 pb-2">
    <div class="table-responsive p-0">
        <table class="table align-items-center mb-0">
            <thead>
                <tr>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">No</th>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Shipping Date</th>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Tracking Code</th>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Status</th>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Product Photo</th>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2"></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($deliveries as $idx => $delivery)
                <tr>
                    <td>
                        <div class="d-flex px-2 py-1">
                            {{ $idx + 1 }}.
                        </div>
                    </td>
                    <td>{{ $delivery->shipping_date }}</td>
                    <td>{{ $delivery->tracking_code }}</td>
                    <td>{{ $delivery->status }}</td>
                    <td>
                        @foreach ($delivery->order->orderDetails as $orderDetail)
                            @if ($orderDetail->product && $orderDetail->product->image1_url)
                                <img src="{{ asset('storage/' . $orderDetail->product->image1_url) }}" alt="Product Photo" width="50">
                            @else
                                No Photo
                            @endif
                        @endforeach
                    </td>
                    <td class="align-middle text-center text-sm">
                        @if ($delivery->status === 'being processed')
                        <a href="{{ route('checkout.index', $delivery->order->id) }}">
                            <span class="badge badge-sm bg-gradient-success">Detail</span>
                        </a>
                        @else
                        <a href="{{ route('checkout.index', $delivery->order->id) }}">
                            <span class="badge badge-sm bg-gradient-info">Detail</span>
                        </a>
                        <form action="{{ route('deliveries.markAsDone', $delivery->id) }}" method="POST" style="display:inline;">
                          @csrf
                          @method('PATCH')
                          <button type="submit" class="badge badge-sm bg-gradient-success">Done</button>
                      </form>
                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
