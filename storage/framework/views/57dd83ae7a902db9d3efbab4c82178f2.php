
<?php $__env->startSection('content'); ?>
    <div class="container">
        <h1>Dashboard Admin</h1>
        <h2>Selamat Datang, <?php echo e(auth()->user()->name); ?>!</h2>

        <div class="row mt-4">
            <div class="col-md-6 col-lg-4 mb-4">
                <div class="dashboard-card text-center p-4 shadow-sm">
                    <i class="fas fa-newspaper dashboard-icon mb-2" style="font-size: 2rem;"></i>
                    <h3>Artikel</h3>
                    <p>Kelola artikel-artikel terbaru tentang pertanian.</p>
                    <a href="<?php echo e(url('admin/artikel')); ?>" class="btn btn-hijau">Kelola Artikel</a>
                </div>
            </div>
            <div class="col-md-6 col-lg-4 mb-4">
                <div class="dashboard-card text-center p-4 shadow-sm">
                    <i class="fas fa-comments dashboard-icon mb-2" style="font-size: 2rem;"></i>
                    <h3>Komentar</h3>
                    <p>Kelola komentar yang masuk dari pengunjung artikel.</p>
                    <a href="<?php echo e(url('admin/komentar')); ?>" class="btn btn-hijau">Lihat Komentar</a>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\Laravel Project\tanismart-laravel\resources\views/admin/dashboard.blade.php ENDPATH**/ ?>