<?php

/** @var yii\web\View $this */

$this->title = 'My Yii Application';
?>
<div class="site-index">
    <div class="mb-0 bg-light">
        <div class="container py-2 text-left">
            <h1 class="display-4">Selamat Datang, User!</h1>
            <p class="fs-5 fw-light">Selamat datang di toko Makmur Sejahtera.</p>
        </div>
    </div>

    <div class="body-content">

        <div class="row">
            <div class="col-lg-4">
                <h2>Dashboard Transaksi</h2>

                <p>Membuat transaksi baru, melihat transaksi yang sudah berjalan, tracking transaksi anda!.</p>

                <p><a class="btn btn-outline-secondary" href="<?= Yii::$app->urlManager->createUrl('/transaction-header/index') ?>">Pergi &raquo;</a></p>
            </div>
        </div>

    </div>
</div>
