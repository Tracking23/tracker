<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Website Analytics Dashboard</title>

    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Date Range Picker CSS -->
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css">

    <!-- DataTables CSS -->
    <link href="https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap5.min.css" rel="stylesheet">

    <style>
        .card {
            border-radius: 15px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
        }

        .filters-section {
            background-color: #f8f9fa;
            padding: 20px;
            border-radius: 10px;
            margin-bottom: 20px;
        }
    </style>
</head>

<body class="bg-light">
    <div class="container py-5">
        <h2 class="mb-4">Website Analytics</h2>

        <div class="card">
            <div class="card-body">
                <div class="filters-section">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Date Range</label>
                            <input type="text" id="daterange" class="form-control">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label">Website</label>
                            <select class="form-select" id="website-select">
                                <option value="">Select Website</option>
                                @foreach ($websites as $website)
                                <option value="{{ $website['id'] }}">{{ $website['url'] }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <button id="reloadButton" class="btn btn-primary mb-3">Reload Data</button>
                <div class="table-responsive">
                    <table id="visitsTable" class="table table-striped">
                        <thead>
                            <tr>
                                <th>Page URL</th>
                                <th>Unique Visitors</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- Data will be populated here -->
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Required Scripts -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.7/js/dataTables.bootstrap5.min.js"></script>

    <script>
        $(document).ready(function() {
            let table = $('#visitsTable').DataTable({
                pageLength: 10,
                order: [[0, 'desc']]
            });
    
            function fetchData() {
                const dateRange = $('#daterange').val();
                const website = $('#website-select').val();
    
                if (!website) {
                    alert('Please select a website');
                    return;
                }
    
                table.clear().draw();
                $('.card-body').addClass('opacity-50');
    
                const dates = dateRange.split(' - ');
                const startDate = moment(dates[0], 'YYYY-MM-DD').format('YYYY-MM-DD');
                const endDate = moment(dates[1], 'YYYY-MM-DD').format('YYYY-MM-DD');
    
                $.ajax({
                    url: '/api/website-analytics',
                    method: 'GET',
                    data: {
                        start_date: startDate,
                        end_date: endDate,
                        website: website
                    },
                    success: function(response) {
                        table.clear();
                        
                        response.forEach(function(row) {
                            table.row.add([
                                row.page_url,
                                row.unique_visitors
                            ]);
                        });
                        
                        table.draw();
                    },
                    error: function(xhr, status, error) {
                        console.error('Error fetching data:', error);
                        alert('Error loading data. Please try again.');
                    },
                    complete: function() {
                        $('.card-body').removeClass('opacity-50');
                    }
                });
            }
    
            $('#daterange').daterangepicker({
                startDate: moment().subtract(7, 'days'),
                endDate: moment(),
                locale: {
                    format: 'YYYY-MM-DD'
                },
                ranges: {
                    'Today': [moment(), moment()],
                    'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                    'Last 7 Days': [moment().subtract(6, 'days'), moment()],
                    'Last 30 Days': [moment().subtract(29, 'days'), moment()],
                    'This Month': [moment().startOf('month'), moment().endOf('month')],
                    'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
                }
            });
    
            $('#daterange').on('apply.daterangepicker', function(ev, picker) {
                fetchData();
            });
    
            $('#website-select').on('change', function() {
                fetchData();
            });
    
            // Reload Button functionality
            $('#reloadButton').on('click', function() {
                fetchData();
            });
        });
    </script>
    
</body>
</html>