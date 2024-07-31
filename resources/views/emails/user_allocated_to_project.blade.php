<!DOCTYPE html>
<html>
<head>
    <title>New Project Allocation</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }
        .container {
            background-color: #ffffff;
            margin: 20px auto;
            padding: 20px;
            border: 1px solid #dddddd;
            border-radius: 8px;
            max-width: 600px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .header {
            background-color: #007bff;
            color: #ffffff;
            padding: 10px;
            border-radius: 8px 8px 0 0;
            text-align: center;
        }
        .content {
            padding: 20px;
        }
        .content p {
            line-height: 1.6;
            color: #333333;
        }
        .content ul {
            padding-left: 20px;
        }
        .content li {
            margin-bottom: 10px;
        }
        .footer {
            margin-top: 20px;
            text-align: center;
            font-size: 0.9em;
            color: #777777;
        }
        .tms {
            color: red;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>New Project Allocation</h1>
        </div>
        <div class="content">
            <p>Hi {{ $employee->name }},</p>

            <p>Congratulations! You have been allocated to a new project: {{ $project->name }}. Your skills and expertise will be a great asset to our team.</p>

            <p><strong>Project Overview:</strong></p>
            <ul>
                <li><strong>Project Name:</strong> {{ $project->projectname }}</li>
                <li><strong>Client:</strong> {{ $project->cilentname }}</li>
                <li><strong>Start Date:</strong> {{ $project->projectstartdate }}</li>
                <li><strong>End Date:</strong> {{ $project->projectenddate }}</li>
            </ul>

            <p><strong>Allocation:</strong> {{ $allocationPercentage }}%</p>

            <p>Thank you for your dedication and hard work. I am looking forward to the great contributions you will bring to this project.</p>

            <p>Best regards,<br>
            <span class="tms">TMS Team</span></p>
        </div>
        <div class="footer">
            <p>&copy; {{ date('Y') }} <span class="tms">TMS</span>. All rights reserved.</p>
        </div>
    </div>
</body>
</html>
