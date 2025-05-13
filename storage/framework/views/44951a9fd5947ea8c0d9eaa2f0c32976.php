
<?php $__env->startSection('content'); ?>
    <div class="container">
        <div class="row">
            
            <div class="col-md-6">
                <div class="card mb-4">
                    <div class="card-header">
                        <h2 class="mb-0"><i class="fas fa-edit me-2"></i>Edit Produk</h2>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="<?php echo e(url('mitra/produkupdate/' . $produkedit->idproduk)); ?>"
                            enctype="multipart/form-data">
                            <?php echo csrf_field(); ?>
                            <?php echo method_field('PUT'); ?>
                            <div class="mb-3">
                                <label class="form-label">Nama Produk:</label>
                                <input type="text" class="form-control" name="namaproduk"
                                    value="<?php echo e($produkedit->namaproduk); ?>" required>
                                <?php $__errorArgs = ['namaproduk'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <div class="alert alert-danger mt-2">
                                        <?php echo e($message); ?>

                                    </div>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Deskripsi:</label>
                                <textarea class="form-control" name="deskripsi" rows="3" required><?php echo e($produkedit->deskripsi); ?></textarea>
                                <?php $__errorArgs = ['deskripsi'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <div class="alert alert-danger mt-2">
                                        <?php echo e($message); ?>

                                    </div>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Gambar Produk</label>
                                <input type="file" class="form-control" name="gambar" accept="image/*">
                                <small class="text-danger">*Kosongkan jika tidak ingin mengganti gambar</small>
                                <?php $__errorArgs = ['gambar'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                                    <div class="alert alert-danger mt-2">
                                        <?php echo e($message); ?>

                                    </div>
                                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>

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
                                        <?php $__currentLoopData = $produkedit->produkdetail; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $d): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <tr>
                                                <input type="hidden" name="idprodukdetail[]"
                                                    value="<?php echo e($d->idprodukdetail); ?>">
                                                <td><input type="text" name="namavariasi[]" value="<?php echo e($d->namavariasi); ?>"
                                                        class="form-control" required></td>
                                                <td><input type="number" name="harga[]" value="<?php echo e($d->harga); ?>"
                                                        class="form-control" required></td>
                                                <td><input type="number" name="stok[]" value="<?php echo e($d->stok); ?>"
                                                        class="form-control" required></td>
                                                <td><button type="button"
                                                        class="btn btn-sm btn-danger hapus-baris">×</button></td>
                                            </tr>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </tbody>
                                </table>
                            </div>

                            <button type="submit" class="btn btn-primary w-100">
                                <i class="fas fa-save me-2"></i>Update Produk
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
                                        <th>Variasi</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $__empty_1 = true; $__currentLoopData = $produk; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $i => $p): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                        <tr>
                                            <td><?php echo e($i + 1); ?></td>
                                            <td><?php echo e($p->namaproduk); ?></td>
                                            <td>
                                                <?php $__currentLoopData = $p->produkdetail; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $d): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                    <small><?php echo e($d->namavariasi); ?> (Rp<?php echo e(number_format($d->harga)); ?>, Stok:
                                                        <?php echo e($d->stok); ?>)</small><br>
                                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            </td>
                                            <td>
                                                <a href="<?php echo e(url('mitra/produkedit/' . $p->idproduk)); ?>"
                                                    class="btn btn-success btn-sm"><i class="fas fa-edit"></i></a>
                                                <form action="<?php echo e(url('mitra/produkhapus/' . $p->idproduk)); ?>"
                                                    method="POST" style="display:inline-block;">
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
                <td><input type="number" name="harga[]" class="form-control" required></td>
                <td><input type="number" name="stok[]" class="form-control" required></td>
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

<?php echo $__env->make('layouts.mitra', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\Laravel Project\tanismart-laravel\resources\views/mitra/produkedit.blade.php ENDPATH**/ ?>