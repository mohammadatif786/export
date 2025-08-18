<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>User Table</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- DataTables CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap5.min.css" />
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.4.2/css/buttons.bootstrap5.min.css" />
</head>

<body class="p-4">

    <div class="container">
        <h2 class="mb-3">Users List</h2>
        <div class="mb-3">
            <button id="exportBtnAll" class="btn btn-success">Export All</button>
            <button id="exportBtnPage" class="btn btn-primary">Export Current Page</button>
        </div>


        <!-- Table -->
        <table id="usersTable" class="table table-striped table-bordered">
            <thead class="table-dark">
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Created At</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $index => $user)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->created_at->format('d M Y - h:i A') }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <!-- JS Scripts -->
    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <!-- DataTables + Buttons -->
    <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.7/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.2/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.bootstrap5.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.html5.min.js"></script>

    <script>
        $(document).ready(function() {
            let table = $('#usersTable').DataTable({
                dom: 'Bfrtip',
                buttons: [{
                        extend: 'csv',
                        text: 'Export All',
                        className: 'btn btn-success d-none',
                        title: 'Users_List_All'
                    },
                    {
                        extend: 'csv',
                        text: 'Export Current Page',
                        className: 'btn btn-primary d-none',
                        title: 'Users_List_Page',
                        exportOptions: {
                            modifier: {
                                page: 'current' // ✅ sirf current page ka data export hoga
                            }
                        }
                    }
                ]
            });

            // Custom buttons
            $('#exportBtnAll').on('click', function() {
                table.button(0).trigger(); // Export All
            });

            $('#exportBtnPage').on('click', function() {
                table.button(1).trigger(); // Export Current Page
            });
        });
    </script>

</body>

</html>
