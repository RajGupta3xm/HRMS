<!DOCTYPE html>
<html>
<head>
    <title>New Project Assigned to You</title>
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
            list-style-type: none;
            padding: 0;
        }
        .content ul li {
            background-color: #f9f9f9;
            margin: 5px 0;
            padding: 10px;
            border-left: 5px solid #007bff;
        }
        .content ul li strong {
            font-weight: bold;
            color: #007bff;
        }
        .content ul li span {
            font-weight: 500;
            font-weight: bold;
        }
        .content ol {
            list-style-type: decimal;
            padding-left: 20px;
        }
        .content ol li {
            margin: 10px 0;
            font-weight: bold;
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
            <h1>New Project Assigned to You</h1>
        </div>
        <div class="content">
            <p>Dear {{ $projectManagerName }},</p>

            <p>Congratulations! You have been allocated a new project.</p>

            <p><strong>Project Overview:</strong></p>
            <ul>
                <li><span>Project Name:</span> <strong>{{ $projectName }}</strong></li>
                <li><span>Client:</span> <strong>{{ $clientName }}</strong></li>
                <li><span>Start Date:</span> <strong>{{ $startDate }}</strong></li>
                <li><span>End Date:</span> <strong>{{ $endDate }}</strong></li>
                <li><span>Project Objectives:</span> <strong>{{ $projectObjectives }}</strong></li>
                <li><span>Project Manager:</span> <strong>{{ $projectManagerName }}</strong></li>
            </ul>

            <p><strong>Next Steps:</strong></p>
            <ol>
                <li><span>Kick-off Meeting:</span> <strong></strong></li>
                <li><span>Initial Project Plan Submission:</span> <strong></strong></li>
                <li><span>Client Introduction Meeting:</span> <strong></strong></li>
                <li><span>Team Allocation</span></li>
            </ol>

            <p>Please review the attached project brief and come prepared with any questions or suggestions to our kick-off meeting.</p>

            <p>Thanks,<br>
            <span class="tms">TMS</span></p>
        </div>
        <div class="footer">
            <p>&copy; {{ date('Y') }} <span class="tms">TMS</span>. All rights reserved.</p>
        </div>
    </div>
</body>
</html>
