<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <tr>
        <td>Dear {{$name}}</td>
    </tr>
    <tr>
        <td>&nbsp;</td>
    </tr>
    <tr>
        <td>Please click on below link to confirm your Vendor Account :-</td>
    </tr>
    <tr>
        <td><a href="{{url('vendor/confirm/'.$code)}}">{{url('vendor/confirm/'.$code)}}</a></td>
    </tr>
    <tr>
        <td>&nbsp;</td>
    </tr>
    <tr>
        <td>Thanks & Regards,</td>
    </tr>
    <tr>
        <td>Stack Developers</td>
    </tr>
    <tr>
        <td></td>
    </tr>
    <tr>
        <td></td>
    </tr>
    <tr>
        <td></td>
    </tr>
</body>

</html>