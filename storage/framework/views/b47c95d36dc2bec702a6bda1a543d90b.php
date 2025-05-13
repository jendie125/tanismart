

<?php $__env->startSection('content'); ?>

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

        /* Cart Card */
        .cart-card {
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

        /* Empty Cart */
        .empty-cart {
            text-align: center;
            padding: 30px;
        }

        /* Cart Items */
        .cart-items {
            margin-bottom: 20px;
        }

        .cart-item {
            display: flex;
            align-items: center;
            padding: 15px 0;
            border-bottom: 1px solid #eee;
        }

        .item-checkbox {
            width: 5%;
            text-align: center;
        }

        .item-image {
            width: 10%;
            padding: 0 10px;
        }

        .item-image img {
            width: 100%;
            max-width: 80px;
            height: auto;
            border-radius: 4px;
        }

        .item-details {
            width: 30%;
            padding: 0 10px;
        }

        .item-details h5 {
            margin-bottom: 5px;
            font-size: 16px;
        }

        .variant-info {
            margin-bottom: 0;
            font-size: 14px;
            color: #6c757d;
        }

        .variant-value {
            font-weight: 500;
        }

        .item-price {
            width: 15%;
            padding: 0 10px;
        }

        .item-quantity {
            width: 15%;
            padding: 0 10px;
        }

        .quantity-control {
            display: flex;
            align-items: center;
            width: 100%;
            max-width: 120px;
        }

        .quantity-input {
            width: 40px;
            text-align: center;
            border-radius: 0;
            height: 32px;
            padding: 0;
        }

        .quantity-btn {
            border: 1px solid #ced4da;
            background-color: #f8f9fa;
            height: 32px;
            width: 32px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
            padding: 0;
        }

        .minus-btn,
        .plus-btn {
            font-size: 16px;
            line-height: 1;
        }

        .item-total {
            width: 15%;
            padding: 0 10px;
            font-weight: 500;
            color: #28a745;
        }

        .item-actions {
            width: 10%;
            text-align: center;
        }

        .delete-item {
            color: #dc3545;
            font-size: 18px;
            cursor: pointer;
        }

        /* Cart Footer */
        .cart-footer {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding-top: 15px;
        }

        .selection-count {
            font-size: 16px;
            font-weight: 500;
        }

        .checkout-section {
            display: flex;
            align-items: center;
            gap: 20px;
        }

        .total-price {
            font-size: 16px;
            font-weight: 500;
        }

        .total-price span {
            color: #28a745;
            font-size: 18px;
            font-weight: bold;
        }

        .btn-checkout {
            background-color: #28a745;
            color: white;
            font-weight: 600;
            padding: 8px 20px;
            border-radius: 6px;
        }

        .btn-checkout:hover {
            background-color: #218838;
            color: white;
        }
    </style>

    <div class="container content-container">
        <div class="cart-card">
            <div class="cart-header">
                <div class="store-label">
                    <i class="fas fa-store"></i>
                    TokoTani | Troli
                </div>
            </div>

            <?php if(empty($cart)): ?>
                <div class="empty-cart">
                    <p>Keranjang belanja Anda kosong.</p>
                    <a href="<?php echo e(url('dashboard#tokotani')); ?>" class="btn btn-success">Belanja Sekarang</a>
                </div>
            <?php else: ?>
                <!-- Cart Items -->
                <div class="cart-items">
                    <?php $__currentLoopData = $cart; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php
                            // Find the product from the $produk collection
                            $product = $produk->firstWhere('idproduk', $item['idproduk']);
                        ?>
                        <div class="cart-item">
                            
                            <div class="item-image">
                                <img src="<?php echo e(asset('uploads/' . $product->gambar ?? 'default.jpg')); ?>"
                                    alt="<?php echo e($product->namaproduk); ?>">
                            </div>
                            <div class="item-details">
                                <h5><?php echo e($product->namaproduk); ?></h5>
                                <p class="variant-info">
                                    Variasi: <span class="variant-value"><?php echo e($item['variant'] ?? 'Standard'); ?></span>
                                </p>
                            </div>
                            <div class="item-price">
                                <p>Rp <?php echo e(number_format($item['price'], 0, ',', '.')); ?></p>
                            </div>
                            <div class="item-quantity">
                                <div class="quantity-control">
                                    <button class="btn btn-sm quantity-btn minus-btn"
                                        onclick="updateQuantity(<?php echo e($item['idproduk']); ?>, -1, '<?php echo e($item['variant']); ?>')">-</button>
                                    <input type="text" class="form-control quantity-input"
                                        value="<?php echo e($item['quantity']); ?>" min="1"
                                        data-product-id="<?php echo e($item['idproduk']); ?>" data-variant="<?php echo e($item['variant']); ?>"
                                        readonly>
                                    <button class="btn btn-sm quantity-btn plus-btn"
                                        onclick="updateQuantity(<?php echo e($item['idproduk']); ?>, 1, '<?php echo e($item['variant']); ?>')">+</button>
                                </div>
                            </div>
                            <div class="item-total"
                                id="total-<?php echo e($item['idproduk']); ?>-<?php echo e(str_replace(' ', '_', $item['variant'])); ?>">
                                Rp <?php echo e(number_format($item['price'] * $item['quantity'], 0, ',', '.')); ?>

                            </div>
                            <div class="item-actions">
                                <a href="<?php echo e(url('keranjang/hapus/' . $item['idproduk'] . '?variant=' . urlencode($item['variant']))); ?>"
                                    class="delete-item">
                                    <i class="fas fa-trash-alt"></i>
                                </a>
                            </div>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>

                <!-- Cart Footer -->
                <div class="cart-footer">
                    <div class="selection-info">
                        <div class="selection-count">
                            Pilih semua (<?php echo e(count(array_filter($cart, fn($item) => $item['selected'] ?? false))); ?>)
                        </div>
                    </div>
                    <div class="checkout-section">
                        <div class="total-price">
                            Total (<?php echo e(count(array_filter($cart, fn($item) => $item['selected'] ?? false))); ?> produk):
                            <span id="cart-total">Rp <?php echo e(number_format($total, 0, ',', '.')); ?></span>
                        </div>
                        <a href="<?php echo e(url('checkout')); ?>" class="btn btn-checkout">Checkout</a>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </div>

    <script>
        // Function to update quantity
        function updateQuantity(productId, change, variant) {
            const inputElement = document.querySelector(
                `.quantity-input[data-product-id="${productId}"][data-variant="${variant}"]`
            );
            let currentQty = parseInt(inputElement.value);

            if (!isNaN(currentQty)) {
                let newQty = currentQty + change;
                if (newQty > 0) {
                    inputElement.value = newQty;

                    // Debugging log
                    console.log(`Updating productId: ${productId}, quantity: ${newQty}, variant: ${variant}`);

                    // Send AJAX request to update cart
                    const xhr = new XMLHttpRequest();
                    xhr.open('POST', '<?php echo e(url('keranjang/update')); ?>', true);
                    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
                    xhr.onreadystatechange = function() {
                        if (xhr.readyState === 4 && xhr.status === 200) {
                            // Update total price
                            document.getElementById(`total-${productId}-${variant.replace(/ /g, '_')}`).innerText = xhr
                                .responseText;
                            updateCartTotal();
                        }
                    };
                    xhr.send(
                        `product_id=${productId}&quantity=${newQty}&variant=${encodeURIComponent(variant)}`
                    );
                }
            }
        }


        // Function to update total price
        function updateCartTotal() {
            const xhr = new XMLHttpRequest();
            xhr.open('GET', '<?php echo e(url('keranjang/total')); ?>', true);
            xhr.onreadystatechange = function() {
                if (xhr.readyState === 4 && xhr.status === 200) {
                    document.getElementById('cart-total').innerText = xhr.responseText;
                }
            };
            xhr.send();
        }
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.home', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\Laravel Project\tanismart-laravel\resources\views/keranjang.blade.php ENDPATH**/ ?>