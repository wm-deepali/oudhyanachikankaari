<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
</head>
<body>

<h2>
    New Order Received
</h2>

<p>
    A new order has been placed on the website.
</p>

<p>
    <strong>Order Number:</strong>
    {{ $order->order_number }}
</p>

<p>
    <strong>Customer:</strong>
    {{ $order->customer_name }}
</p>

<p>
    <strong>Email:</strong>
    {{ $order->customer_email }}
</p>

<p>
    <strong>Phone:</strong>
    {{ $order->customer_phone }}
</p>

<p>
    <strong>Total:</strong>
    ₹{{ number_format($order->grand_total, 2) }}
</p>

</body>
</html>