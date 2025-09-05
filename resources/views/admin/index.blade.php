<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Ecommerce Admin Panel</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.datatables.net/2.3.2/css/dataTables.dataTables.css" />
    <style>
        html,
        body {
            height: 100%;
            margin: 0;
        }

        body {
            font-family: Arial, sans-serif;
        }

        .layout-wrapper {
            display: flex;
            min-height: 100vh;
            flex-direction: column;
        }

        .content-wrapper {
            display: flex;
            flex: 1;
        }

        .sidebar {
            width: 200px;
            background-color: #000;
            color: white;
            padding-top: 20px;
        }

        .sidebar a {
            padding: 10px 15px;
            display: block;
            color: white;
            text-decoration: none;
        }

        .sidebar a:hover {
            background-color: #495057;
        }

        .sidebar a i {
            margin-right: 10px;
        }

        .sidebar a.active {
            background-color: #0d6efd;
            /* Bootstrap's primary blue */
            color: white;
        }

        .sidebar a.active i {
            color: white;
        }

        .main {
            flex: 1;
            padding: 20px;
            background-color: #f8f9fa;
        }

        .footer {
            background-color: #000;
            color: #fff;
            text-align: center;
            padding: 10px;
            font-size: 14px;
        }

        .dashboard-boxes .card {
            min-width: 200px;
            color: white;
            text-align: center;
        }

        .dashboard-boxes .card i {
            font-size: 2.5rem;
            margin-bottom: 10px;
        }
    </style>
</head>

<body>

    <!-- Navbar -->
    <nav class="navbar navbar-dark bg-dark">
        <div class="container-fluid">
            <span class="navbar-brand mb-0 h1">Ecommerce Admin Panel</span>
            <div class="dropdown">
                <button class="btn btn-dark dropdown-toggle" type="button" id="adminDropdown" data-bs-toggle="dropdown"
                    aria-expanded="false">
                    <i class="fas fa-user"></i> admin
                </button>
                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="adminDropdown">
                    <li><a class="dropdown-item" href="#">Profile</a></li>
                    <li><a class="dropdown-item" href="#">Logout</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Page Layout -->
    <div class="layout-wrapper">

        <!-- Sidebar + Content -->
        <div class="content-wrapper">

            <!-- Sidebar -->
            <div class="sidebar">
                <a href="{{ route('admin.dashboard') }}" wire:navigate class="sidebar-link" data-id="dashboard"><i
                        class="fas fa-tachometer-alt"></i>Dashboard</a>
                <a href="{{ route('admin.add-category') }}" wire:navigate class="sidebar-link" data-id="add-category"><i
                        class="fas fa-plus"></i>Add Category</a>
                <a href="{{ route('admin.manage-category') }}" wire:navigate class="sidebar-link"
                    data-id="manage-category"><i class="fas fa-edit"></i>Manage Category</a>
                <a href="{{ route('admin.add-subcategory') }}" wire:navigate
                    class="sidebar-link"data-id="add-subcategory"><i class="fas fa-plus-square"></i>Add SubCategory</a>
                <a href="{{ route('admin.manage-subcategory') }}" wire:navigate class="sidebar-link"
                    data-id="manage-subcategory"><i class="fas fa-tasks"></i>Manage SubCategory</a>
                <a href="#"><i class="fas fa-box-open"></i>Add Product</a>
                <a href="{{ route('admin.manage-product') }}" wire:navigate
                    class="sidebar-link"data-id="manage_product"><i class="fas fa-boxes"></i>Manage Product</a>
                <a href="#"class="sidebar-link" data-id="manage_user"><i class="fas fa-users-cog"></i>Manage
                    User</a>
                <a href="#"><i class="fas fa-star"></i>Manage Reviews</a>
                <a href="#"><i class="fas fa-envelope"></i>Manage Messages</a>
                <a href="#"><i class="fas fa-cogs"></i>Add Features</a>
                <a href="#"class="sidebar-link" data-id="about"><i class="fas fa-info-circle"></i>About</a>
            </div>

            <!-- Main Content -->
            <div class="main">
                {{ $slot }}
            </div>

        </div>

        <!-- Footer -->
        <div class="footer">
            &copy; 2025 Ecommerce Admin Panel. All rights reserved.
        </div>

    </div>
    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.ckeditor.com/4.16.2/standard/ckeditor.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
    <script src="https://cdn.datatables.net/2.3.2/js/dataTables.js"></script>

    <script>
        $(document).ready(function() {
            $('#myTable').DataTable({
                pageLength: 5, // Show only 5 rows by default
                lengthMenu: [5, 10, 25, 50, 100], // Dropdown options
            });
        });
    </script>

    {{-- <script>
        CKEDITOR.replace('editor');
    </script> --}}

    {{-- <script>
        const sidebarLinks = document.querySelectorAll('.sidebar-link');

        // 1. Remove any default active class
        sidebarLinks.forEach(link => link.classList.remove('active'));

        // 2. Check localStorage for active link ID
        const activeId = localStorage.getItem('activeSidebarLink');
        if (activeId) {
            const activeLink = document.querySelector(`.sidebar-link[data-id="${activeId}"]`);
            if (activeLink) activeLink.classList.add('active');
        }

        // 3. On click, update active class and localStorage
        sidebarLinks.forEach(link => {
            link.addEventListener('click', function() {
                // Remove active from all
                sidebarLinks.forEach(l => l.classList.remove('active'));
                // Add active to clicked
                this.classList.add('active');
                // Save to localStorage
                localStorage.setItem('activeSidebarLink', this.dataset.id);
            });
        });
    </script> --}}

    {{-- <script>
        $('.status-dropdown').change(function() {
            let productId = $(this).data('id');
            let status = $(this).val();

            $.ajax({
                url: '{{ route('update_status') }}',
                type: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                    id: productId,
                    status: status
                },
                success: function(response) {
                    alert('Status updated successfully');
                },
                error: function(xhr) {
                    alert('Error updating status');
                }
            });
        });
    </script> --}}

</body>

</html>
