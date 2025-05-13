@extends('layouts.home')

@section('content')
    <br><br>
    <div class="container content-container">
        <div class="product-card">
            <div class="row">
                <div class="col-md-4">
                    <div class="store-label">
                        <i class="fas fa-store"></i> TokoTani | Detail Produk
                    </div>
                    <img src="{{ asset('uploads/' . $produk->gambar) }}" id="product-image" class="product-image mt-2"
                        alt="{{ $produk->nama_produk }}">
                </div>
                <div class="col-md-8">
                    <h2 class="mt-2 fw-bold">{{ $produk->nama_produk }}</h2>
                    <p class="text-muted">{{ $produk->deskripsi }}</p>
                    <h3 class="price-tag" id="harga-produk"></h3>

                    <div class="mt-3">
                        <strong>Variasi:</strong>
                        @foreach ($produk->produkdetail as $v)
                            <button class="btn btn-outline-secondary variant-button"
                                onclick="updatePrice('{{ $v['namavariasi'] }}')">
                                {{ $v['namavariasi'] }}
                            </button>
                        @endforeach
                    </div>

                    <div class="mt-3">
                        <strong>Kuantitas:</strong>
                        <div class="quantity-control d-flex align-items-center">
                            <button type="button" class="btn btn-outline-secondary">-</button>
                            <input type="text" id="quantity" class="form-control text-center mx-2" value="1"
                                style="width: 50px;" readonly>
                            <button type="button" class="btn btn-outline-secondary">+</button>
                        </div>

                    </div>

                    <div class="action-buttons mt-3">
                        <a onclick="handleAction('cart')" class="btn btn-warning">Masukkan Keranjang </a>
                        {{-- <a onclick="handleAction('buy')" class="btn btn-success">Beli Sekarang</a> --}}
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Variant Not Selected Alert -->
    <div id="variantAlert" class="alert-modal d-none">
        <div class="alert-content">
            <h4><i class="fas fa-exclamation-circle text-warning"></i> Perhatian</h4>
            <p>Silakan pilih variasi produk terlebih dahulu</p>
            <button class="btn btn-warning" onclick="closeVariantAlert()">OK</button>
        </div>
    </div>

    <!-- Flying Image -->
    <div id="flyingImage" class="flying-image">
        <img src="" alt="Flying Product">
    </div>

    <script>
        let variasiHarga = @json($produk->produkdetail);
        let hargaDefault =
            "Rp {{ number_format($harga_min, 0, ',', '.') }} - Rp {{ number_format($harga_max, 0, ',', '.') }}";
        let selectedVariant = "";
        let selectedPrice = 0;
        const productId = {{ $produk->idproduk }};

        function updatePrice(variant) {
            let selected = variasiHarga.find(v => v.namavariasi === variant);
            if (selected) {
                document.getElementById("harga-produk").innerText = "Rp " + new Intl.NumberFormat('id-ID').format(selected
                    .harga);
                selectedVariant = selected.namavariasi;
                selectedPrice = selected.harga;

                // Ubah styling pada tombol variasi
                document.querySelectorAll('.variant-button').forEach(btn => {
                    if (btn.textContent.trim() === variant) {
                        btn.classList.add('active');
                        btn.classList.add('btn-success');
                        btn.classList.remove('btn-outline-secondary');
                    } else {
                        btn.classList.remove('active');
                        btn.classList.remove('btn-success');
                        btn.classList.add('btn-outline-secondary');
                    }
                });
            }
        }

        function updateQuantity(change) {
            let qty = document.getElementById("quantity");
            let value = parseInt(qty.value);
            if (!isNaN(value)) {
                let updated = value + change;
                // Pastikan nilai tidak kurang dari 1
                if (updated < 1) updated = 1;
                qty.value = updated;
            }
        }

        function showLoginModal() {
            document.getElementById("loginModal").classList.remove("d-none");
        }

        function closeLoginModal() {
            document.getElementById("loginModal").classList.add("d-none");
        }

        function showVariantAlert() {
            document.getElementById("variantAlert").classList.remove("d-none");
        }

        function closeVariantAlert() {
            document.getElementById("variantAlert").classList.add("d-none");
        }

        function createFlyingAnimation() {
            const productImg = document.getElementById('product-image');
            const cartIcon = document.querySelector('.fa-shopping-cart');
            const flyingImg = document.getElementById('flyingImage');

            // Pastikan elemen ditemukan
            if (!productImg || !cartIcon || !flyingImg) return;

            const rectProduct = productImg.getBoundingClientRect();
            const rectCart = cartIcon.getBoundingClientRect();

            flyingImg.style.top = rectProduct.top + 'px';
            flyingImg.style.left = rectProduct.left + 'px';
            flyingImg.style.width = '100px';

            const imgElement = flyingImg.querySelector('img');
            if (imgElement) imgElement.src = productImg.src;

            flyingImg.style.opacity = '1';

            setTimeout(() => {
                flyingImg.style.top = rectCart.top + 'px';
                flyingImg.style.left = rectCart.left + 'px';
                flyingImg.style.width = '30px';
            }, 50);

            setTimeout(() => {
                flyingImg.style.opacity = '0';
            }, 800);
        }

        function handleAction(action) {

            if (!selectedVariant && variasiHarga.length > 0) {
                showVariantAlert();
                return;
            }

            let qty = document.getElementById('quantity').value;

            if (action === 'cart') {
                createFlyingAnimation();
                setTimeout(() => {
                    window.location.href =
                        `{{ url('cartsimpan') }}?id=${productId}&quantity=${qty}&variant=${encodeURIComponent(selectedVariant)}&price=${selectedPrice}`;
                }, 800);
            } else if (action === 'buy') {
                window.location.href =
                    `{{ url('checkout') }}?id=${productId}&quantity=${qty}&variant=${encodeURIComponent(selectedVariant)}&price=${selectedPrice}`;
            }
        }

        document.addEventListener('DOMContentLoaded', function() {
            // Set default value untuk variasi pertama jika ada
            if (variasiHarga.length > 0) {
                updatePrice(variasiHarga[0].namavariasi);
            } else {
                document.getElementById("harga-produk").innerText = hargaDefault;
            }

            // Tambahkan event listeners untuk tombol kuantitas
            document.querySelector('.quantity-control button:first-child').addEventListener('click', function() {
                updateQuantity(-1);
            });

            document.querySelector('.quantity-control button:last-child').addEventListener('click', function() {
                updateQuantity(1);
            });

            // Tambahkan event listeners untuk tombol variasi
            document.querySelectorAll('.variant-button').forEach(btn => {
                btn.addEventListener('click', function() {
                    updatePrice(this.textContent.trim());
                });
            });
        });
    </script>
@endsection
