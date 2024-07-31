<!DOCTYPE html>
<html>
<head>
    <title>Timesheet Submission Reminder</title>
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
            <h1>Timesheet Submission Reminder</h1>
        </div>
        <div class="content">
            <p>Dear {{ $user->name }},</p>

            <p>This is a friendly reminder to submit your timesheets for the week of {{ $weekDates }}.</p>

            <p>Accurate timesheet submission is crucial for our project tracking and payroll processes. Please ensure that your timesheets are complete and include all hours worked, including any overtime or project-specific allocations.</p>

            <p><strong>Pending Timesheets for:</strong></p>
            <ul>
                @foreach ($pendingTimesheetDates as $date)
                    <li>{{ $date }}</li>
                @endforeach
            </ul>

            <p>Your prompt attention to this matter is greatly appreciated.</p>

            <p>Thank you for your cooperation.</p>

            <p>Best regards,<br>
            <span class="tms">TMS</span></p>
        </div>
        <div class="footer">
            <p>&copy; {{ date('Y') }} <span class="tms">TMS</span>. All rights reserved.</p>
        </div>
    </div>
</body>
</html>
