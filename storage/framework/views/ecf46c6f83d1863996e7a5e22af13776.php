
<?php $__env->startSection('content'); ?>
    <div class="container">
        <h1>Dashboard Mitra</h1>
        <h2>Selamat Datang, <?php echo e(auth()->user()->name); ?>!</h2>

        <div class="row mt-4">
            <div class="col-md-6 col-lg-4 mb-4">
                <div class="dashboard-card text-center p-4 shadow-sm">
                    <i class="fas fa-box-open dashboard-icon mb-2" style="font-size: 2rem;"></i>
                    <h3>Produk</h3>
                    <p>Kelola produk-produk pertanian.</p>
                    <a href="<?php echo e(url('mitra/produk')); ?>" class="btn btn-hijau">Kelola Produk</a>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.mitra', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\xampp\htdocs\tanismart-\resources\views/mitra/dashboard.blade.php ENDPATH**/ ?>