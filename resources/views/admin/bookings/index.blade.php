@extends('layouts.masterAdmin')
@section('content')

<div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h3 class="mb-0">Booking List</h3>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="card shadow-sm">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Price</th>
                        <th>Booked By</th>
                        <th>Date</th>
                        <th>Status</th>
                        <th class="text-end">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($bookings as $booking)
                        <tr>
                            <td>{{ $booking->id }}</td>
                            <td>{{ $booking->service->name }}</td>
                            <td>{{ number_format($booking->service->price, 2) }}</td>
                            <td>{{ $booking->user->name }}</td>
                            <td>{{ $booking->booking_date }}</td>
                            <td>
                                @if($booking->status === 'pending')
                                    <span class="badge bg-success">Pending</span>
                                @elseif($booking->status === 'approved')
                                    <span class="badge bg-secondary">Approved</span>
                                @else 
                                    <span class="badge bg-info">Rejected</span>
                                @endif
                            </td>
                            <td class="text-end">
                                {{-- Approve Button --}}
                                <form action="{{ route('bookingslist.update', $booking) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('PUT')
                                    <input type="hidden" name="status" value="approved">
                                    <button class="btn btn-sm btn-outline-primary" type="submit">Approve</button>
                                </form>

                                {{-- Reject Button --}}
                                <form action="{{ route('bookingslist.update', $booking) }}" method="POST" class="d-inline ms-1">
                                    @csrf
                                    @method('PUT') 
                                    <input type="hidden" name="status" value="rejected">
                                    <button class="btn btn-sm btn-outline-danger" type="submit">Reject</button>
                                </form>

                                {{-- Delete Button --}}
                                <form action="{{ route('bookingslist.destroy', $booking) }}" method="POST" class="d-inline ms-1"
                                    onsubmit="return confirm('Delete this service?');">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-sm btn-outline-danger" type="submit">Delete</button>
                                </form>
                            </td>


                        </tr>
                    @empty
                        <tr><td colspan="5" class="text-center text-muted py-4">No services found.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
