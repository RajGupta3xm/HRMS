@extends('header')

@section('title', 'Invoices')

@section('content')

    <div class="layout-px-spacing">

        <div class="middle-content container-xxl p-0">

            <div class="row layout-top-spacing">

                <div class="row">

                    <div class="col">

                        <div class="widget-heading mb-3">

                            <h5 class="">Manage Project Invoices</h5>

                        </div>

                    </div>

                </div>

               

                <div class="row">

                    <div class="widget widget-table-one p-4">

                        <div class="row d-flex text-end">

                            <div class="col-sm-12 text-end container">

                                @if (isset($modules[1]['project.invoice.create']) && $modules[1]['project.invoice.create'] == 1)

                                    <a href="{{ route('addinvoices.id', ['id' => $projectData['id']]) }}">

                                        <button type="submit"

                                            class="btn btn-sm btn-success _effect--ripple waves-effect waves-light common_btn2">

                                            <i class="fa fa-plus p-1"></i>Mannage Invoice

                                        </button>

                                    </a>

                                @endif



                                @if (isset($modules[1]['project.milestone.create']) && $modules[1]['project.milestone.create'] == 1)

                                    <a href="{{ route('addmilestone.id', ['id' => $projectData['id']]) }}">

                                        <button type="submit"

                                            class="btn btn-sm btn-primary _effect--ripple waves-effect waves-light common_btn2">

                                            <i class="fa fa-plus p-1"></i>Mannage MileStone

                                        </button>

                                    </a>

                                @endif



                                @if (isset($modules[1]['project.addTeamMember.create']) && $modules[1]['project.addTeamMember.create'] == 1)

                                    <a href="{{ route('addWorksEmployee.id', ['id' => $projectData['id']]) }}">

                                        <button type="submit"

                                            class="btn btn-sm btn-warning _effect--ripple waves-effect waves-light common_btn2">

                                            <i class="fa fa-plus p-1"></i>Mannge Team Member

                                        </button>

                                    </a>

                                @endif

                                <a href="{{ url()->previous() }}"

                                    class="btn btn-sm btn-secondary _effect--ripple waves-effect waves-light common_btn2">Go

                                    Back</a>

                            </div>

                        </div>



                        <div class="widget-content">

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



                            <div class="table-responsive">

                                <table class="table Common_table text-center">

                                    <thead>

                                        <tr>

                                            <th>

                                                <div class="th-content">#</div>

                                            </th>

                                            <th>

                                                <div class="th-content">Date</div>

                                            </th>

                                            <th>

                                                <div class="th-content">Type</div>

                                            </th>

                                            <th>

                                                <div class="th-content th-heading">Payment Method</div>

                                            </th>

                                            <th>

                                                <div class="th-content">Paid Date</div>

                                            </th>

                                            <th>

                                                <div class="th-content">Total Amount</div>

                                            </th>

                                            <th>

                                                <div class="th-content">Status</div>

                                            </th>

                                            <th>

                                                <div class="th-content">Action</div>

                                            </th>

                                        </tr>

                                    </thead>

                                    <tbody>

                                        @php

                                            $count = 1;

                                        @endphp

                                        @foreach ($invoicesData as $invoice)

                                            <tr>

                                                <td><span>{{ $count++ }} </span></td>

                                                <td>

                                                    <div class="td-content ">

                                                        {{ $invoice['Bill_Genrate_Date'] }}

                                                    </div>

                                                </td>

                                                <td>

                                                    <div class="td-content product-brand text-secondary text-center">

                                                        {{ $projectData['projecttype'] }}

                                                    </div>

                                                </td>

                                                <td>

                                                    <div class="td-content text-center"><span

                                                            class="badge badge-primary">{{ $invoice['PaymentOption'] }}</span>

                                                    </div>

                                                </td>

                                                <td>

                                                    <div class="td-content text-center ">{{ $invoice['DueDate'] }}

                                                    </div>

                                                </td>

                                                <td>

                                                    <div class="td-content text-center ">

                                                        {{ $invoice['Total'] }}

                                                    </div>

                                                </td>

                                                <td>

                                                    <div class="td-content text-center">

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

                                                    </div>

                                                </td>

                                                <td>

                                                    <form method="POST"

                                                        action="{{ route('deleteInvoice', ['id' => $invoice->id]) }}"

                                                        class="d-inline">

                                                        @csrf

                                                        @method('DELETE')

                                                        <button type="submit" class="btn btn-link text-danger"

                                                            onclick="confirmDelete()">

                                                            <i class="fa fa-trash"></i>

                                                        </button>

                                                    </form>



                                                    <a href="{{ route('invoices.edit', ['id' => $invoice->id]) }}"

                                                        class="text-decoration-none">

                                                        <i class="fas fa-edit p-1 text-primary"></i>

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

            if (confirm("Are you sure you want to delete this Invoices?")) {

                document.getElementById('deleteForm').submit();

            }

        }

    </script>

@endsection

