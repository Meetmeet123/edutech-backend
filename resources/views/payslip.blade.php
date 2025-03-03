<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title>Invoice</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;700&display=swap" rel="stylesheet" />
    <style>
        .wrapper {
            display: grid;
            grid-template-columns: 2fr 3fr 2fr;
            font-size: 12px;
            padding: 10px 0;
            width: 800px;
            max-width: 90%;
            margin: 0 auto;
            grid-auto-rows: minmax(70px, auto);
        }

        .wrapper>div {
            padding: 0.6em;
        }

        .box1 {
            grid-column: 1;
            grid-row: 1;
            align-items: center;
            justify-content: center;
        }

        .box2 {
            grid-column: 2;
            grid-row: 1;
            text-align: center;
        }

        .box3 {
            grid-column: 3;
            grid-row: 1;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .box4 {
            grid-column: 1/4;
            grid-row: 2;
            text-align: center;
        }

        .box5 {
            grid-column: 1/2;
            grid-row: 3;
        }

        .box6 {
            grid-column: 3/4;
            grid-row: 3;
        }

        .box7 {
            justify-content: stretch;
            grid-column: 1/4;
            grid-row: 4;
        }

        .box77 {
            justify-content: stretch;
            grid-column: 1/4;
            grid-row: 5;
        }

        .box9 {
            grid-column: 3/4;
            grid-row: 6;
        }

        .box10 {
            grid-column: 3/4;
            grid-row: 10;
        }

        .box11 {
            grid-column: 1/2;
            grid-row: 10;
        }

        .box12 {
            grid-column: 1/4;
            grid-row: 11;
            text-align: center;
        }

        .box13 {
            grid-column: 1/3;
            grid-row: 6;
        }

        .box14 {
            grid-column: 1/4;
            grid-row: 8;
        }

        .footer {
            position: fixed;
            left: 180;
            bottom: 0;
            text-align: center;
            width: 800px;
            max-width: 90%;
        }

        body {
            font-family: "Inter", sans-serif;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        table.table1,
        table.table1 th,
        table.table1 td {
            border: 1px solid silver;
        }

        table.table1 th {
            text-align: left;
        }

        table.table1 td {
            text-align: right;
            padding: 5px;
        }

        /* table.table1 tr:nth-child(even) {
            background-color: #f2f2f2;
        } */

        table.table2 {
            border-collapse: collapse;
            width: 100%;
        }

        table.table2 th,
        table.table2 td {
            padding: 8px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        table.table3 {
            border-collapse: collapse;
            width: 100%;
        }

        table.table3 th {
            padding: 8px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        table.table3 td {
            padding: 8px;
            text-align: right;
            border-bottom: 1px solid #ddd;
        }

        hr.hr1 {
            border-top: 1px dotted rgb(63, 63, 63);
        }
    </style>
</head>

<body>
    <div class="wrapper">

        <div class="box1">

            <h1>{{ $mailData['companyName'] ?? " " }}</h1>
            <p>Address: {{ $mailData['companyAddress'] ?? " " }}</p>
            <p>Email: {{ $mailData['companyEmail'] ?? " " }}</p>
        </div>

        <div class="box4">
            <hr class="hr1">
            <h3 class="center">SALARY PAYSLIP</h3>
            <hr class="hr1">
        </div>

        <div class="box5">
            <table class="table2">
                <tr>
                    <th>Employee ID</th>
                    <td>{{ $mailData['employeeId'] ?? " " }}</td>
                </tr>
                <tr>
                    <th>Employee Name</th>
                    <td>{{ $mailData['username'] ?? " " }}</td>
                </tr>
                <tr>
                    <th>Email</th>
                    <td>{{ $mailData['userEmail'] ?? " "  }}</td>
                </tr>
                <tr>
                    <th>Mobile</th>
                    <td>{{ $mailData['userPhone'] ?? " "  }}</td>
                </tr>
                <tr>
                    <th>Salary</th>
                    <td>{{ $mailData['salary'] ?? 0  }}</td>
                </tr>
                <tr>
                    <th>Work Day</th>
                    <td>{{ $mailData['workDay'] ?? 0 }}</td>
                </tr>
                <tr>
                    <th>Work Hours</th>
                    <td>{{ $mailData['workingHour'] ?? 0 }}</td>
                </tr>
            </table>
        </div>

        <div class="box6">
            <table class="table2">
                <tr>
                    <th>Payslip for</th>
                    <td>{{ $mailData['paySlipFor'] ?? " " }}</td>
                </tr>
                <tr>
                    <th>Created At</th>
                    <td>{{ $mailData['createdAt'] ?? " " }}</td>
                </tr>
                <tr>
                    <th>Status</th>
                    <td><span style="font-weight: bold; font-size: 16px;">{{ $mailData['status'] ?? " " }}</span></td>
                </tr>
            </table>
        </div>

        <div class="box7">
            <h1>Earnings</h1>
            <table class="table1">
                <tr>
                    <th>Salary Payable</th>
                    <td>{{ $mailData['salaryPayable'] ?? 0 }}</td>
                </tr>
                <tr>
                    <th>Bonus</th>
                    <td>{{ $mailData['bonus'] ?? 0 }}</td>
                </tr>
                <tr>
                    <th>Total Earning</th>
                    <td>{{ (isset($mailData['salaryPayable']) ? $mailData['salaryPayable'] : 0) + (isset($mailData['bonus']) ? $mailData['bonus'] : 0) }}</td>
                </tr>
            </table>
        </div>

        <div class="box77">
            <h1>Deductions</h1>
            <table class="table1">
                <tr>
                    <th>Deduction</th>
                    <td>{{ $mailData['deduction'] ?? 0 }}</td>
                </tr>
                <tr>
                    <th>Total Deductions</th>
                    <td>{{ $mailData['deduction'] ?? 0 }}</td>
                </tr>
            </table>
        </div>

        <div class="box13"></div>
        <div class="box9">
            <table class="table3">
                <tr>
                    <th>Total Earnings</th>
                    <td>{{ (isset($mailData['salaryPayable']) ? $mailData['salaryPayable'] : 0) + (isset($mailData['bonus']) ? $mailData['bonus'] : 0) }}</td>
                </tr>
                <tr>
                    <th>Total Deductions</th>
                    <td>{{ $mailData['deduction'] ?? 0 }}</td>
                </tr>
                <tr>
                    <th>Total Payable Salary</th>
                    <td><span style="font-weight: bold; font-size: 16px;">{{ $mailData['totalPayable'] ?? 0 }}</span></td>
                </tr>
            </table>
        </div>

        <div class="box10">
            <hr>
            <p>Accountant</p>
        </div>

        <div class="box11">
            <hr>
            <p>Authorized By</p>
        </div>

        <div class="box12">
            <hr>
            <p>Powered by OMEGA SOLUTION | Contact: 018********</p>
        </div>
    </div>
</body>

</html>