
<?php $__env->startSection('content'); ?>
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <div class="card mb-4">
                    <div class="card-header">
                        <h2 class="mb-0"><i class="fas fa-plus-circle me-2"></i>Input Artikel</h2>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="<?php echo e(url('admin/artikelupdate/' . $artikeledit->idartikel)); ?>"
                            enctype="multipart/form-data">
                            <?php echo csrf_field(); ?>
                            <?php echo method_field('PUT'); ?>
                            <div class="mb-3">
                                <label for="judul" class="form-label">Judul Artikel:</label>
                                <input type="text" class="form-control" name="judul" value="<?php echo e($artikeledit->judul); ?>"
                                    required>
                                <?php $__errorArgs = ['judul'];
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
                                <label for="konten" class="form-label">Konten:</label>
                                <textarea class="form-control" name="konten" rows="5" required><?php echo e($artikeledit->konten); ?></textarea>
                                <?php $__errorArgs = ['konten'];
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
                                <label for="gambar" class="form-label">Upload Gambar Artikel:</label>
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
                                <label for="sumber" class="form-label">Sumber:</label>
                                <input type="text" class="form-control" name="sumber" value="<?php echo e($artikeledit->sumber); ?>"
                                    required>
                                <?php $__errorArgs = ['sumber'];
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
                                <label for="url" class="form-label">URL:</label>
                                <input type="url" class="form-control" name="url" value="<?php echo e($artikeledit->url); ?>"
                                    required>
                                <?php $__errorArgs = ['url'];
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
                            <button type="submit" name="submit_artikel" class="btn btn-primary w-100">
                                <i class="fas fa-paper-plane me-2"></i>Tambah Artikel
                            </button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header">
                        <h2 class="mb-0"><i class="fas fa-list me-2"></i>Daftar Artikel</h2>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Judul</th>
                                        <th>Konten</th>
                                        <th>Gambar</th>
                                        <th>Sumber</th>
                                        <th>URL</th>
                                        <th>Tindakan</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $__empty_1 = true; $__currentLoopData = $artikel; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key =>$value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                        <tr>
                                            <td><?php echo e($key + 1); ?></td>
                                            <td><?php echo e($value->judul); ?></td>
                                            <td><?php echo e(Str::limit($value->konten, 50)); ?></td>
                                            <td><img src="<?php echo e(asset('uploads/' . $value->gambar)); ?>" alt="Gambar Artikel"
                                                    class="img-thumbnail"></td>
                                            <td><?php echo e($value->sumber); ?></td>
                                            <td><a href="<?php echo e($value->url); ?>" target="_blank">Buka</a></td>
                                            <td>
                                                <a href="<?php echo e(url('admin/artikeledit', $value->idartikel)); ?>"
                                                    class="btn btn-success btn-sm"><i class="fas fa-edit"></i></a>
                                                <a href="<?php echo e(url('admin/artikelhapus', $value->idartikel)); ?>"
                                                    class="btn btn-danger btn-sm"
                                                    onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')"><i
                                                        class="fas fa-trash-alt"></i></a>
                                            </td>
                                        </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                        <tr>
                                            <td colspan="7" class="text-center">Belum ada artikel yang tersedia.</td>
                                        </tr>
                                    <?php endif; ?>
                                </tbody>
                            </table>
                        </div>
                        <div class="text-center">
                            <?php echo e($artikel->links('vendor.pagination.bootstrap-5')); ?>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\Laravel Project\tanismart-laravel\resources\views/admin/artikeledit.blade.php ENDPATH**/ ?>