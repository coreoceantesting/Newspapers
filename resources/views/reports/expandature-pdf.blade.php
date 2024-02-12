<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Document</title>
        <style>
            table {
                border-collapse: collapse;
                width: 100%;
            }

            th, td {
                padding: 4px;
                border: 1px solid #000;
            }
            .centerTd td{
                text-align: center;
                font-size: 10px;
            }

            /* tr:nth-child(even){background-color: #f2f2f2} */
            body {
                font-family: 'freeserif', 'normal';
            }
            .smallFont{
                font-size: 10px;
            }
            .dataTd td{
                font-size: 10px;
            }
        </style>
    </head>
    <body>
        <div>
            <table>
                <tbody>
                    <tr>
                        <td align="left" class="smallFont" colspan="3">Name of Account head :- {{ $department }}<br>
                            (जाहिर निवीद्धा सुचाना प्रसिध्दी पत्र छपाई करणे)</td>
                        <th align="center" colspan="7" rowspan="3"><h2>PANVEL MUNCIPAL, CORPORATION EXPENDITURE CONTROL REGISTER</h2></th>
                        <td align="left" class="smallFont" colspan="4">Amount Of Work Order:- </td>
                    </tr>
                    <tr>
                        <td align="left" class="smallFont" colspan="3">Budget Provision Rs:- {{ $financialYear?->budgetProvision?->budget }}</td>
                        <td align="left" class="smallFont" colspan="4">Name of contractor:- </td>
                    </tr>
                    <tr>
                        <td align="left" class="smallFont" colspan="3">Administrative Financial Approval Amount:- </td>
                        <td align="left" class="smallFont" colspan="4">Name of Work:- </td>
                    </tr>

                    <tr class="centerTd">
                        <td>Date</td>
                        <td>Voucher No</td>
                        <td>Name of party</td>
                        <td>Invoice Amount</td>
                        <td>Security Deposits</td>
                        <td>Delay Charges</td>
                        <td>Other Charges</td>
                        <td>Net Amount Payable</td>
                        <td>Prograssive Expenditure</td>
                        <td>Balance For Further Expenditure</td>
                        <td>Posted By</td>
                        <td>Verified By</td>
                        <td>Approved By</td>
                        <td>Remark</td>
                    </tr>
                    <tr class="centerTd">
                        <td></td>
                        <td></td>
                        <td></td>
                        <td>Rs.</td>
                        <td>Rs.</td>
                        <td>Rs.</td>
                        <td>Rs.</td>
                        <td>Rs.</td>
                        <td>Rs.</td>
                        <td>Rs.</td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr class="centerTd">
                        <td>1</td>
                        <td>2</td>
                        <td>3</td>
                        <td>4</td>
                        <td>5</td>
                        <td>6</td>
                        <td>7</td>
                        <td>8</td>
                        <td>9</td>
                        <td>10</td>
                        <td>11</td>
                        <td>12</td>
                        <td>13</td>
                        <td>14</td>
                    </tr>
                    @foreach($expendatures as $expendature)
                    <tr class="dataTd">
                        <td align="center">{{ $expendature->unique_no }}<br>{{ date('d-m-Y', strtotime($expendature->created_at)) }}</td>
                        <td></td>
                        <td align="center">{{ $expendature?->newsPaper?->name }}</td>
                        <td align="center">{{ $expendature->invoice_amount }}</td>
                        <td></td>
                        <td></td>
                        <td align="center">{{ $expendature->other_charges }}</td>
                        <td align="center">{{ $expendature->net_amount }}</td>
                        <td align="center">{{ $expendature->progressive_expandetures }}</td>
                        <td align="center">{{ $expendature->balance }}</td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    @endforeach
                </tbody>
              </table>
        </div>
    </body>
</html>
