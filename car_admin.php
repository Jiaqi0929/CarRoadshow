<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Admin Panel - Lexus Roadshow</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body {
            font-family: 'Inter', sans-serif;
        }

        .card {
            background: white;
            border-radius: 10px;
            box-shadow: 0 4px 15px rgba(138, 138, 138, 0.1);
            padding: 25px;
            margin-bottom: 25px;
        }

        .search-filter-container {
            display: flex;
            flex-wrap: wrap;
            gap: 15px;
            align-items: center;
            margin-bottom: 20px;
            justify-content: flex-start;
            overflow-x: auto;
            min-width: 0;
            width: 100%;
            box-sizing: border-box;
        }
        
        .search-box {
            display: flex;
            align-items: center;
            background: white;
            border: 1.5px solid #1a2530;
            border-radius: 8px;
            padding: 10px 15px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.155);
            flex: 1;
            min-width: 250px;
        }

        .search-box:hover {
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.255);
            border-color: #000; 
            transition: all 0.3s ease;
        }
        
        .search-box i {
            color: #899091;
            margin-right: 10px;
        }
        
        .search-box input {
            border: none;
            outline: none;
            width: 100%;
            font-size: 16px;
        }
        
        .filter-row {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 15px;
            margin-top: 15px;
            padding-top: 15px;
            border-top: 1px solid #eee;
            min-width: 0;
            justify-items: stretch;
        }
        @media (max-width: 600px) {
            .filter-row {
                grid-template-columns: 1fr;
            }
        }
        
        .filter-group {
            display: flex;
            align-items: center;
            height: 30px;
            gap: 10px;
            justify-content: stretch;
            width: 100%;
        }
        
        .filter-label {
            font-weight: 600;
            color: #2c3e50;
            white-space: nowrap;
        }
        
        select, input {
            padding: 10px 15px;
            border-radius: 6px;
            border: 1px solid #ddd;
            background: white;
            font-size: 14px;
            width: 100%;
            min-width: 0;
            height: 30px;
            cursor: pointer;
        }

        select:hover{
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.255);
            transition: all 0.3s ease;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
            border-radius: 10px;
            border: 1px solid #ddd;
            table-layout: auto;
        }
        
        th {
            background-color: #000000;
            color: white;
            padding: 12px 8px;
            text-align: left;
            cursor: pointer;
            font-weight: 500;
            position: relative;
            overflow: visible;
            white-space: normal;
        }
        
        th:hover {
            background-color: #1a2530;
        }
        
        th i {
            margin-left: 5px;                              
        }
        
        td {
            padding: 12px 8px;
            border-bottom: 1px solid #eee;
            overflow: visible;
            white-space: normal;
            word-wrap: break-word;
    		vertical-align: top;
        }
        
        tr:nth-child(even) {
            background-color: #f9f9f9;
        }
        
        tr:hover {
            background-color: #f1f5f9;
        }
        
        .actions {
            display: flex;
            flex-direction: column;
            gap: 8px;
            justify-content: center;
            align-items: center;
            height: 100%;
            min-height: 80px;
            white-space: nowrap;
        }
        
        .actions .btn {
            width: auto; 
            min-width: 80px; 
            justify-content: center;
            padding: 6px 10px; 
            font-size: 13px; 
        }

        .btn {
            padding: 8px 12px;
            border-radius: 5px;
            border: none;
            cursor: pointer;
            font-size: 14px;
            display: flex;
            align-items: center;
            gap: 5px;
            transition: all 0.2s;
            white-space: nowrap;
        }
        
        .btn-view {
            background-color: #08A1FF;
            color: white;
        }
        
        .btn-view:hover {
            background-color: #0674B8;
        }

        .btn-delete {
            background-color: #dc2626;
            color: white;
        }

        .btn-delete:hover {
            background-color: #b91c1c;
        }

        .btn-refresh {
            background-color: #10b981;
            color: white;
        }
        
        .btn-refresh:hover {
            background-color: #059669;
        }

        .pagination {
            display: flex;
            justify-content: center;
            align-items: center;
            margin-top: 20px;
            gap: 15px;
        }
        
        .pagination button {
            padding: 10px 20px;
            background-color: #000000;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        
        .pagination button:disabled {
            background-color: #95a5a6;
            cursor: not-allowed;
        }
        
        .page-info {
            font-weight: 500;
            color: #2c3e50;
        }
        
        .results-info {
            margin-top: 10px;
            color: #7f8c8d;
            font-size: 14px;
        }
        
        .sort-symbol {
            font-size: 13px;
            margin-left: 4px;
            color: #e0e0e0;
            font-family: inherit;
            vertical-align: middle;
            letter-spacing: -2px;
        }
        .overflow-x-auto {
            overflow-x: auto;
            max-width: 100%;
        }

        .btn-reset {
            background-color: #000000;
            color: white;
            padding: 10px 15px;
            white-space: nowrap;
            display: flex;
            margin-top: 30px;
            margin-bottom: 20px;
        }

        .btn-reset:hover {
            background-color: #7b7b7b;
        }

        .sidebar-closed {
            transform: translateX(-100%);
        }

        .sidebar-open {
            transform: translateX(0);
        }

        .main-content-expanded {
            margin-left: 0 !important;
        }

        .transition-all {
            transition: all 0.3s ease;
        }

        /* Image Modal Styles */
        .image-modal {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.9);
            display: flex;
            justify-content: center;
            align-items: center;
            z-index: 1000;
        }

        .image-modal-content {
            position: relative;
            max-width: 90%;
            max-height: 90%;
        }

        .image-modal-content img {
            max-width: 100%;
            max-height: 90vh;
            border-radius: 8px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.5);
        }

        .image-modal-close {
            position: absolute;
            top: -40px;
            right: -40px;
            background: rgba(255, 255, 255, 0.2);
            border: none;
            color: white;
            font-size: 24px;
            width: 40px;
            height: 40px;
            border-radius: 50%;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: background 0.3s;
        }

        .image-modal-close:hover {
            background: rgba(255, 255, 255, 0.3);
        }

        /* Mobile-friendly table styles */
        .mobile-table-container {
            display: none;
        }
        
        .mobile-client-card {
            background: white;
            border-radius: 8px;
            padding: 15px;
            margin-bottom: 15px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
            border-left: 4px solid #000;
        }
        
        .mobile-client-field {
            display: flex;
            justify-content: space-between;
            padding: 8px 0;
            border-bottom: 1px solid #f0f0f0;
        }
        
        .mobile-client-field:last-child {
            border-bottom: none;
        }
        
        .mobile-field-label {
            font-weight: 600;
            color: #2c3e50;
        }
        
        .mobile-field-value {
            color: #4a5568;
            text-align: right;
        }
        
        .mobile-actions {
            display: flex;
            justify-content: center;
            margin-top: 10px;
            gap: 10px;
        }
        
        /* Mobile menu styles */
        .mobile-menu-overlay {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            z-index: 30;
            display: none;
        }
        
        .mobile-menu-overlay.active {
            display: block;
        }

        /* Column widths for better fit */
        .col-id { width: 5%; }
        .col-name { width: 12%; }
        .col-contact { width: 10%; }
        .col-email { width: 15%; }
        .col-gender { width: 8%; }
        .col-age { width: 8%; }
        .col-income { width: 10%; }
        .col-model { width: 12%; }
        .col-test-drive { width: 8%; }
        .col-date { width: 10%; }
        .col-actions { width: 12%; }

        @media (max-width: 768px) {
            .desktop-table-container {
                display: none;
            }
            
            .mobile-table-container {
                display: block;
            }
            
            .search-filter-container {
                flex-direction: column;
            }
            
            .search-box {
                width: 100%;
            }
            
            .filter-row {
                grid-template-columns: 1fr;
            }
            
            .filter-group {
                flex-direction: column;
                align-items: flex-start;
                height: auto;
                gap: 5px;
            }
            
            .filter-label {
                width: 100%;
            }
            
            .btn-reset {
                width: 100%;
                justify-content: center;
                margin-top: 15px;
            }
            
            .pagination {
                flex-wrap: wrap;
                gap: 10px;
            }
            
            .pagination button {
                padding: 8px 15px;
            }
            
            .page-info {
                width: 100%;
                text-align: center;
            }
        }

        @media (min-width: 769px) {
            #sidebar-toggle {
                display: none;
            }
        }
        
        @media (max-width: 768px) {
            .image-modal-close {
                top: -40px;
                right: -60px;
            }
        }
    </style>
</head>
<body class="bg-gray-100">

    <div id="login-section" class="flex items-center justify-center min-h-screen">
        <div class="w-full max-w-md p-8 space-y-6 bg-white rounded-lg shadow-md">
            <div class="text-center">
                <h2 class="text-3xl font-bold text-gray-900">Admin Panel Login</h2>
                <p class="mt-2 text-sm text-gray-600">Please sign in to continue</p>
            </div>
            <div id="login-error" class="hidden p-3 text-sm text-red-700 bg-red-100 rounded-lg"></div>
            <form id="login-form" class="space-y-6">
                <div>
                    <label for="username" class="text-sm font-medium text-gray-700">Username</label>
                    <input id="username" name="username" type="text" autocomplete="username" required class="block w-full px-3 py-2 mt-1 placeholder-gray-400 border border-gray-300 rounded-md shadow-sm appearance-none focus:outline-none focus:ring-black focus:border-black sm:text-sm">
                </div>
                <div>
                    <label for="password" class="text-sm font-medium text-gray-700">Password</label>
                    <input id="password" name="password" type="password" autocomplete="current-password" required class="block w-full px-3 py-2 mt-1 placeholder-gray-400 border border-gray-300 rounded-md shadow-sm appearance-none focus:outline-none focus:ring-black focus:border-black sm:text-sm">
                </div>
                <button type="submit" class="flex justify-center w-full px-4 py-2 text-sm font-medium text-white bg-black border border-transparent rounded-md shadow-sm hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-black">
                    Sign in
                </button>
            </form>
        </div>
    </div>

    <div id="admin-panel" class="hidden">
        <!-- Mobile menu overlay -->
        <div id="mobile-menu-overlay" class="mobile-menu-overlay"></div>
        
            <div class="flex flex-col w-64 bg-gray-800 fixed top-0 left-0 h-full z-40 transition-all md:translate-x-0" id="sidebar">
                <div class="flex items-center justify-between h-16 text-white bg-gray-900 px-4">
                    <span class="text-xl font-bold">Admin Panel</span>
                </div>
                <div class="flex flex-col flex-grow p-4 overflow-auto">
                    <a class="flex items-center px-4 py-2 mt-2 text-gray-100 rounded hover:bg-gray-700" href="#" id="dashboard-link">
                        <i class="fas fa-tachometer-alt"></i><span class="ml-3">Dashboard</span>
                    </a>
                    <a class="flex items-center px-4 py-2 mt-2 text-gray-100 rounded hover:bg-gray-700" href="#" id="clients-link">
                        <i class="fas fa-users"></i><span class="ml-3">Clients</span>
                    </a>
                    <div class="mt-auto">
                        <a class="flex items-center px-4 py-2 text-gray-100 rounded hover:bg-gray-700" href="#" id="logout-button">
                            <i class="fas fa-sign-out-alt"></i><span class="ml-3">Logout</span>
                        </a>
                        <button id="sidebar-close-bottom" class="flex items-center w-full px-4 py-2 mt-2 text-gray-100 rounded hover:bg-gray-700 md:hidden">
                            <i class="fas fa-times"></i><span class="ml-3">Close Menu</span>
                        </button>
                    </div>
                </div>
            </div>

            <div class="flex flex-col flex-grow">
                <div class="flex items-center justify-between flex-shrink-0 h-16 px-8 bg-white border-b border-gray-200">
                    <div class="flex items-center">
                        <button id="sidebar-toggle" class="mr-4 text-gray-700 hover:text-gray-900 md:hidden">
                            <i class="fas fa-bars text-xl"></i>
                        </button>
                        <h1 class="text-lg font-medium" id="page-title">Dashboard</h1>
                    </div>
                    <div class="flex items-center gap-4">
                        <button id="refresh-btn" class="btn btn-refresh" title="Refresh Data">
                            <i class="fas fa-sync-alt"></i> <span class="hidden md:inline">Refresh</span>
                        </button>
                        <span class="text-sm hidden md:inline" id="user-email">Welcome, Car</span>
                    </div>
                </div>
                <div class="flex-grow p-6 overflow-auto bg-gray-100 ml-0 md:ml-64 transition-all" id="main-content">
                    <div id="dashboard-view">
                        <div class="p-6 mb-6 bg-white rounded-lg shadow-md transition-all duration-300 hover:shadow-lg hover:-translate-y-1">
                            <h3 class="text-lg font-medium text-gray-700">Total Clients</h3>
                            <p class="mt-2 text-3xl font-bold text-gray-900" id="total-clients">0</p>
                        </div>
                        <div class="grid grid-cols-1 gap-6 md:grid-cols-2">
                            <div class="p-6 bg-white rounded-lg shadow-md">
                                <h3 class="text-lg font-medium text-gray-700">Hosting</h3>
                                <p class="mt-2 text-xl font-bold text-green-600">Active</p>
                            </div>
                            <div class="p-6 bg-white rounded-lg shadow-md transition-all duration-300 hover:shadow-lg hover:-translate-y-1">
                                <h3 class="text-lg font-medium text-gray-700">Storage</h3>
                                <p class="mt-2 text-3xl font-bold text-gray-900">10 GB</p>
                            </div>
                        </div>
                    </div>
                    <div id="clients-view" class="hidden">
                        <div class="card">
                            <div class="overflow-x-auto">
                                <h1 class="mt-2 mb-5 text-3xl font-bold text-gray-900 text-center">Client Records</h1>
                                <div class="search-filter-container">
                                    <div class="search-box">
                                        <i class="fas fa-search"></i>
                                        <input type="text" id="search-input" placeholder="Search Clients">
                                    </div>
                                </div>
                                
                                <div class="filter-row">
                                    <div class="filter-group">
                                        <span class="filter-label">Gender:</span>
                                        <select id="gender-filter">
                                            <option value="">All Genders</option>
                                            <option value="Female">Female</option>
                                            <option value="Male">Male</option>
                                            <option value="Other">Other</option>
                                        </select>
                                    </div>
                                    
                                    <div class="filter-group">
                                        <span class="filter-label">Age:</span>
                                            <select id="age-filter">
                                                <option value="">All Ages</option>
                                                <option value="18-24">18-24</option>
                                                <option value="25-34">25-34</option>
                                                <option value="35-44">35-44</option>
                                                <option value="45-54">45-54</option>
                                                <option value="55-64">55-64</option>
                                                <option value="65+">65+</option>
                                            </select>
                                    </div>
                                    
                                    <div class="filter-group">
                                        <span class="filter-label">Income:</span>
                                            <select id="income-filter">
                                                <option value="">All Incomes</option>
                                                <option value="under-2500">Under RM2,500</option>
                                                <option value="2501-5000">RM2,501 - RM5,000</option>
                                                <option value="5001-7500">RM5,001 - RM7,500</option>
                                                <option value="7501-10000">RM7,501 - RM10,000</option>
                                                <option value="10001-15000">RM10,001 - RM15,000</option>
                                                <option value="15001-20000">RM15,001 - RM20,000</option>
                                                <option value="over-20001">Over RM20,001</option>
                                            </select>
                                    </div>
                                    
                                    <div class="filter-group">
                                        <span class="filter-label">Car Model:</span>
                                            <select id="car-model-filter">
                                                <option value="">All Models</option>
                                                <option value="LBX">LBX</option>
                                                <option value="NX">NX</option>
                                                <option value="RX">RX</option>
                                                <option value="RZ">RZ</option>
                                                <option value="ES">ES</option>
                                            </select>
                                    </div>

                                    <div class="filter-group">
                                        <span class="filter-label">Test Drive:</span>
                                        <select id="test-drive-filter">
                                            <option value="">All</option>
                                            <option value="Yes">Yes</option>
                                            <option value="No">No</option>
                                        </select>
                                    </div>
                                    
                                    <div class="filter-group">
                                        <span class="filter-label">License Expiry:</span>
                                        <select id="license-filter">
                                            <option value="">Any Expiry</option>
                                            <option value="expiring-soon">Expiring Soon (within 6 months)</option>
                                            <option value="valid-long-term">Valid Long Term</option>
                                        </select>
                                    </div>
                                    
                                    <div class="filter-group">
                                        <span class="filter-label">Register Date:</span>
                                        <select id="registration-date-filter">
                                            <option value="">All</option>
                                            <option value="last-week">Last Week</option>
                                            <option value="last-month">Last Month</option>
                                            <option value="last-3-months">Last 3 Months</option>
                                        </select>
                                    </div>
                                </div>
                                <div style="width:100%;display:flex;justify-content:flex-end;gap:10px;">
                                    <button id="reset-btn" class="btn btn-reset">
                                        <i class="fas fa-redo"></i> Reset Filters
                                    </button>
                                </div>
                            </div>
                        </div>
                        
                        <div class="card">
                            <div class="desktop-table-container">
                                <h1 class="mt-2 text-3xl font-bold text-gray-900 text-center">Results</h1>
                                <table>
                                    <thead>
                                        <tr>
                                            <th class="col-id" data-sort="id"><span class="header-label">ID</span><span class="sort-symbol">▲▼</span></th>
                                            <th class="col-name" data-sort="fullName"><span class="header-label">Full Name</span><span class="sort-symbol">▲▼</span></th>
                                            <th class="col-contact" data-sort="contactNumber"><span class="header-label">Contact</span><span class="sort-symbol">▲▼</span></th>
                                            <th class="col-email" data-sort="email"><span class="header-label">Email</span><span class="sort-symbol">▲▼</span></th>
                                            <th class="col-gender" data-sort="gender"><span class="header-label">Gender</span><span class="sort-symbol">▲▼</span></th>
                                            <th class="col-age" data-sort="ageRange"><span class="header-label">Age</span><span class="sort-symbol">▲▼</span></th>
                                            <th class="col-income" data-sort="monthlyIncome"><span class="header-label">Income</span><span class="sort-symbol">▲▼</span></th>
                                            <th class="col-model" data-sort="carModel"><span class="header-label">Car Model</span><span class="sort-symbol">▲▼</span></th>
                                            <th class="col-test-drive" data-sort="testDrive"><span class="header-label">Test Drive</span><span class="sort-symbol">▲▼</span></th>
                                            <th class="col-date" data-sort="registrationDate"><span class="header-label">Reg. Date</span><span class="sort-symbol">▲▼</span></th>
                                            <th class="col-actions">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody id="clients-table-body">
                                    </tbody>
                                </table>
                            </div>
                            
                            <div class="mobile-table-container">
                                <h1 class="mt-2 text-3xl font-bold text-gray-900 text-center">Results</h1>
                                <div id="mobile-clients-list">
                                </div>
                            </div>
                            
                            <div class="results-info">
                                Showing <span id="results-count">0</span> of <span id="total-results">0</span> clients
                            </div>
                            
                            <div class="pagination">
                                <button id="prev-page" disabled>Previous</button>
                                <span class="page-info">Page <span id="current-page">1</span> of <span id="total-pages">1</span></span>
                                <button id="next-page" disabled>Next</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Client Details Modal -->
    <div id="client-modal" class="fixed inset-0 z-50 flex items-center justify-center hidden bg-black bg-opacity-50 p-4">
        <div class="w-full max-w-2xl max-h-[90vh] bg-white rounded-lg shadow-xl overflow-hidden flex flex-col">
            <div class="flex items-center justify-between p-4 sm:p-6 border-b flex-shrink-0">
                <h3 class="text-xl sm:text-2xl font-semibold">Client Details</h3>
                <button id="close-modal" class="text-gray-500 text-2xl sm:text-3xl p-2 transition-all duration-300 hover:text-gray-800 hover:scale-105">&times;</button>
            </div>
            <div class="flex-1 overflow-y-auto p-4 sm:p-6" id="modal-content">
            </div>
        </div>
    </div>

    <!-- Image View Modal -->
    <div id="image-modal" class="image-modal hidden">
        <div class="image-modal-content">
            <button id="close-image-modal" class="image-modal-close">
                <i class="fas fa-times"></i>
            </button>
            <img id="modal-image" src="" alt="License Image">
        </div>
    </div>

   <script>
    // Global variables
    let clientsData = [];
    let filteredData = [];
    let currentSort = {
        field: 'id',
        direction: 'asc'
    };
    let currentPage = 1;
    const itemsPerPage = 5;

    // DOM elements - define them globally
    let clientsTableBody, currentPageEl, totalPagesEl, prevPageBtn, nextPageBtn, resultsCountEl, totalResultsEl;

    // Define functions
    function applySorting() {
        const sortField = currentSort.field;
        const order = currentSort.direction;
        
        filteredData.sort((a, b) => {
            let valueA = a[sortField];
            let valueB = b[sortField];
            
            if (Array.isArray(valueA)) {
                valueA = valueA.join(', ');
                valueB = valueB.join(', ');
            }
            
            // Handle date sorting
            if (sortField === 'registrationDate' || sortField === 'drivingLicenseExpiryDate') {
                valueA = new Date(valueA);
                valueB = new Date(valueB);
            }
            
            if (valueA < valueB) {
                return order === 'asc' ? -1 : 1;
            }
            
            if (valueA > valueB) {
                return order === 'asc' ? 1 : -1;
            }
            
            return 0;
        });
        
        updateSortIcons();
        currentPage = 1;
        updatePagination();
        renderTable();
    }
    
    function updateSortIcons() {
        document.querySelectorAll('th .sort-symbol').forEach(symbol => {
            symbol.textContent = '▲▼';
        });
        const currentHeader = document.querySelector(`th[data-sort="${currentSort.field}"] .sort-symbol`);
        if (currentHeader) {
            currentHeader.textContent = currentSort.direction === 'asc' ? '▲' : '▼';
        }
    }
    
    function changePage(page) {
        const totalPages = Math.ceil(filteredData.length / itemsPerPage) || 1;
        if (page < 1 || page > totalPages) return;
        
        currentPage = page;
        updatePagination();
        renderTable();
    }
    
    function updatePagination() {
        const totalPages = Math.ceil(filteredData.length / itemsPerPage) || 1;
        
        if (currentPage > totalPages) {
            currentPage = totalPages;
        }
        
        currentPageEl.textContent = currentPage;
        totalPagesEl.textContent = totalPages;
        
        prevPageBtn.disabled = currentPage === 1;
        nextPageBtn.disabled = currentPage === totalPages;
        
        const startCount = Math.min((currentPage - 1) * itemsPerPage + 1, filteredData.length);
        const endCount = Math.min(currentPage * itemsPerPage, filteredData.length);
        
        resultsCountEl.textContent = `${startCount} - ${endCount}`;
        totalResultsEl.textContent = filteredData.length;
    }
    
    function formatDate(date) {
        if (!date) return 'N/A';
        return new Date(date).toLocaleDateString('en-US', {
            year: 'numeric',
            month: 'short',
            day: 'numeric'
        });
    }
    
    function renderTable() {
        if (!clientsTableBody) {
            console.error('clientsTableBody not found');
            return;
        }

        // Render desktop table
        clientsTableBody.innerHTML = '';
        const startIndex = (currentPage - 1) * itemsPerPage;
        const endIndex = Math.min(startIndex + itemsPerPage, filteredData.length);
        
        if (filteredData.length === 0) {
            clientsTableBody.innerHTML = `
                <tr>
                    <td colspan="11" style="text-align: center; padding: 20px;">
                        No clients found matching your criteria.
                    </td>
                </tr>
            `;
            
            // Also update mobile view
            document.getElementById('mobile-clients-list').innerHTML = `
                <div class="text-center p-4">
                    No clients found matching your criteria.
                </div>
            `;
            return;
        }
        
        // Desktop table
        for (let i = startIndex; i < endIndex; i++) {
            const client = filteredData[i];
            const carModelDisplay = Array.isArray(client.carModel) ? client.carModel.join(', ') : client.carModel;
            const row = document.createElement('tr');
            row.innerHTML = `
                <td>${client.id}</td>
                <td>${client.fullName || 'N/A'}</td>
                <td>${client.contactNumber || 'N/A'}</td>
                <td>${client.email || 'N/A'}</td>
                <td>${client.gender || 'N/A'}</td>
                <td>${client.ageRange || 'N/A'}</td>
                <td>${client.monthlyIncome || 'N/A'}</td>
                <td>${carModelDisplay || 'N/A'}</td>
                <td>${client.testDrive || 'N/A'}</td>
                <td>${formatDate(client.registrationDate)}</td>
                <td class="actions">
                    <button class="btn btn-view view-details-btn" data-id="${client.id}"><i class="fas fa-eye"></i> View</button>
                    <button class="btn btn-delete delete-client-btn" data-id="${client.id}"><i class="fas fa-trash"></i> Delete</button>
                </td>
            `;
            clientsTableBody.appendChild(row);
        }
        
        // Mobile cards
        renderMobileCards();
    }
    
    function renderMobileCards() {
        const mobileList = document.getElementById('mobile-clients-list');
        mobileList.innerHTML = '';
        
        const startIndex = (currentPage - 1) * itemsPerPage;
        const endIndex = Math.min(startIndex + itemsPerPage, filteredData.length);
        
        for (let i = startIndex; i < endIndex; i++) {
            const client = filteredData[i];
            const carModelDisplay = Array.isArray(client.carModel) ? client.carModel.join(', ') : client.carModel;
            
            const card = document.createElement('div');
            card.className = 'mobile-client-card';
            card.innerHTML = `
                <div class="mobile-client-field">
                    <span class="mobile-field-label">ID:</span>
                    <span class="mobile-field-value">${client.id}</span>
                </div>
                <div class="mobile-client-field">
                    <span class="mobile-field-label">Full Name:</span>
                    <span class="mobile-field-value">${client.fullName || 'N/A'}</span>
                </div>
                <div class="mobile-client-field">
                    <span class="mobile-field-label">Contact:</span>
                    <span class="mobile-field-value">${client.contactNumber || 'N/A'}</span>
                </div>
                <div class="mobile-client-field">
                    <span class="mobile-field-label">Email:</span>
                    <span class="mobile-field-value">${client.email || 'N/A'}</span>
                </div>
                <div class="mobile-client-field">
                    <span class="mobile-field-label">Gender:</span>
                    <span class="mobile-field-value">${client.gender || 'N/A'}</span>
                </div>
                <div class="mobile-client-field">
                    <span class="mobile-field-label">Age Range:</span>
                    <span class="mobile-field-value">${client.ageRange || 'N/A'}</span>
                </div>
                <div class="mobile-client-field">
                    <span class="mobile-field-label">Income:</span>
                    <span class="mobile-field-value">${client.monthlyIncome || 'N/A'}</span>
                </div>
                <div class="mobile-client-field">
                    <span class="mobile-field-label">Car Model:</span>
                    <span class="mobile-field-value">${carModelDisplay || 'N/A'}</span>
                </div>
                <div class="mobile-client-field">
                    <span class="mobile-field-label">Test Drive:</span>
                    <span class="mobile-field-value">${client.testDrive || 'N/A'}</span>
                </div>
                <div class="mobile-client-field">
                    <span class="mobile-field-label">Reg. Date:</span>
                    <span class="mobile-field-value">${formatDate(client.registrationDate)}</span>
                </div>
                <div class="mobile-actions">
                    <button class="btn btn-view view-details-btn" data-id="${client.id}"><i class="fas fa-eye"></i> View</button>
                    <button class="btn btn-delete delete-client-btn" data-id="${client.id}"><i class="fas fa-trash"></i> Delete</button>
                </div>
            `;
            mobileList.appendChild(card);
        }
    }

    // Delete client function
    async function deleteClient(clientId) {
        if (!confirm('Are you sure you want to delete this client?')) {
            return;
        }

        try {
            const response = await fetch('./delete_client.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify({ id: clientId })
            });

            const result = await response.json();

            if (result.success) {
                alert('Client deleted successfully!');
                // Remove from local data
                clientsData = clientsData.filter(client => client.id != clientId);
                filteredData = filteredData.filter(client => client.id != clientId);

                // Update UI
                document.getElementById('total-clients').textContent = clientsData.length;
                applySorting();
                updatePagination();
                renderTable();
            } else {
                alert('Error: ' + result.message);
            }
        } catch (error) {
            console.error('Error deleting client:', error);
            alert('Error deleting client. Please try again.');
        }
    }

    // Function to renumber client IDs sequentially
    function renumberClientIds() {
        clientsData.forEach((client, index) => {
            client.id = index + 1;
        });
        filteredData.forEach((client, index) => {
            client.id = index + 1;
        });
    }

    async function loadClients() {
        console.log('Loading clients from database...');
        try {
            const response = await fetch('./get_clients.php');
            
            if (!response.ok) {
                throw new Error(`HTTP error! status: ${response.status}`);
            }
            
            const responseText = await response.text();
            console.log('Raw response:', responseText);
            
            // Check if response contains HTML error
            if (responseText.includes('<br />') || responseText.includes('<b>')) {
                console.error('PHP Error in response:', responseText);
                throw new Error('Server returned PHP error. Check PHP configuration.');
            }
            
            const result = JSON.parse(responseText);
            console.log('API Response:', result);
            
            if (result.success) {
                clientsData = result.clients;
                filteredData = [...clientsData];
                document.getElementById('total-clients').textContent = clientsData.length;
                console.log(`Loaded ${clientsData.length} clients from database`);
                
                applySorting();
                updatePagination();
                renderTable();
            } else {
                console.error('Error loading clients:', result.message);
                alert('Error loading clients: ' + result.message);
                clientsData = [];
                filteredData = [];
                renderTable();
            }
        } catch (error) {
            console.error('Error fetching clients:', error);
            alert('Error loading clients: ' + error.message + '\nCheck browser console for details.');
            clientsData = [];
            filteredData = [];
            renderTable();
        }
    }

    function refreshData() {
        console.log('Refreshing data...');
        loadClients();
    }

    document.addEventListener('DOMContentLoaded', () => {
        // Initialize DOM elements
        clientsTableBody = document.getElementById('clients-table-body');
        currentPageEl = document.getElementById('current-page');
        totalPagesEl = document.getElementById('total-pages');
        prevPageBtn = document.getElementById('prev-page');
        nextPageBtn = document.getElementById('next-page');
        resultsCountEl = document.getElementById('results-count');
        totalResultsEl = document.getElementById('total-results');

        const loginSection = document.getElementById('login-section');
        const adminPanel = document.getElementById('admin-panel');
        const loginForm = document.getElementById('login-form');
        const loginError = document.getElementById('login-error');
        const logoutButton = document.getElementById('logout-button');
        
        const dashboardLink = document.getElementById('dashboard-link');
        const clientsLink = document.getElementById('clients-link');
        const dashboardView = document.getElementById('dashboard-view');
        const clientsView = document.getElementById('clients-view');
        const pageTitle = document.getElementById('page-title');

        const clientModal = document.getElementById('client-modal');
        const closeModal = document.getElementById('close-modal');
        const modalContent = document.getElementById('modal-content');

        const imageModal = document.getElementById('image-modal');
        const closeImageModal = document.getElementById('close-image-modal');
        const modalImage = document.getElementById('modal-image');

        const searchInput = document.getElementById('search-input');
        const refreshBtn = document.getElementById('refresh-btn');
        
        const genderFilter = document.getElementById('gender-filter');
        const ageFilter = document.getElementById('age-filter');
        const incomeFilter = document.getElementById('income-filter');
        const carModelFilter = document.getElementById('car-model-filter');
        const testDriveFilter = document.getElementById('test-drive-filter');
        const licenseFilter = document.getElementById('license-filter');
        const registrationDateFilter = document.getElementById('registration-date-filter');
        
        const mobileMenuOverlay = document.getElementById('mobile-menu-overlay');
        const sidebar = document.getElementById('sidebar');
        const sidebarToggle = document.getElementById('sidebar-toggle');
        const mainContent = document.getElementById('main-content');

        // Add event listeners for delete buttons
        document.addEventListener('click', (e) => {
            if (e.target.classList.contains('delete-client-btn') || e.target.closest('.delete-client-btn')) {
                const button = e.target.classList.contains('delete-client-btn') ? e.target : e.target.closest('.delete-client-btn');
                const clientId = button.dataset.id;
                deleteClient(clientId);
            }
        });

        // Add event listeners for close buttons
        const sidebarCloseBottom = document.getElementById('sidebar-close-bottom');
        if (sidebarCloseBottom) {
            sidebarCloseBottom.addEventListener('click', closeMobileMenu);
        }
        
        // Authentication 
        loginForm.addEventListener('submit', (e) => {
            e.preventDefault();
            const username = loginForm.username.value;
            const password = loginForm.password.value;

            if (username === 'Car' && password === 'Carevent') {
                loginSection.classList.add('hidden');
                adminPanel.classList.remove('hidden');
                loginError.classList.add('hidden');
                console.log('Login successful, loading clients...');
                loadClients();
                init();
            } else {
                loginError.textContent = 'Invalid username or password.';
                loginError.classList.remove('hidden');
            }
        });

        logoutButton.addEventListener('click', () => {
            adminPanel.classList.add('hidden');
            loginSection.classList.remove('hidden');
            loginForm.reset();
        });

        function showView(view) {
            dashboardView.classList.add('hidden');
            clientsView.classList.add('hidden');
            view.classList.remove('hidden');
        }

        dashboardLink.addEventListener('click', (e) => {
            e.preventDefault();
            pageTitle.textContent = 'Dashboard';
            showView(dashboardView);
            closeMobileMenu();
        });

        clientsLink.addEventListener('click', (e) => {
            e.preventDefault();
            pageTitle.textContent = 'Clients';
            showView(clientsView);
            closeMobileMenu();
        });

        // Refresh buttons
        refreshBtn.addEventListener('click', refreshData);

        // Modal Logic 
        document.addEventListener('click', (e) => {
            if (e.target.classList.contains('view-details-btn') || e.target.closest('.view-details-btn')) {
                const button = e.target.classList.contains('view-details-btn') ? e.target : e.target.closest('.view-details-btn');
                const clientId = button.dataset.id;
                const client = clientsData.find(c => c.id == clientId);
                if (client) {
                    displayClientDetails(client);
                }
            }
        });

        function displayClientDetails(client) {
            const fileUrl = client.fileName ? `uploads/${client.fileName}` : '#';
            const isImageFile = client.fileName && /\.(jpg|jpeg|png|gif|bmp|webp)$/i.test(client.fileName);
            
            modalContent.innerHTML = `
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-sm">
                    <div><strong>Full Name:</strong> ${client.fullName || 'N/A'}</div>
                    <div><strong>Contact:</strong> ${client.contactNumber || 'N/A'}</div>
                    <div><strong>Email:</strong> ${client.email || 'N/A'}</div>
                    <div><strong>Gender:</strong> ${client.gender || 'N/A'}</div>
                    <div><strong>Age Range:</strong> ${client.ageRange || 'N/A'}</div>
                    <div><strong>Monthly Income:</strong> ${client.monthlyIncome || 'N/A'}</div>
                    <div><strong>Sales Consultant:</strong> ${client.consultant || 'N/A'}</div>
                    <div><strong>Interested Models:</strong> ${Array.isArray(client.carModel) ? client.carModel.join(', ') : (client.carModel || 'N/A')}</div>
                    <div><strong>Test Drive?:</strong> ${client.testDrive || 'N/A'}</div>
                    <div><strong>License Expiry:</strong> ${client.drivingLicenseExpiryDate || 'N/A'}</div>
                    <div class="md:col-span-2">
                        <strong>License File:</strong> 
                        ${client.fileName ? 
                            (isImageFile ? 
                                `<div class="mt-2">
                                    <img src="${fileUrl}" alt="License Image" class="max-w-xs cursor-pointer border rounded-lg shadow-sm" onclick="openImageModal('${fileUrl}')">
                                    <p class="text-xs text-gray-500 mt-1">Click image to view larger</p>
                                </div>` :
                                `<a href="${fileUrl}" target="_blank" class="text-indigo-600 hover:underline">${client.fileName}</a>`
                            ) : 
                            'No file uploaded'
                        }
                    </div>
                </div>
            `;
            clientModal.classList.remove('hidden');
        }

        // Image modal functions
        window.openImageModal = function(imageUrl) {
            modalImage.src = imageUrl;
            imageModal.classList.remove('hidden');
        }

        closeModal.addEventListener('click', () => {
            clientModal.classList.add('hidden');
        });

        closeImageModal.addEventListener('click', () => {
            imageModal.classList.add('hidden');
        });

        window.addEventListener('click', (e) => {
            if (e.target === clientModal) {
                clientModal.classList.add('hidden');
            }
            if (e.target === imageModal) {
                imageModal.classList.add('hidden');
            }
        });

        // Close modals with Escape key
        document.addEventListener('keydown', (e) => {
            if (e.key === 'Escape') {
                clientModal.classList.add('hidden');
                imageModal.classList.add('hidden');
            }
        });

        function init() {
            setupEventListeners();
            updatePagination();
        }
        
        function setupEventListeners() {
            searchInput.addEventListener('input', handleSearch);
            
            document.getElementById('reset-btn').addEventListener('click', resetFilters);

            genderFilter.addEventListener('change', applyFilters);
            ageFilter.addEventListener('change', applyFilters);
            incomeFilter.addEventListener('change', applyFilters);
            carModelFilter.addEventListener('change', applyFilters);
            testDriveFilter.addEventListener('change', applyFilters);
            licenseFilter.addEventListener('change', applyFilters);
            registrationDateFilter.addEventListener('change', applyFilters);

            prevPageBtn.addEventListener('click', () => changePage(currentPage - 1));
            nextPageBtn.addEventListener('click', () => changePage(currentPage + 1));
 
            document.querySelectorAll('th[data-sort]').forEach(header => {
                header.addEventListener('click', () => {
                    const sortField = header.getAttribute('data-sort');
                    
                    if (currentSort.field === sortField) {
                        currentSort.direction = currentSort.direction === 'asc' ? 'desc' : 'asc';
                    } else {
                        currentSort.field = sortField;
                        currentSort.direction = 'asc';
                    }
                    
                    applySorting();
                });
            });
        }

        function resetFilters() {
            searchInput.value = '';
            genderFilter.value = '';
            ageFilter.value = '';
            incomeFilter.value = '';
            carModelFilter.value = '';
            testDriveFilter.value = '';
            licenseFilter.value = '';
            registrationDateFilter.value = '';
            
            currentSort = {
                field: 'id',
                direction: 'asc'
            };
            
            currentPage = 1;
            filteredData = [...clientsData];
            
            applySorting();
            updatePagination();
            renderTable();
        }
    
        function handleSearch() {
            applyFilters();
        }
        
        function applyFilters() {
            const searchTerm = searchInput.value.toLowerCase();
            
            filteredData = clientsData.filter(client => {
                if (searchTerm && !(
                    (client.fullName && client.fullName.toLowerCase().includes(searchTerm)) ||
                    (client.email && client.email.toLowerCase().includes(searchTerm)) ||
                    (client.contactNumber && client.contactNumber.includes(searchTerm))
                )) {
                    return false;
                }
                
                if (genderFilter.value && client.gender !== genderFilter.value) {
                    return false;
                }
                
                if (ageFilter.value && client.ageRange !== ageFilter.value) {
                    return false;
                }
                
                if (incomeFilter.value && client.monthlyIncome !== incomeFilter.value) {
                    return false;
                }
                
                if (carModelFilter.value) {
                    const carModels = Array.isArray(client.carModel) ? client.carModel : [client.carModel];
                    if (!carModels.includes(carModelFilter.value)) {
                        return false;
                    }
                }
                
                if (testDriveFilter.value && client.testDrive !== testDriveFilter.value) {
                    return false;
                }
                
                if (licenseFilter.value && client.drivingLicenseExpiryDate) {
                    const today = new Date();
                    const expiryDate = new Date(client.drivingLicenseExpiryDate);
                    const sixMonthsFromNow = new Date();
                    sixMonthsFromNow.setMonth(sixMonthsFromNow.getMonth() + 6);
                    
                    if (licenseFilter.value === 'expiring-soon' && expiryDate > sixMonthsFromNow) {
                        return false;
                    }
                    
                    if (licenseFilter.value === 'valid-long-term' && expiryDate <= sixMonthsFromNow) {
                        return false;
                    }
                }
                
                if (registrationDateFilter.value && client.registrationDate) {
                    const today = new Date();
                    today.setHours(0,0,0,0);
                    const regDate = new Date(client.registrationDate);
                    regDate.setHours(0,0,0,0);
                    
                    if (registrationDateFilter.value === 'last-week') {
                        const weekAgo = new Date(today);
                        weekAgo.setDate(today.getDate() - 6);
                        if (regDate < weekAgo || regDate > today) {
                            return false;
                        }
                    } else if (registrationDateFilter.value === 'last-month') {
                        const monthAgo = new Date(today);
                        monthAgo.setDate(today.getDate() - 29);
                        if (regDate < monthAgo || regDate > today) {
                            return false;
                        }
                    } else if (registrationDateFilter.value === 'last-3-months') {
                        const threeMonthsAgo = new Date(today);
                        threeMonthsAgo.setDate(today.getDate() - 89);
                        if (regDate < threeMonthsAgo || regDate > today) {
                            return false;
                        }
                    }
                }
                
                return true;
            });
            
            applySorting();
        }

        // Mobile menu functions
        function openMobileMenu() {
            sidebar.classList.remove('sidebar-closed');
            sidebar.classList.add('sidebar-open');
            mobileMenuOverlay.classList.add('active');
            document.body.style.overflow = 'hidden';
        }

        function closeMobileMenu() {
            sidebar.classList.remove('sidebar-open');
            sidebar.classList.add('sidebar-closed');
            mobileMenuOverlay.classList.remove('active');
            document.body.style.overflow = '';
        }

        // Sidebar toggle functionality
        if (sidebarToggle && sidebar && mainContent) {
            sidebarToggle.addEventListener('click', openMobileMenu);
            
            mobileMenuOverlay.addEventListener('click', closeMobileMenu);
            
            sidebar.classList.add('transition-all');
            
            // Initialize sidebar state based on screen size
            if (window.innerWidth < 768) {
                sidebar.classList.add('sidebar-closed');
                mainContent.classList.add('ml-0');
            } else {
                // Remove any closed classes and ensure sidebar is visible on desktop
                sidebar.classList.remove('sidebar-closed');
                mainContent.classList.remove('ml-0');
                mainContent.classList.add('ml-64');
            }
        }

        // Handle window resize
        window.addEventListener('resize', () => {
            if (window.innerWidth >= 768) {
                sidebar.classList.remove('sidebar-closed');
                sidebar.classList.add('sidebar-open');
                mainContent.classList.remove('ml-0');
                mainContent.classList.add('ml-64');
                mobileMenuOverlay.classList.remove('active');
                document.body.style.overflow = '';
            } else {
                if (!sidebar.classList.contains('sidebar-closed')) {
                    sidebar.classList.remove('sidebar-open');
                    sidebar.classList.add('sidebar-closed');
                    mainContent.classList.remove('ml-64');
                    mainContent.classList.add('ml-0');
                }
            }
        });
    });
</script>
</body>
</html>