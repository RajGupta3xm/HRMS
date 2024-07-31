<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>Invoice</title>
    <meta content="" name="description" />
    <meta content="" name="keywords" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;500;600;700;800&display=swap"
        rel="stylesheet">
        <style>
             ::-webkit-scrollbar{
                    width: 0px;
                }
        </style>
</head>

<body style="font-family: 'Poppins', sans-serif; margin: 0; padding: 0; background-color: #f5f5f5;">
    <div style="width: 60%; padding: 0; border-radius: 1rem; border: 1px solid #dee2e6; margin: 20px auto; height: 92vh; overflow-x: hidden; box-shadow: rgba(0, 0, 0, 0.24) 0px 3px 8px; position: relative; background-color: #fff;">
        <div style="width: 100%; height: 50px; padding: 0; background-color: #1A81FF; position: absolute; top: 0;"></div>
        <div style="overflow-y: scroll; height: calc(96% - 50px); padding: 1.5rem; padding-top: 60px;">
            <table style="width: 100%; margin: 0 auto; border: 0; border-spacing: 0;">
                <tr>
                    <td style="width: 33%; text-align: left; padding-top: 20px;">
                        <table style="width: 100%; margin: 0 auto; border: 0; border-spacing: 0;">
                            <tr>
                                <td style="font-size: 18px; color: #000;">TechGropse Pvt. Ltd.</td>
                            </tr>
                            <tr>
                                <td style="font-weight: 300;">H-146/147, Block-H</td>
                            </tr>
                            <tr>
                                <td style="font-weight: 300;">Sector-63</td>
                            </tr>
                            <tr>
                                <td style="font-weight: 300;">Noida-201307, India</td>
                            </tr>
                        </table>
                    </td>
                    <td style="width: 33%; text-align: left; padding-top: 20px;">
                        <table style="width: 100%; margin: 0 auto; border: 0; border-spacing: 0;">
                            <tr>
                                <td style="text-transform: uppercase;">+91 89550 08397</td>
                            </tr>
                            <tr>
                                <td style="text-transform: uppercase;">sales@techgropse.com</td>
                            </tr>
                            <tr>
                                <td style="text-transform: uppercase;">www.techgropse.com</td>
                            </tr>
                        </table>
                    </td>
                    <td style="width: 33%; text-align: right; padding-top: 20px;">
                        <table style="width: 100%; margin: 0 auto; border: 0; border-spacing: 0;">
                            <tr>
                                <td style="padding-bottom: 10px;">
                                    <img src="https://www.techgropse.com/common/images/menus/logo.png">
                                </td>
                            </tr>
                            <tr>
                                <td style="text-decoration: underline;">Bank Account Details</td>
                            </tr>
                            <tr>
                                <td style="font-size: 14px;">BANK NAME: <span style="font-weight: 300;">Kotak Mahindra Bank</span></td>
                            </tr>
                            <tr>
                                <td style="font-size: 14px;">ACCOUNT NUMBER: <span style="font-weight: 300;">0014316265</span></td>
                            </tr>
                            <tr>
                                <td style="font-size: 14px;">BENEFICIARY NAME: <span style="font-weight: 300;">TECHGROPSE PVT LTD</span></td>
                            </tr>
                            <tr>
                                <td style="font-size: 14px;">ADDRESS: <span style="font-weight: 300;">H-146/147, SECTOR 63, NOIDA - 201301</span></td>
                            </tr>
                            <tr>
                                <td style="font-size: 14px;">SWIFTCODE: <span style="font-weight: 300;">KKBKINBBXXX</span></td>
                            </tr>
                            <tr>
                                <td style="font-size: 14px;">IFSC CODE: <span style="font-weight: 300;">KKBK0000180</span></td>
                            </tr>
                        </table>
                    </td>
                </tr>
            </table>
            <div style="display: flex;white-space: nowrap;align-items: center;">
                <table style="margin: 0; border: 0; border-spacing: 0;width: 48%;margin: 40px auto;">
                <tr>
                    <td style="color:rgb(172, 150, 154);  font-size: 16px;"> BILLED TO</td>
                </tr>
                <tr>
                    <td style="font-size: 16px;line-height: 18px; color: #000; text-align: left; border-spacing: 0;">
                        {{ $submitInvoicesMergedArray['cilentname'] }}
                    </td>
                </tr>
                <tr>
                    <td style=" font-size: 24px;line-height: 26px;color: rgb(70, 104, 70); padding-top: 10px;">
                        Invoice</td>
                </tr>
                <tr>
                    <td style="color:rgb(172, 150, 154);  font-size: 14px;line-height: 18px; padding-top: 0px;">
                        INVOICE NUMBER</td>
                </tr>
                <tr>
                    <td style="color:rgb(79, 70, 72);  font-size: 14px;line-height: 16px;">
                        TGT {{ $submitInvoicesMergedArray['id'] }}</td>
                </tr>
                <tr>
                    <td style=" font-size: 14px;color:rgb(172, 150, 154); padding-top: 0px;line-height: 16px;">
                        DATE OF ISSUE</td>
                </tr>
                <tr>
                    <td style="color:rgb(79, 70, 72);  font-size: 16px;">
                        {{ $submitInvoicesMergedArray['Bill_Genrate_Date'] }}
                    </td>
                </tr>
                </table>
                <table style="width: 48%; margin: 20px auto; border: 0; border-spacing: 0; text-align: center; background-color: rgb(237, 239, 241);">
                    <thead>
                        <tr>
                            <th style="font-family: 'Poppins', sans-serif; font-size: 15px; text-align: center; color: white; padding: 10px 20px; background-color: #1A81FF; border-bottom: 0;text-align: center;">DESCRIPTION</th>
                            <th style="font-family: 'Poppins', sans-serif; font-size: 15px; text-align: center; color: white; padding: 10px 20px; background-color: #1A81FF; border-bottom: 0;text-align: center;">UNIT COST</th>
                            <th style="font-family: 'Poppins', sans-serif; font-size: 15px; text-align: center; color: white; padding: 10px 20px; background-color: #1A81FF; border-bottom: 0;text-align: center;">QTY</th>
                            <th style="font-family: 'Poppins', sans-serif; font-size: 15px; text-align: center; color: white; padding: 10px 20px; background-color: #1A81FF; border-bottom: 0;text-align: center;">AMOUNT</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr style="background-color: #fff;">
                            <td style="font-size: 11px; color: #000; text-align: start; padding: 10px 20px; border-bottom: 0;background: #f5f5f5;text-align: center;">Kick Off Payment</td>
                            <td style="font-size: 11px; color: #000; text-align: start; padding: 10px 20px; border-bottom: 0;background: #f5f5f5;text-align: center;"></td>
                            <td style="font-size: 11px; color: #000; text-align: start; padding: 10px 20px; border-bottom: 0;background: #f5f5f5;text-align: center;"></td>
                            <td style="font-size: 11px; color: #000; text-align: start; padding: 10px 20px; border-bottom: 0;background: #f5f5f5;text-align: center;"></td>
                        </tr>
                        <tr style="background-color: #fff;">
                            <td style="font-size: 11px; color: #000; text-align: start; padding: 10px 20px; border-bottom: 0;background: #f5f5f5;text-align: center;">Project Name:</td>
                            <td style="font-size: 11px; color: #000; text-align: start; padding: 10px 20px; border-bottom: 0;background: #f5f5f5;text-align: center;">USD {{ $submitInvoicesMergedArray['Quantity'] }}</td>
                            <td style="font-size: 11px; color: #000; text-align: start; padding: 10px 20px; border-bottom: 0;background: #f5f5f5;text-align: center;">{{ $submitInvoicesMergedArray['Price'] }}</td>
                            <td style="font-size: 11px; color: #000; text-align: start; padding: 10px 20px; border-bottom: 0;background: #f5f5f5;text-align: center;">USD {{ $submitInvoicesMergedArray['Amount'] }}</td>
                        </tr>
                        <tr style="background-color: #fff;">
                            <td style="font-size: 11px; color: #000; text-align: start; padding: 10px 20px; border-bottom: 0;background: #f5f5f5;text-align: center;">{{ $submitInvoicesMergedArray['projectname'] }}</td>
                            <td style="font-size: 11px; color: #000; text-align: start; padding: 10px 20px; border-bottom: 0;background: #f5f5f5;text-align: center;"></td>
                            <td style="font-size: 11px; color: #000; text-align: start; padding: 10px 20px; border-bottom: 0;background: #f5f5f5;text-align: center;"></td>
                            <td style="font-size: 11px; color: #000; text-align: start; padding: 10px 20px; border-bottom: 0;background: #f5f5f5;text-align: center;"></td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <table style="width: 100%; margin: 10px auto; border: 0; border-spacing: 0; text-align: right;">
                <tr>
                    <td style="text-align: right; border-spacing: 0; vertical-align: top; font-size: 16px; color: rgb(56, 54, 54);">SUB TOTAL : <span style="color: rgb(172, 150, 154);">USD {{ $submitInvoicesMergedArray['Amount'] }}</span></td>
                </tr>
                <tr>
                    <td style="text-align: right; border-spacing: 0; vertical-align: top; font-size: 16px; color: rgb(56, 54, 54);">DISCOUNT : <span style="color: rgb(172, 150, 154);">USD 0.00</span></td>
                </tr>
                <tr>
                    <td style="text-align: right; border-spacing: 0; vertical-align: top; font-size: 16px; color: rgb(56, 54, 54);">TAXES : <span style="color: rgb(172, 150, 154);">USD 0.00</span></td>
                </tr>
                <tr>
                    <td style="text-align: right; border-spacing: 0; vertical-align: top; font-size: 16px; color: rgb(56, 54, 54);" class="total">TOTAL AMOUNT : <span style="color: rgb(172, 150, 154);font-size: 18px; font-weight: bold; color: black;">USD {{ $submitInvoicesMergedArray['Amount'] }}</span></td>
                </tr>
                <tr>
                    <td style="text-align: right; border-spacing: 0; vertical-align: top; font-size: 16px; color: rgb(56, 54, 54);" class="amount-in-words">Amount in Words : <span style="color: rgb(172, 150, 154);">{{ $submitInvoicesMergedArray['TotalAmountInWord'] }}</span></td>
                </tr>
            </table>
        </div>
    </div>
</body>

</html>
