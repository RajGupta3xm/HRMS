@extends('users.header')

@section('title', 'Invoices')

@section('content')

    <div class="layout-px-spacing">

        <div class="middle-content container-xxl p-0">

            <div class="row layout-top-spacing">

                <div class="col-12">

                    <div class="widget-heading mb-3">

                        <h5 class="">Manage Project Invoices</h5>

                    </div>

                </div>

                <div class="col-12">

                    <div class="widget widget-table-one p-4">

                        <div class="row d-flex justify-content-end mb-3">
                            <div class="col-sm-12 text-end">
                                <a href="{{ route('addinvoices.id', ['id' => $projectData['id']]) }}"
                                    class="btn btn-sm btn-success _effect--ripple waves-effect waves-light">
                                    <i class="fa fa-plus"></i> Manage Invoice
                                </a>
                                <a href="{{ route('addmilestone.id', ['id' => $projectData['id']]) }}"
                                    class="btn btn-sm btn-primary _effect--ripple waves-effect waves-light">
                                    <i class="fa fa-plus"></i> Manage Milestone
                                </a>
                                <a href="{{ route('addWorksEmployee.id', ['id' => $projectData['id']]) }}"
                                    class="btn btn-sm btn-warning _effect--ripple waves-effect waves-light">
                                    <i class="fa fa-plus"></i> Manage Team Member
                                </a>
                                <a href="{{ url()->previous() }}"
                                    class="btn btn-sm btn-secondary _effect--ripple waves-effect waves-light">Go Back</a>
                            </div>
                        </div>

                        @if (Session::has('success'))
                            <div class="alert alert-success">
                                {{ Session::get('success') }}
                            </div>
                        @endif

                        @if (Session::has('error'))
                            <div class="alert alert-danger">
                                {{ Session::get('error') }}
                            </div>
                        @endif

                        <div class="widget-content">
                            <div class="table-responsive">
                                <table class="table table-striped Common_table text-center">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Date</th>
                                            <th>Type</th>
                                            <th>Payment Method</th>
                                            <th>Paid Date</th>
                                            <th>Total Amount</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            $count = 1;
                                        @endphp
                                        @foreach ($invoicesData as $invoice)
                                            <tr>
                                                <td>{{ $count++ }}</td>
                                                <td>{{ $invoice['Bill_Genrate_Date'] }}</td>
                                                <td>{{ $projectData['projecttype'] }}</td>
                                                <td><span class="badge badge-primary">{{ $invoice['PaymentOption'] }}</span></td>
                                                <td>{{ $invoice['DueDate'] }}</td>
                                                <td>{{ $invoice['Total'] }}</td>
                                                <td>
                                                    <form method="POST"
                                                        action="{{ route('update_status', ['invoice' => $invoice->id]) }}">
                                                        @csrf
                                                        @method('PUT')
                                                        <button id="status-toggle"
                                                            class="btn btn-sm btn-{{ $invoice->status ? 'success' : 'danger' }}"
                                                            type="submit" name="status"
                                                            value="{{ $invoice->status ? 0 : 1 }}"
                                                            {{ $invoice->status == 1 ? 'disabled' : '' }}>
                                                            {{ $invoice->status ? 'Paid' : 'Unpaid' }}
                                                        </button>
                                                    </form>
                                                </td>
                                                <td>
                                                    <form method="POST"
                                                        action="{{ route('deleteInvoice', ['id' => $invoice->id]) }}"
                                                        class="d-inline">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-link text-danger"
                                                            onclick="return confirm('Are you sure you want to delete this Invoice?');">
                                                            <i class="fa fa-trash"></i>
                                                        </button>
                                                    </form>
                                                    <a href="{{ route('invoices.edit', ['id' => $invoice->id]) }}"
                                                        class="text-decoration-none">
                                                        <i class="fas fa-edit text-primary"></i>
                                                    </a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>

                            {!! $invoicesData->withQueryString()->links('pagination::bootstrap-5') !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function confirmDelete() {
            return confirm("Are you sure you want to delete this Invoice?");
        }
    </script>

@endsection
