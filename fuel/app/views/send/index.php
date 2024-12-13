<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            margin: 0;
            padding: 0;
            background-color: #f4f4f9;
        }
    </style>
</head>
<body>
<div class="email-container">
    <div class="email-header">
        <h1>Cảm ơn bạn đã đặt hàng!</h1>
    </div>
    <div class="email-body">
        <p>Chào <strong><?= $customer_name ?></strong>,</p>
        <p>Cảm ơn bạn đã đặt hàng tại <strong><?= $shop_name ?></strong>. Dưới đây là thông tin đơn hàng của bạn:</p>

        <table class="order-details">
            <thead>
            <tr>
                <th>Sản phẩm</th>
                <th>Số lượng</th>
                <th>Đơn giá</th>
                <th>Thành tiền</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($order_items as $item): ?>
                <tr>
                    <td><?= $item['name'] ?></td>
                    <td><?= $item['quantity'] ?></td>
                    <td><?= number_format($item['price'], 0, ',', '.') ?> VND</td>
                    <td><?= number_format($item['quantity'] * $item['price'], 0, ',', '.') ?> VND</td>
                </tr>
            <?php endforeach; ?>
            </tbody>
            <tfoot>
            <tr>
                <th colspan="3" style="text-align: right;">Tổng cộng:</th>
                <th><?= number_format($total_price, 0, ',', '.') ?> VND</th>
            </tr>
            </tfoot>
        </table>

        <p>Địa chỉ giao hàng: <strong><?= $delivery_address ?></strong></p>
        <p>Dự kiến giao hàng: <strong><?= $delivery_date ?></strong></p>
    </div>
</div>
</body>
</html>
