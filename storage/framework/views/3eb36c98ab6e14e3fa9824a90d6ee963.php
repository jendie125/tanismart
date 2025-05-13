<?php $__env->startSection('content'); ?>
    <!-- Content sections -->
    <div class="content-container">
        <!-- Home section -->
        <section id="home-content" class="content-section active-section">
            <div class="hero d-flex align-items-center">
                <div class="container text-center">
                    <h1 class="display-4 fw-bold mb-4">SELAMAT DATANG DI TANI<span style="color: #3CB371;">SMART</span>
                    </h1>
                    <p class="lead mb-4">Kami menyediakan berbagai produk pertanian terbaik untuk membantu Anda mencapai
                        hasil maksimal. Ingin tahu lebih banyak? Cek artikel-artikel kami yang penuh dengan tips dan
                        informasi terbaru di dunia pertanian!</p>
                    <a href="#about" class="btn btn-primary btn-lg nav-btn" data-target="about-content">Mulai</a>
                </div>
            </div>

            <!-- Home Footer -->
            <footer class="section-footer">
                <div class="container">
                    <div class="row">
                        <div class="col-md-6 text-center text-md-start mb-3 mb-md-0">
                            <p class="mb-0">&copy; 2025 TANISMART. Created by kelompok4</p>
                        </div>
                        <div class="col-md-6 text-center text-md-end">
                            <a href="#" class="me-3"><i class="bi bi-instagram"></i></a>
                            <a href="#"><i class="bi bi-facebook"></i></a>
                        </div>
                    </div>
                </div>
            </footer>
        </section>

        <!-- About section -->
        <section id="about-content" class="content-section">
            <div class="about-container container">
                <h2 class="text-center section-title">TENTANG</h2>
                <div class="row align-items-center">
                    <div class="col-md-6 mb-4 mb-md-0">
                        <img src="assets/img/about.png" alt="Tentang kami" class="img-fluid rounded shadow">
                    </div>
                    <div class="col-md-6">
                        <h3 class="mb-4">Apa itu TANISMART?</h3>
                        <p>TaniSmart adalah sistem informasi web yang mendukung modernisasi pertanian di Indonesia.</p>
                        <p>Melalui TaniSmart, kami berkomitmen untuk memberdayakan petani Indonesia dengan teknologi,
                            membantu mereka meningkatkan efisiensi, mengoptimalkan hasil panen, dan menciptakan
                            pertanian yang berkelanjutan.</p>
                    </div>
                </div>
            </div>

            <!-- About Footer -->
            <footer class="section-footer">
                <div class="container">
                    <div class="row">
                        <div class="col-md-6 text-center text-md-start mb-3 mb-md-0">
                            <p class="mb-0">&copy; 2025 TANISMART. Created by kelompok4</p>
                        </div>
                        <div class="col-md-6 text-center text-md-end">
                            <a href="#" class="me-3"><i class="bi bi-instagram"></i></a>
                            <a href="#"><i class="bi bi-facebook"></i></a>
                        </div>
                    </div>
                </div>
            </footer>
        </section>

        <!-- Artikel section -->
        <section id="artikel-content" class="content-section">
            <div class="container" style="padding-top: 80px;">
                <h2 class="text-center section-title">ARTIKEL</h2>
                
                <div class="row" id="artikel-container">
                    <?php $__empty_1 = true; $__currentLoopData = $artikel; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <div class="col-md-4 mb-4">
                            <div class="card h-100">
                                <img src="<?php echo e(asset('uploads/' . $value->gambar)); ?>" class="card-img-top img-fluid"
                                    alt="Gambar Artikel">
                                <div class="card-body">
                                    <h5 class="card-title"><?php echo e($value->judul); ?></h5>
                                    <p class="card-text"><?php echo e(Str::limit($value->konten, 100)); ?></p>
                                    <a href="<?php echo e(url('artikeldetail', $value->idartikel)); ?>" class="btn btn-primary">Baca
                                        Selengkapnya</a>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <p class="text-center">Belum ada artikel yang ditambahkan.</p>
                    <?php endif; ?>
                </div>

                <!-- Pindah ke sini -->
                <div id="artikel-pagination" class="text-center mt-4"></div>


            </div>

            <!-- Artikel Footer -->
            <footer class="section-footer">
                <div class="container">
                    <div class="row">
                        <div class="col-md-6 text-center text-md-start mb-3 mb-md-0">
                            <p class="mb-0">&copy; 2025 TANISMART. Created by kelompok4</p>
                        </div>
                        <div class="col-md-6 text-center text-md-end">
                            <a href="#" class="me-3"><i class="bi bi-instagram"></i></a>
                            <a href="#"><i class="bi bi-facebook"></i></a>
                        </div>
                    </div>
                </div>
            </footer>
        </section>

        <!-- TokoTani section -->
        <section id="tokotani-content" class="content-section">
            <div class="container" style="padding-top: 80px;">
                <h2 class="text-center section-title text-success">TOKOTANI</h2>
                <div class="row" id="produk-container">
                    <?php $__empty_1 = true; $__currentLoopData = $produk; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <div class="col-md-4 mb-4">
                            <div class="card h-100 shadow-sm">

                                <a href="<?php echo e(url('produkdetail/' . $item->idproduk)); ?>"
                                    style="text-decoration: none; color: inherit;">
                                    <img src="<?php echo e(asset('uploads/' . $item->gambar)); ?>" class="card-img-top" alt="Produk"
                                        style="height:250px; object-fit:cover;">
                                    <div class="card-body d-flex flex-column justify-content-between">
                                        <h6 class="card-title fw-bold text-uppercase"><?php echo e($item->nama_produk); ?></h6>
                                        <p class="card-text text-muted small">
                                            <?php echo e(\Illuminate\Support\Str::limit($item->deskripsi, 35)); ?></p>
                                    </div>
                                </a>

                                <?php
                                    $harga_array = $item->produkdetail->pluck('harga')->toArray();

                                    if (count($harga_array) > 0) {
                                        $min = min($harga_array);
                                        $max = max($harga_array);
                                        $price_display =
                                            $min === $max
                                                ? 'Rp ' . number_format($min, 0, ',', '.')
                                                : 'Rp ' .
                                                    number_format($min, 0, ',', '.') .
                                                    ' - Rp ' .
                                                    number_format($max, 0, ',', '.');
                                    } else {
                                        $price_display = 'Harga tidak tersedia';
                                    }
                                ?>

                                <div
                                    class="card-footer bg-white border-0 d-flex justify-content-between align-items-center">
                                    <span class="text-success fw-bold"><?php echo e($price_display); ?></span>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <p class="text-center">Belum ada produk yang tersedia.</p>
                    <?php endif; ?>
                </div>

                <!-- Pindahkan ke sini, setelah seluruh produk -->
                <div id="produk-pagination" class="text-center mt-4"></div>


            </div>

            <!-- TokoTani Footer -->
            <footer class="section-footer">
                <div class="container">
                    <div class="row">
                        <div class="col-md-6 text-center text-md-start mb-3 mb-md-0">
                            <p class="mb-0">&copy; 2025 TANISMART. Created by kelompok4</p>
                        </div>
                        <div class="col-md-6 text-center text-md-end">
                            <a href="#" class="me-3"><i class="bi bi-instagram"></i></a>
                            <a href="#"><i class="bi bi-facebook"></i></a>
                        </div>
                    </div>
                </div>
            </footer>
        </section>

        <!-- Team section -->
        <section id="team-content" class="content-section">
            <div class="container" style="padding-top: 80px;">
                <h2 class="text-center section-title">TEAM</h2>
                <div class="row justify-content-center">
                    <!-- Anggota 1 -->
                    <div class="col-lg-4 col-md-6 mb-4">
                        <div class="card team-card h-100 border-0 shadow-sm">
                            <div class="img-container">
                                <img src="assets/img/anggota1.jpg" class="card-img-top" alt="Anggota 1">
                            </div>
                            <div class="card-body text-center p-4">
                                <h5 class="card-title mb-2">Ifran Maulana</h5>
                                <span class="badge bg-success mb-3">mbuh wong ndi</span>
                                <p class="text-muted"><i
                                        class="bi bi-envelope-fill me-2"></i>-</p>
                            </div>
                        </div>
                    </div>

                    <!-- Anggota 2 -->
                    <div class="col-lg-4 col-md-6 mb-4">
                        <div class="card team-card h-100 border-0 shadow-sm">
                            <div class="img-container">
                                <img src="assets/img/anggota2.jpg" class="card-img-top" alt="Anggota 2">
                            </div>
                            <div class="card-body text-center p-4">
                                <h5 class="card-title mb-2">Nurul Badriyah</h5>
                                <span class="badge bg-success mb-3">wong jatibarang</span>
                                <p class="text-muted"><i class="bi bi-envelope-fill me-2"></i>Nurulbdryh@gmail.com</p>
                            </div>
                        </div>
                    </div>

                    <!-- Anggota 3 -->
                    <div class="col-lg-4 col-md-6 mb-4">
                        <div class="card team-card h-100 border-0 shadow-sm">
                            <div class="img-container">
                                <img src="assets/img/anggota3.jpg" class="card-img-top" alt="Anggota 3">
                            </div>
                            <div class="card-body text-center p-4">
                                <h5 class="card-title mb-2">Jendi Laksamana Putra</h5>
                                <span class="badge bg-success mb-3">wong losarang</span>
                                <p class="text-muted"><i class="bi bi-envelope-fill me-2"></i>Jendilaksamana@gmail.com
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Team Footer -->
            <footer class="section-footer">
                <div class="container">
                    <div class="row">
                        <div class="col-md-6 text-center text-md-start mb-3 mb-md-0">
                            <p class="mb-0">&copy; 2025 TANISMART. Created by kelompok4</p>
                        </div>
                        <div class="col-md-6 text-center text-md-end">
                            <a href="#" class="me-3"><i class="bi bi-instagram"></i></a>
                            <a href="#"><i class="bi bi-facebook"></i></a>
                        </div>
                    </div>
                </div>
            </footer>
        </section>
    </div>

    <script>
        function paginateItems(containerId, paginationId, itemsPerPage = 6) {
            const container = document.getElementById(containerId);
            const items = container.querySelectorAll('.col-md-4');
            const pagination = document.getElementById(paginationId);
            const totalPages = Math.ceil(items.length / itemsPerPage);
            let currentPage = 1;

            function showPage(page) {
                currentPage = page;
                items.forEach((item, i) => {
                    item.style.display = (i >= (page - 1) * itemsPerPage && i < page * itemsPerPage) ? 'block' :
                        'none';
                });
                renderPagination();
            }

            function renderPagination() {
                pagination.innerHTML = '';

                const btn = (text, page, disabled = false, active = false) => {
                    const button = document.createElement('button');
                    button.textContent = text;
                    button.classList.add('btn', 'btn-sm', 'mx-1');
                    if (active) button.classList.add('btn-success');
                    else button.classList.add('btn-outline-success');
                    if (disabled) button.disabled = true;
                    button.addEventListener('click', () => showPage(page));
                    return button;
                };

                // Previous button
                pagination.appendChild(btn('«', currentPage - 1, currentPage === 1));

                // Page numbers with ellipsis
                let pageList = [];

                if (totalPages <= 7) {
                    for (let i = 1; i <= totalPages; i++) pageList.push(i);
                } else {
                    if (currentPage <= 4) {
                        pageList = [1, 2, 3, 4, 5, '...', totalPages];
                    } else if (currentPage >= totalPages - 3) {
                        pageList = [1, '...', totalPages - 4, totalPages - 3, totalPages - 2, totalPages - 1, totalPages];
                    } else {
                        pageList = [1, '...', currentPage - 1, currentPage, currentPage + 1, '...', totalPages];
                    }
                }

                pageList.forEach(p => {
                    if (p === '...') {
                        const span = document.createElement('span');
                        span.textContent = '...';
                        span.classList.add('mx-1');
                        pagination.appendChild(span);
                    } else {
                        pagination.appendChild(btn(p, p, false, currentPage === p));
                    }
                });

                // Next button
                pagination.appendChild(btn('»', currentPage + 1, currentPage === totalPages));
            }

            if (items.length > itemsPerPage) {
                showPage(1);
            }
        }

        document.addEventListener('DOMContentLoaded', function() {
            paginateItems('produk-container', 'produk-pagination', 6); // Atur jumlah per halaman
            paginateItems('artikel-container', 'artikel-pagination', 6);
        });
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.home', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\tanismart-\resources\views/home.blade.php ENDPATH**/ ?>