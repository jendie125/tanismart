

<?php $__env->startSection('content'); ?>
    <div class="container">
        <div class="dashboard-card">
            <h3><i class="fas fa-comments me-2"></i>Kelola Komentar</h3>

            <?php if(session('success')): ?>
                <div class="alert alert-success"><?php echo e(session('success')); ?></div>
            <?php endif; ?>

            <?php if($komentar->count()): ?>
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama</th>
                                <th>Pesan</th>
                                <th>Tanggal Dikirim</th>
                                <th>Tindakan</th>
                                <th>Balasan Admin</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__currentLoopData = $komentar; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key => $k): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <tr>
                                    <td><?php echo e($key + 1); ?></td>
                                    <td><?php echo e($k->user->name); ?></td>
                                    <td><?php echo e(Str::limit($k->isi, 50)); ?></td>
                                    <td><?php echo e(\Carbon\Carbon::parse($k->tanggal)->format('d M Y H:i')); ?></td>
                                    <td>
                                        <form action="<?php echo e(url('admin/komentarhapus', $k->idkomentar)); ?>" method="POST"
                                            onsubmit="return confirm('Yakin ingin menghapus komentar ini?')">
                                            <?php echo csrf_field(); ?>
                                            <?php echo method_field('DELETE'); ?>
                                            <button class="btn btn-delete btn-sm"><i class="fas fa-trash"></i> Hapus</button>
                                        </form>
                                    </td>
                                    <td>
                                        <?php if($k->balasan): ?>
                                            <span class="text-success"><?php echo e($k->balasan); ?></span>
                                        <?php else: ?>
                                            <form action="<?php echo e(url('admin/komentarbalas')); ?>" method="POST">
                                                <?php echo csrf_field(); ?>
                                                <input type="hidden" name="idkomentar" value="<?php echo e($k->idkomentar); ?>">
                                                <textarea name="balasan" rows="2" class="form-control form-control-sm" placeholder="Balas komentar..."></textarea>
                                                <button type="submit" class="btn btn-success btn-sm mt-1">Balas</button>
                                            </form>
                                        <?php endif; ?>
                                    </td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                    </table>
                </div>

                <div class="text-center">
                    <?php echo e($komentar->links('vendor.pagination.bootstrap-5')); ?>

                </div>
            <?php else: ?>
                <div class="alert alert-info">Tidak ada komentar yang ditemukan.</div>
            <?php endif; ?>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\Laravel Project\tanismart-laravel\resources\views/admin/komentar.blade.php ENDPATH**/ ?>