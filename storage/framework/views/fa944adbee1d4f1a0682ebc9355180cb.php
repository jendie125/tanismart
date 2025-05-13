
<?php $__env->startSection('content'); ?>
    <div class="container">
        <div class="row">
            
            <div class="col-md-6">
                <div class="card mb-4">
                    <div class="card-header">
                        <h2 class="mb-0"><i class="fas fa-plus-circle me-2"></i>Input Produk</h2>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="<?php echo e(url('mitra/produksimpan')); ?>" enctype="multipart/form-data">
                            <?php echo csrf_field(); ?>
                            <div class="mb-3">
                                <label for="namaproduk" class="form-label">Nama Produk:</label>
                                <input type="text" class="form-control" name="namaproduk" required>
                            </div>
                            <div class="mb-3">
                                <label for="deskripsi" class="form-label">Deskripsi:</label>
                                <textarea class="form-control" name="deskripsi" rows="3" required></textarea>
                            </div>
                            <div class="mb-3">
                                <label for="gambar" class="form-label">Gambar Produk:</label>
                                <input type="file" class="form-control" name="gambar" accept="image/*" required>
                            </div>

                            
                            <div class="mb-3">
                                <label class="form-label">Variasi Produk:</label>
                                <table class="table table-bordered" id="tabel-variasi">
                                    <thead>
                                        <tr>
                                            <th>Nama Variasi</th>
                                            <th>Harga</th>
                                            <th>Stok</th>
                                            <th><button type="button" class="btn btn-sm btn-success"
                                                    id="tambah-variasi">+</button></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td><input type="text" name="namavariasi[]" class="form-control" required>
                                            </td>
                                            <td><input type="number" name="hargavariasi[]" class="form-control" required>
                                            </td>
                                            <td><input type="number" name="stokvariasi[]" class="form-control" required>
                                            </td>
                                            <td></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>

                            <button type="submit" class="btn btn-primary w-100">
                                <i class="fas fa-paper-plane me-2"></i>Tambah Produk
                            </button>
                        </form>
                    </div>
                </div>
            </div>

            
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h2 class="mb-0"><i class="fas fa-list me-2"></i>Daftar Produk</h2>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Produk</th>
                                        <th>Deskripsi</th>
                                        <th>Variasi</th>
                                        <th>Gambar</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $__empty_1 = true; $__currentLoopData = $produk; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i => $p): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                        <tr>
                                            <td><?php echo e($i + 1); ?></td>
                                            <td><?php echo e($p->namaproduk); ?></td>
                                            <td><?php echo e(substr($p->deskripsi, 0, 50)); ?></td>
                                            <td>
                                                <img src="<?php echo e(asset('uploads/' . $p->gambar)); ?>" alt="Gambar Produk"
                                                    class="img-fluid" style="max-width: 100px;">
                                            </td>
                                            <td>
                                                <?php $__currentLoopData = $p->produkdetail; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $d): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <small><?php echo e($d->namavariasi); ?> (Rp<?php echo e(number_format($d->harga)); ?>, Stok:
                                                        <?php echo e($d->stok); ?>)</small><br>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </td>
                                            <td>
                                                <a href="<?php echo e(url('mitra/produkedit/' . $p->idproduk)); ?>"
                                                    class="btn btn-success btn-sm"><i class="fas fa-edit"></i></a>
                                                <form action="<?php echo e(url('mitra/produkhapus/' . $p->idproduk)); ?>" method="POST"
                                                    style="display:inline-block;">
                                                    <?php echo csrf_field(); ?> <?php echo method_field('DELETE'); ?>
                                                    <button class="btn btn-danger btn-sm"
                                                        onclick="return confirm('Hapus produk ini?')"><i
                                                            class="fas fa-trash"></i></button>
                                                </form>
                                            </td>
                                        </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                        <tr>
                                            <td colspan="6" class="text-center">Belum ada produk.</td>
                                        </tr>
                                    <?php endif; ?>
                                </tbody>
                            </table>
                            <div class="text-center"><?php echo e($produk->links('vendor.pagination.bootstrap-5')); ?></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>
    <script>
        document.getElementById('tambah-variasi').addEventListener('click', function() {
            const tbody = document.querySelector('#tabel-variasi tbody');
            const row = document.createElement('tr');

            row.innerHTML = `
                <td><input type="text" name="namavariasi[]" class="form-control" required></td>
                <td><input type="number" name="hargavariasi[]" class="form-control" required></td>
                <td><input type="number" name="stokvariasi[]" class="form-control" required></td>
                <td><button type="button" class="btn btn-sm btn-danger hapus-baris">×</button></td>
            `;
            tbody.appendChild(row);
        });

        document.addEventListener('click', function(e) {
            if (e.target && e.target.classList.contains('hapus-baris')) {
                e.target.closest('tr').remove();
            }
        });
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.mitra', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\Laravel Project\tanismart-laravel\resources\views/mitra/produk.blade.php ENDPATH**/ ?>