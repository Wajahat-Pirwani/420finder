<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Customer Email</title>
</head>

<body>

    <table style="width:100%;border-collapse:collapse;border-spacing:0;margin-top:0;margin-bottom:0;padding:0"
        cellspacing="0" cellpadding="0">
        <tbody>
            <tr style="margin-top:0;margin-bottom:0;padding:0">
                <td style="margin-top:0;margin-bottom:0;padding:0;border:0">
                    <table
                        style="width:100%;border-collapse:collapse;border-spacing:0;margin-top:0;margin-bottom:0;padding:0"
                        cellspacing="0" cellpadding="0">
                        <tbody>
                            <tr style="margin-top:0;margin-bottom:0;padding:0">
                                <td style="margin-top:0;margin-bottom:0;padding:0;border:0">
                                    <center>
                                        <table
                                            style="width:100%;border-collapse:initial;border-spacing:0;max-width:470px;text-align:left;border-radius:8px;margin:32px auto 0;padding:0 20px;border:1px solid #c9cccf"
                                            cellspacing="0" cellpadding="0">

                                            <tbody>
                                                <tr style="margin-top:0;margin-bottom:0;padding:0">
                                                    <td style="margin-top:0;margin-bottom:0;padding:0;border:0">

                                                        <table
                                                            style="width:100%;border-collapse:initial!important;border-spacing:0;margin-top:0;margin-bottom:0;padding:20px 4px"
                                                            cellspacing="0" cellpadding="0">
                                                            <tbody>
                                                                <tr style="margin-top:0;margin-bottom:0;padding:0">
                                                                    <td
                                                                        style="margin-top:0;margin-bottom:0;padding:0;border:0">
                                                                        <center>
                                                                            <table
                                                                                style="width:100%;border-collapse:collapse;border-spacing:0;margin-top:0;margin-bottom:0;padding:0"
                                                                                cellspacing="0" cellpadding="0">
                                                                                <tbody>
                                                                                    <tr
                                                                                        style="margin-top:0;margin-bottom:0;padding:0">
                                                                                        <td
                                                                                            style="margin-top:0;margin-bottom:0;padding:0;border:0">

                                                                                            <b
                                                                                                style="color:#202223;font-weight:600;font-size:16px">Order
                                                                                                summary</b>
                                                                                            <br>
                                                                                            <br>


                                                                                            <table
                                                                                                style="width:100%;border-collapse:collapse;border-spacing:0;margin-top:0;margin-bottom:0;padding:0"
                                                                                                cellspacing="0"
                                                                                                cellpadding="0">

                                                                                                <tbody>
                                                                                                    @foreach ($products
                                                                                                    as $product)
                                                                                                    <tr
                                                                                                        style="margin-top:0;margin-bottom:0;width:100%;padding:0">
                                                                                                        <td
                                                                                                            style="margin-top:0;margin-bottom:0;padding:0 0 20px;border:0">
                                                                                                            <table
                                                                                                                style="width:100%;border-collapse:collapse;border-spacing:0;margin-top:0;margin-bottom:0;padding:0"
                                                                                                                cellspacing="0"
                                                                                                                cellpadding="0">
                                                                                                                <tbody>

                                                                                                                    <tr>
                                                                                                                        <td
                                                                                                                            style="margin-top:0;margin-bottom:0;padding:0;border:0">

                                                                                                                            <img style="height:50px;line-height:0;outline:none;text-decoration:none;vertical-align:top;width:50px;margin-right:16px;border-radius:4px;border:1px solid #c9cccf"
                                                                                                                                src="{{ $product->image }}"
                                                                                                                                width="60"
                                                                                                                                height="60"
                                                                                                                                align="left">
                                                                                                                        </td>
                                                                                                                        <td
                                                                                                                            style="margin-top:0;margin-bottom:0;width:100%;padding:0;border:0">
                                                                                                                            <span
                                                                                                                                style="font-size:14px;line-height:1.42;color:#202223">
                                                                                                                                {{ $product->name }}
                                                                                                                            </span><br>
                                                                                                                            <span>$
                                                                                                                                {{ $product->price }}
                                                                                                                                ×
                                                                                                                                {{ $product->qty }}
                                                                                                                            </span><br>
                                                                                                                        </td>
                                                                                                                        <td
                                                                                                                            style="margin-top:0;margin-bottom:0;white-space:nowrap;padding:0;border:0">
                                                                                                                            <p style="color:#202223;line-height:20px;font-weight:400;margin:0 0 0 16px;padding:0"
                                                                                                                                align="right">
                                                                                                                                $
                                                                                                                                {{ $product->price }}
                                                                                                                            </p>
                                                                                                                        </td>
                                                                                                                    </tr>
                                                                                                                </tbody>
                                                                                                            </table>
                                                                                                        </td>
                                                                                                    </tr>
                                                                                                    @endforeach

                                                                                                </tbody>
                                                                                            </table>

                                                                                            <table
                                                                                                style="width:100%;border-collapse:collapse;border-spacing:0;margin-top:0;margin-bottom:0;padding:0"
                                                                                                cellspacing="0"
                                                                                                cellpadding="0">

                                                                                                <tbody>
                                                                                                    <tr
                                                                                                        style="margin-top:0;margin-bottom:0;padding:0">
                                                                                                        <td
                                                                                                            style="margin-top:0;margin-bottom:0;font-weight:bold;padding:20px 0 0;border:0">
                                                                                                            <p
                                                                                                                style="color:#202223;line-height:1.42em;margin:0;padding:0">

                                                                                                                <span>Total</span>
                                                                                                            </p>
                                                                                                        </td>
                                                                                                        <td style="margin-top:0;margin-bottom:0;font-weight:bold;padding:20px 0 0;border:0"
                                                                                                            align="right">
                                                                                                            $
                                                                                                            {{ $products->sum('price') }}
                                                                                                        </td>
                                                                                                    </tr>
                                                                                                </tbody>
                                                                                            </table>

                                                                                            <!-- Retailer Info -->
                                                                                            <div
                                                                                                style="margin-top: 2rem;">
                                                                                                <div
                                                                                                    style="font-weight: bold;                                                                                   border-bottom: 1px solid #ccc;padding-bottom: 0.5rem; display: inline-block;padding-right: 0.3rem;">
                                                                                                    <span>Retailer
                                                                                                        Details</span>
                                                                                                </div>
                                                                                                <div>
                                                                                                    <p
                                                                                                        style="margin: 0.8rem 0 0;">
                                                                                                        <span>
                                                                                                            Business
                                                                                                            Name:
                                                                                                        </span> <span
                                                                                                            style="color: #4b4b4b;">
                                                                                                            {{ $retailerDetails->business_name }}
                                                                                                        </span>
                                                                                                    </p>
                                                                                                    <p
                                                                                                        style="margin: 0.8rem 0 0;">
                                                                                                        <span>
                                                                                                            Business
                                                                                                            Type:
                                                                                                        </span>
                                                                                                        <span
                                                                                                            style="color: #4b4b4b;">
                 {{ $retailerDetails->business_type }}                                                                         </span>

                 <span>
                    Email:
                </span>
                <span
                    style="color: #4b4b4b;">
{{ $retailerDetails->email }}                                                                         </span>
<span>
    Phone Number:
</span>
<span
    style="color: #4b4b4b;">
{{ $retailerDetails->phone_number }} </span>

<span>
    Country:
</span>
<span
    style="color: #4b4b4b;">
{{ $retailerDetails->country }} </span>

<span>
    City:
</span>
<span
    style="color: #4b4b4b;">
{{ $retailerDetails->city }} </span>

<span>
    State / Province:
</span>
<span
    style="color: #4b4b4b;">
{{ $retailerDetails->state_province }} </span>

<span>
    Address:
</span>
<span
    style="color: #4b4b4b;">
{{ $retailerDetails->address_line_1 }} </span>

     </p>
                                                                                                </div>
                                                                                            </div>
                                                                                            <!-- Retailer Info Ends -->

                                                                                        </td>
                                                                                    </tr>
                                                                                </tbody>
                                                                            </table>
                                                                    </td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                    </center>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </td>
            </tr>
        </tbody>
    </table>
    </center>
    </td>
    </tr>
    </tbody>
    </table>

    <br>
    <img style="height:auto;line-height:0;outline:none;text-decoration:none;vertical-align:top;border:0;
display: block;
width: 150px;
margin: 0 auto;" src="{{ $logo }}" height="1"></td>
    </tr>
    </tbody>
    </table>

</body>

</html>
