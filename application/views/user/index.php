<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

    <div class="row">
        <div class="col-lg-8">
            <?= $this->session->flashdata('message'); ?>
        </div>
    </div>

    <div class="card mb-3 col-lg-8" style="max-width: 540px;">
        <div class="row no-gutters">
            <div class="col-md-6">
                <img src="<?= base_url('assets/img/profile/' . $user['image']) ?>" class="card-img" alt="...">
            </div>
            <div class="col-md-6">
                <div class="card-body">
                    <h5 class="card-title"><?= $user['name']; ?></h5>
                    <p class="card-text"><?= $user['email']; ?></p>
                    <?php foreach ($agama as $agama) {
                        if ($user['kd_agama'] == $agama['id_agama']) { ?>
                            <p class="card-text"><?= $agama['agama']; ?></p>
                    <?php }
                    } ?>
                    <?php foreach ($jurusan as $jurusan) {
                        if ($user['kd_jurusan'] == $jurusan['id_jurusan']) { ?>

                            <p class="card-text"><?= $jurusan['nama_jurusan']; ?></p>
                    <?php }
                    } ?>


                    <p class="card-text"><small class="text-muted">Member since<?= date('d F Y', $user['date_created']); ?></small></p>
                </div>
            </div>
        </div>
    </div>

</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->