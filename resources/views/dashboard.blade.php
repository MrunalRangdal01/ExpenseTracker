@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">

            <!-- Separate Section for Pie Chart -->
            <div class="text-center mb-4">
                <div class="chart-container" style="position: relative; height: 400px; width: 80%; margin: 20px auto;">
                    <canvas id="myPieChart"></canvas>
                </div>
            </div>

            <div class="card">
                <div class="card-header">{{ __('My Expenses > Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                    @endif

                    <div class="right_col" role="main">
                        <div class="">

                            <div class="clearfix"></div>
                            <div id="flashMessage" class="alert" role="alert" style="display: none;"></div>

                            <!-- Filter Form -->
                            <form method="GET" action="{{route('home')}}" class="form-inline mb-3">
                                <div class="form-group mx-sm-4 mb-3">
                                    <label for="category" class="sr-only">Category</label>
                                    <select name="category_id" id="category" class="form-control">
                                        <option value="" disabled selected>Select Category</option>
                                        @foreach($categories as $cat)
                                        <option value="{{ $cat->id }}" {{ request('category_id') == $cat->id ? 'selected' : '' }}>{{ $cat->category_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group mx-sm-4 mb-3">
                                    <label for="from_date" class="sr-only">From Date</label>
                                    <input type="date" name="from_date" id="from_date" class="form-control" value="{{ request('from_date') }}">
                                </div>
                                <div class="form-group mx-sm-4 mb-3">
                                    <label for="to_date" class="sr-only">To Date</label>
                                    <input type="date" name="to_date" id="to_date" class="form-control" value="{{ request('to_date') }}">
                                </div>
                                <button type="submit" class="btn btn-primary mx-sm-5 mb-3 mt">Filter</button>
                                <button type="button" id="clearFilter" class="close" style="margin-bottom:15px" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </form>
                            <!-- filter ends  -->

                            <!-- Table -->
                            <div class="row">
                                <div class="col-md-12 col-sm-12">
                                    <div class="x_panel">
                                        <div class="x_content">
                                            <div class="table-responsive">
                                                <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap" style="width: 100%;">
                                                    <thead class="thead-style">
                                                        <tr>
                                                            <th>Title</th>
                                                            <th>Category</th>
                                                            <th>Amount</th>
                                                            <th>Date</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @if(count($expenses) > 0)
                                                        @foreach($expenses as $key=>$ex)
                                                        <tr>
                                                            <td>{{ $ex->title }}</td>
                                                            <td>{{ $ex->category->category_name }}</td>
                                                            <td>{{ $ex->amount }}</td>
                                                            <td>{{ $ex->date }}</td>
                                                        </tr>
                                                        @endforeach
                                                        @else
                                                        <tr>
                                                            <td colspan="4">No records found</td>
                                                        </tr>
                                                        @endif
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script> <!-- Ensure Chart.js is loaded -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>

<!-- Script for Chart -->
<script>
    $(document).ready(function() {
        $('#clearFilter').click(function() {
            window.location.href = "{{ route('home') }}";
        });
    });

    // Initialize Chart.js and create a pie chart
    var ctx = document.getElementById('myPieChart').getContext('2d');
    var myPieChart = new Chart(ctx, {
        type: 'pie',
        data: {
            labels: [
                @foreach($categories as $cat)
                    '{{ $cat->category_name }}',
                @endforeach
            ],
            datasets: [{
                label: 'Expense Categories',
                data: [
                    @foreach($categories as $cat)
                        {{ $cat->expenses->sum('amount') }},
                    @endforeach
                ],
                backgroundColor: [
                'rgba(255, 99, 132, 0.7)',
                'rgba(54, 162, 235, 0.7)',
                'rgba(255, 206, 86, 0.7)',
                'rgba(75, 192, 192, 0.7)',
                'rgba(153, 102, 255, 0.7)',
                'rgba(255, 159, 64, 0.7)',
                'rgba(255, 0, 0, 0.7)',
                'rgba(0, 255, 0, 0.7)',
                'rgba(0, 0, 255, 0.7)',
                'rgba(255, 255, 0, 0.7)',
                'rgba(255, 0, 255, 0.7)',
                'rgba(0, 255, 255, 0.7)',
                'rgba(128, 0, 128, 0.7)',
                'rgba(0, 128, 128, 0.7)',
                'rgba(128, 128, 0, 0.7)',
                'rgba(128, 128, 128, 0.7)'
                // Add more unique colors as needed
            ],
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false
        }
    });
</script>

@endsection
