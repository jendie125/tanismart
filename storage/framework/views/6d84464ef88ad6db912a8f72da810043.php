
<?php $__env->startSection('content'); ?>
    <div class="container article-container">

        <br>
        <article>
            <header class="article-header">
                <h1 class="article-title"><?php echo e($artikel->judul); ?></h1>
                <div class="article-meta">Dipublikasikan pada:
                    <?php echo e(\Carbon\Carbon::parse($artikel->tanggal)->format('d M Y')); ?></div>
            </header>

            <div class="article-featured-image">
                <img src="<?php echo e(asset('uploads/' . $artikel->gambar)); ?>" alt="<?php echo e($artikel->judul); ?>">
            </div>

            <div class="article-content"><?php echo nl2br(e($artikel->konten)); ?></div>

            <?php if($artikel->sumber && $artikel->url): ?>
                <div class="article-meta mt-3">
                    <p>Sumber: <a href="<?php echo e($artikel->url); ?>" target="_blank"
                            style="color: #007bff;"><?php echo e($artikel->sumber); ?></a></p>
                </div>
            <?php endif; ?>
        </article>

        <!-- Artikel Lainnya -->
        <div class="other-articles mt-5">
            <h3 class="mb-3">Artikel Lainnya</h3>
            <div class="row">
                <?php $__currentLoopData = $artikellain; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="col-md-12 mb-2">
                        <div class="card">
                            <div class="card-body">
                                <a href="<?php echo e(url('artikeldetail/' . $item->idartikel)); ?>" class="text-decoration-none">
                                    <?php echo e($item->judul); ?>

                                </a>
                            </div>
                        </div>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </div>

        <!-- Komentar -->
        <div class="mt-5">
            <h3>Komentar</h3>
            <?php $__empty_1 = true; $__currentLoopData = $artikel->komentar; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $komentar): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <div class="komentar mb-4">
                    <strong><?php echo e($komentar->nama ?? 'Pengunjung'); ?></strong>
                    <span class="text-muted d-block mb-2">
                        <?php echo e(\Carbon\Carbon::parse($komentar->tanggal)->format('d M Y H:i')); ?>

                    </span>
                    <p><?php echo e($komentar->isi); ?></p>

                    <?php if(!empty($komentar->balasan)): ?>
                        <div class="balasan-admin ms-4 p-3 border rounded">
                            <strong>Admin</strong>
                            <span class="text-muted d-block mb-2">
                                <?php echo e(\Carbon\Carbon::parse($komentar->tanggal)->format('d M Y H:i')); ?>

                            </span>
                            <p><?php echo e($komentar->balasan); ?></p>
                        </div>
                    <?php endif; ?>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <p class="text-muted">Belum ada komentar.</p>
            <?php endif; ?>
        </div>

        <!-- Form Komentar -->
        <div class="comment-form mt-4">
            <h3 class="mb-3">Tinggalkan Komentar:</h3>
            <form action="<?php echo e(url('komentarsimpan')); ?>" method="POST">
                <?php echo csrf_field(); ?>
                <div class="mb-3">
                    <label for="isi" class="form-label">Komentar:</label>
                    <textarea class="form-control" id="isi" name="isi" rows="4" required></textarea>
                </div>
                <input type="hidden" name="idartikel" value="<?php echo e($artikel->idartikel); ?>">
                <button type="submit" class="btn btn-primary">Kirim</button>
            </form>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.home', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\Laravel Project\tanismart-laravel\resources\views/artikeldetail.blade.php ENDPATH**/ ?>