<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Leave Application</title>
</head>

<body>
    <h3>Hello, {{$mailData['name']}}</h3>

    @if($mailData['status'] == 'ACCEPTED')
    <p style="color: green; font-size:16px; font-weight: bold;">Congratulations! Your Leave Application has been <strong>{{$mailData['status']}}</strong>.</p>
    <p>
        <strong>Accepted By:</strong> {{$mailData['acceptedBy']}}<br>
        <strong>Leave Duration:</strong> {{$mailData['leaveDuration']}}<br>
        <strong>Leave Start Date:</strong> {{$mailData['acceptLeaveFrom']}}<br>
        <strong>Leave End Date:</strong> {{$mailData['acceptLeaveTo']}}<br>
        <strong>Leave Type:</strong> {{$mailData['leaveType']}}<br>
        <strong>Comment:</strong> {{$mailData['reviewComment']}}<br>
    </p>
    @elseif($mailData['status'] == 'REJECTED')
    <p style="color: red; font-size:16px; font-weight: bold;">We regret to inform you that your Leave Application has been <strong>{{$mailData['status']}}</strong>.</p>
    <p>
        <strong>Rejected By:</strong> {{$mailData['acceptedBy']}}<br>
        <strong>Reason for Rejection:</strong> {{$mailData['reviewComment']}}<br>
    </p>
    @else
    <p>We are currently processing your Leave Application. Please check back for updates.</p>
    @endif

    <h3>Thank you,</h3>
    <h3>{{$mailData['companyName']}}</h3>
    <span style="color: gray;">Note: This is an automated email. Please do not reply to this email.</span>
</body>

</html>