@extends('layouts.admin')
@section('title', 'Payments')
@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h4 class="fw-bold mb-0">Payment Transactions</h4>
</div>
<div class="card border-0 shadow-sm mb-4">
    <div class="card-body">
        <form method="GET" class="row g-2">
            <div class="col-md-3">
                <input type="text" name="search" class="form-control form-control-sm" placeholder="Transaction ID or order #" value="{{ request('search') }}">
            </div>
            <div class="col-md-2">
                <select name="status" class="form-select form-select-sm">
                    <option value="">All Status</option>
                    <option value="pending" {{ request('status') === 'pending' ? 'selected' : '' }}>Pending</option>
                    <option value="paid" {{ request('status') === 'paid' ? 'selected' : '' }}>Paid</option>
                    <option value="failed" {{ request('status') === 'failed' ? 'selected' : '' }}>Failed</option>
                    <option value="refunded" {{ request('status') === 'refunded' ? 'selected' : '' }}>Refunded</option>
                </select>
            </div>
            <div class="col-md-2">
                <select name="method" class="form-select form-select-sm">
                    <option value="">All Methods</option>
                    <option value="cod" {{ request('method') === 'cod' ? 'selected' : '' }}>COD</option>
                    <option value="bkash" {{ request('method') === 'bkash' ? 'selected' : '' }}>bKash</option>
                    <option value="nagad" {{ request('method') === 'nagad' ? 'selected' : '' }}>Nagad</option>
                    <option value="card" {{ request('method') === 'card' ? 'selected' : '' }}>Card</option>
                </select>
            </div>
            <div class="col-md-3">
                <button type="submit" class="btn btn-primary btn-sm">Filter</button>
                <a href="{{ route('admin.payments.index') }}" class="btn btn-outline-secondary btn-sm">Reset</a>
            </div>
        </form>
    </div>
</div>
<div class="card border-0 shadow-sm">
    <div class="table-responsive">
        <table class="table table-hover mb-0">
            <thead class="table-light"><tr><th>Transaction ID</th><th>Order #</th><th>Method</th><th>Amount</th><th>Status</th><th>Date</th></tr></thead>
            <tbody>
                @forelse($payments as $payment)
                <tr>
                    <td class="small font-monospace">{{ $payment->transaction_id ?? '-' }}</td>
                    <td class="small fw-semibold">{{ $payment->order->order_number ?? '-' }}</td>
                    <td class="small">{{ strtoupper($payment->method) }}</td>
                    <td class="small">৳{{ number_format($payment->amount, 0) }}</td>
                    <td><span class="badge bg-{{ $payment->status === 'paid' ? 'success' : ($payment->status === 'failed' ? 'danger' : 'secondary') }}">{{ ucfirst($payment->status) }}</span></td>
                    <td class="text-muted small">{{ $payment->created_at->format('d M Y H:i') }}</td>
                </tr>
                @empty
                <tr><td colspan="6" class="text-center py-4 text-muted">No payment records found.</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="card-footer bg-white">{{ $payments->links() }}</div>
</div>
@endsection
