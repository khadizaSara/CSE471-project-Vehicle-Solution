<!-- <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Service Centre</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #cfdeecff;
            padding: 40px;
            color: #333;
        }
        .container {
            max-width: 800px;
            margin: auto;
            padding: 40px;
            background: white;
            border-radius: 8px;
            box-shadow: 0 4px 12px rgb(0 0 0 / 0.1);
        }
        h1 {
            margin-bottom: 24px;
        }
        h2 {
            color: #1d72b8;
        }
        p {
            font-size: 18px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Service Centre</h1>
        <p>Welcome to the Service Centre. Here you can manage your service requests.</p>
    </div>
    <div>
        <div>
            <h2>Service Request #{{ $serviceRequest->id }}</h2>
            <p>Description: {{ $serviceRequest->instructions }}</p>
            <p>Cost: {{ $serviceRequest->cost }}</p>
        </div>
    </div>
</body> -->
<!-- </html> -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Service Centre Dashboard</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --primary: #1d72b8;
            --primary-dark: #165992;
            --secondary: #6c757d;
            --success: #28a745;
            --light: #f8f9fa;
            --dark: #343a40;
            --background: #f0f6ff;
            --card-shadow: 0 8px 20px rgba(0, 0, 0, 0.08);
            --transition: all 0.3s ease;
        }
        
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: var(--background);
            color: #333;
            line-height: 1.6;
        }
        
        .app-container {
            display: flex;
            min-height: 100vh;
        }
        
        /* Sidebar Navigation */
        .sidebar {
            width: 260px;
            background: linear-gradient(to bottom, var(--primary), var(--primary-dark));
            color: white;
            padding: 20px 0;
            box-shadow: var(--card-shadow);
            z-index: 100;
        }
        
        .logo {
            padding: 0 20px 20px;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
            margin-bottom: 20px;
        }
        
        .logo h1 {
            font-size: 24px;
            display: flex;
            align-items: center;
            gap: 10px;
        }
        
        .logo i {
            font-size: 28px;
        }
        
        .nav-links {
            list-style: none;
            padding: 0 10px;
        }
        
        .nav-links li {
            margin-bottom: 5px;
        }
        
        .nav-links a {
            display: flex;
            align-items: center;
            padding: 12px 15px;
            color: rgba(255, 255, 255, 0.9);
            text-decoration: none;
            border-radius: 6px;
            transition: var(--transition);
        }
        
        .nav-links a:hover, .nav-links a.active {
            background: rgba(255, 255, 255, 0.1);
            color: white;
        }
        
        .nav-links i {
            margin-right: 12px;
            font-size: 18px;
        }
        
        /* Main Content */
        .main-content {
            flex: 1;
            padding: 30px;
            overflow-y: auto;
        }
        
        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
        }
        
        .welcome {
            margin-bottom: 10px;
            color: var(--secondary);
        }
        
        .page-title {
            font-size: 28px;
            color: var(--dark);
            margin-bottom: 5px;
        }
        
        .user-menu {
            display: flex;
            align-items: center;
            gap: 15px;
        }
        
        .notification-bell {
            position: relative;
            cursor: pointer;
        }
        
        .notification-bell i {
            font-size: 20px;
            color: var(--secondary);
        }
        
        .notification-badge {
            position: absolute;
            top: -5px;
            right: -5px;
            background: #e74c3c;
            color: white;
            font-size: 10px;
            width: 16px;
            height: 16px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        
        .user-profile {
            display: flex;
            align-items: center;
            gap: 10px;
            cursor: pointer;
        }
        
        .avatar {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: var(--primary);
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
        }
        
        /* Dashboard Cards */
        .dashboard-cards {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
            gap: 20px;
            margin-bottom: 30px;
        }
        
        .card {
            background: white;
            border-radius: 12px;
            padding: 20px;
            box-shadow: var(--card-shadow);
            transition: var(--transition);
        }
        
        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 12px 24px rgba(0, 0, 0, 0.1);
        }
        
        .stat-card {
            display: flex;
            align-items: center;
        }
        
        .stat-icon {
            width: 60px;
            height: 60px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 24px;
            margin-right: 15px;
        }
        
        .bg-blue {
            background: rgba(29, 114, 184, 0.15);
            color: var(--primary);
        }
        
        .bg-green {
            background: rgba(40, 167, 69, 0.15);
            color: var(--success);
        }
        
        .bg-orange {
            background: rgba(255, 153, 0, 0.15);
            color: #ff9900;
        }
        
        .stat-info h3 {
            font-size: 24px;
            margin-bottom: 5px;
        }
        
        .stat-info p {
            color: var(--secondary);
            font-size: 14px;
        }
        
        /* Service Request Detail */
        .request-detail {
            background: white;
            border-radius: 12px;
            padding: 25px;
            box-shadow: var(--card-shadow);
            margin-bottom: 30px;
        }
        
        .detail-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
            padding-bottom: 15px;
            border-bottom: 1px solid #eee;
        }
        
        .request-id {
            font-size: 22px;
            color: var(--dark);
        }
        
        .status-badge {
            padding: 6px 12px;
            border-radius: 20px;
            font-size: 14px;
            font-weight: 500;
        }
        
        .status-open {
            background: rgba(40, 167, 69, 0.15);
            color: var(--success);
        }
        
        .detail-content {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
        }
        
        @media (max-width: 768px) {
            .detail-content {
                grid-template-columns: 1fr;
            }
        }
        
        .detail-item {
            margin-bottom: 15px;
        }
        
        .detail-label {
            font-size: 12px;
            color: var(--secondary);
            margin-bottom: 5px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
        
        .detail-value {
            font-size: 16px;
            color: var(--dark);
        }
        
        .cost-value {
            font-size: 24px;
            font-weight: bold;
            color: var(--primary);
        }
        
        /* Action Buttons */
        .action-buttons {
            display: flex;
            gap: 10px;
            margin-top: 25px;
        }
        
        .btn {
            padding: 12px 20px;
            border-radius: 8px;
            border: none;
            font-weight: 500;
            cursor: pointer;
            transition: var(--transition);
            display: flex;
            align-items: center;
            gap: 8px;
        }
        
        .btn-primary {
            background: var(--primary);
            color: white;
        }
        
        .btn-primary:hover {
            background: var(--primary-dark);
        }
        
        .btn-outline {
            background: transparent;
            border: 1px solid #ddd;
            color: var(--secondary);
        }
        
        .btn-outline:hover {
            background: #f5f5f5;
        }
        
        /* Recent Requests */
        .section-title {
            font-size: 20px;
            margin-bottom: 20px;
            color: var(--dark);
        }
        
        .requests-table {
            width: 100%;
            background: white;
            border-radius: 12px;
            box-shadow: var(--card-shadow);
            overflow: hidden;
        }
        
        table {
            width: 100%;
            border-collapse: collapse;
        }
        
        th, td {
            padding: 16px 20px;
            text-align: left;
            border-bottom: 1px solid #eee;
        }
        
        th {
            background: #f8f9fa;
            font-weight: 500;
            color: var(--secondary);
        }
        
        tr:last-child td {
            border-bottom: none;
        }
        
        tr:hover {
            background: #f8f9fa;
        }
        
        /* Footer */
        .footer {
            text-align: center;
            padding: 20px;
            color: var(--secondary);
            font-size: 14px;
            margin-top: 40px;
        }
    </style>
    <div class="request-detail">
        <div class="detail-header">
            <h2 class="request-id">Service Request #{{ $serviceRequest->id }}</h2>
            <span class="status-badge status-open">In Progress</span>
        </div>
        <div class="detail-content">
                    <div class="detail-item">
                        <div class="detail-label">Description</div>
                        <div class="detail-value">{{ $serviceRequest->instructions }}</div>
                    </div>
                </div>
                <div class="detail-item">
                        <div class="detail-label">Cost</div>
                        <div class="detail-value cost-value">{{ $serviceRequest->estimated_cost }}BDT</div>
                    </div>
                    <div class="detail-item">
                        <div class="detail-label">Request Place:</div>
                        <div class="detail-value">{{ $serviceRequest->service_type }}</div>
                    </div>
        </div>
</head>