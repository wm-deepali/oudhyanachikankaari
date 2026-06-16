<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
</head>
<body>

<h2>
    Thank You For Your Order
</h2>

<p>
    Hello {{ $order->customer_name }},
</p>

<p>
    Your order has been received successfully.
</p>

<p>
    <strong>Order Number:</strong>
    {{ $order->order_number }}
</p>

<p>
    <strong>Payment Method:</strong>
    {{ strtoupper($order->payment_method) }}
</p>

<p>
    <strong>Grand Total:</strong>
    ₹{{ number_format($order->grand_total, 2) }}
</p>

<p>
    We will notify you once your order is shipped.
</p>

</body>
</html>