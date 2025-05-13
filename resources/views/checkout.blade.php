@extends('layouts.home')
@section('content')
    <style>
        /* Navbar */
        .navbar {
            background-color: #1a2a3a !important;
        }

        .navbar-brand {
            font-size: 1.5rem;
            font-weight: bold;
        }

        .navbar-brand span {
            color: #3cb371;
        }

        .navbar .nav-link {
            color: #fff !important;
            font-weight: 500;
            font-size: 1rem;
        }

        .navbar .nav-link:hover {
            color: #3cb371 !important;
        }

        /* Content Container */
        .content-container {
            margin-top: 90px;
            margin-bottom: 30px;
        }

        /* Checkout Card */
        .checkout-card {
            background: #fff;
            border-radius: 12px;
            padding: 20px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        /* Store Label */
        .store-label {
            font-size: 22px;
            font-weight: bold;
            color: #28a745;
            display: flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 15px;
            border-bottom: 1px solid #eee;
            padding-bottom: 10px;
        }

        .store-label i {
            color: #28a745;
            font-size: 24px;
        }

        /* Checkout Items */
        .checkout-items {
            margin-bottom: 30px;
        }

        .product-thumbnail {
            width: 70px;
            height: 70px;
            object-fit: cover;
            border-radius: 4px;
        }

        .product-info {
            font-weight: 500;
        }

        .variant-info {
            font-size: 14px;
            color: #6c757d;
            margin-top: 5px;
        }

        .variant-value {
            font-weight: 500;
        }

        .variant-size {
            margin-left: 5px;
        }

        /* Payment Section */
        .payment-section {
            margin-top: 30px;
        }

        .payment-section h5 {
            margin-bottom: 15px;
            font-weight: 600;
        }

        .payment-options {
            display: flex;
            gap: 20px;
            margin-bottom: 30px;
        }

        .payment-option {
            padding: 15px;
            border: 1px solid #ddd;
            border-radius: 8px;
            cursor: pointer;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
        }

        .payment-option:hover,
        .payment-option.active {
            border-color: #28a745;
            background-color: #f8fff8;
        }

        .payment-option input {
            margin-right: 8px;
        }

        /* Order Summary */
        .summary-box {
            background-color: #f9f9f9;
            border-radius: 8px;
            padding: 20px;
            margin-top: 20px;
        }

        .summary-row {
            display: flex;
            justify-content: space-between;
            margin-bottom: 10px;
        }

        .summary-label {
            font-weight: 500;
        }

        .summary-value {
            font-weight: 600;
        }

        .total-value {
            color: #28a745;
            font-size: 18px;
        }

        .btn-place-order {
            width: 100%;
            margin-top: 15px;
            padding: 10px;
            font-weight: 600;
        }
    </style>

    <div class="container content-container">
        <div class="checkout-card">
            <div class="checkout-header">
                <div class="store-label">
                    <i class="fas fa-store"></i>
                    TokoTani | Checkout
                </div>
            </div>

            <!-- Checkout Items -->
            <div class="checkout-items">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Produk yang dibeli</th>
                            <th>Harga Satuan</th>
                            <th>Jumlah</th>
                            <th>Subtotal Produk</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $total_price = 0;
                        ?>
                        <?php foreach ($cart as $item): ?>
                        <?php $total_price += $item['price'] * $item['quantity']; ?>
                        @php
                            // Find the product from the $produk collection
                            $product = $produk->firstWhere('idproduk', $item['idproduk']);
                        @endphp
                        <tr>
                            <td>
                                <div class="d-flex align-items-center">
                                    <img src="uploads/<?= htmlspecialchars($product->gambar ?? 'default.jpg') ?>"
                                        alt="<?= htmlspecialchars($product->namaproduk) ?>" class="product-thumbnail">
                                    <div class="product-info ms-3">
                                        <?= htmlspecialchars($product->namaproduk) ?>
                                        <div class="variant-info">
                                            Variasi:
                                            <span
                                                class="variant-value"><?= htmlspecialchars($item['variant'] ?? 'Standard') ?></span>
                                            <?php if (isset($item['variant_size'])): ?>
                                            <span class="variant-size"><?= htmlspecialchars($item['variant_size']) ?></span>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>
                            </td>
                            <td>Rp <?= number_format($item['price'], 0, ',', '.') ?></td>
                            <td><?= $item['quantity'] ?></td>
                            <td>Rp <?= number_format($item['price'] * $item['quantity'], 0, ',', '.') ?></td>
                        </tr>
                        <?php endforeach; ?>
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="3" class="text-end">Total Pesanan (<?= count($cart) ?> Produk):</td>
                            <td><strong>Rp<?= number_format($total_price, 0, ',', '.') ?></strong></td>
                        </tr>
                    </tfoot>
                </table>
            </div>

            <!-- Payment Method Selection -->
            <div class="payment-section">
                <h5>Metode Pembayaran</h5>
                <form action="{{ url('checkoutsimpan') }}" method="post" id="checkoutForm">
                    <div class="payment-options">
                        <div class="form-check payment-option">
                            <input class="form-check-input" type="radio" name="payment_method" id="cod"
                                value="COD" checked>
                            <label class="form-check-label" for="cod">COD</label>
                        </div>
                        <div class="form-check payment-option">
                            <input class="form-check-input" type="radio" name="payment_method" id="transfer"
                                value="Transfer Bank">
                            <label class="form-check-label" for="transfer">Transfer Bank</label>
                        </div>
                        <div class="form-check payment-option">
                            <input class="form-check-input" type="radio" name="payment_method" id="qris"
                                value="QRIS">
                            <label class="form-check-label" for="qris">QRIS</label>
                        </div>
                    </div>

                    <!-- Order Summary -->
                    <div class="order-summary">
                        <div class="row">
                            <div class="col-12 col-md-6 offset-md-6">
                                <div class="summary-box">
                                    <div class="summary-row">
                                        <span class="summary-label">Subtotal untuk Produk:</span>
                                        <span class="summary-value">Rp
                                            <?= number_format($total_price, 0, ',', '.') ?></span>
                                    </div>
                                    <div class="summary-row">
                                        <span class="summary-label">Total Pembayaran:</span>
                                        <span class="summary-value total-value">Rp
                                            <?= number_format($total_price, 0, ',', '.') ?></span>
                                    </div>
                                    <button type="submit" name="submit_order" class="btn btn-success btn-place-order">Buat
                                        Pesanan</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
