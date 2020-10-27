<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

    <div class="row">
        <div class="col-lg-8">
            <?= form_open_multipart('user/edit'); ?>
            <div class="form-group row">
                <label for="email" class="col-sm-2 col-form-label">Email</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="email" name="email" value="<?= $user['email'] ?>" readonly>
                </div>
            </div>
            <div class="form-group row">
                <label for="name" class="col-sm-2 col-form-label">Full Name</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="name" name="name" value="<?= $user['name'] ?>">
                    <?php echo form_error('name', '<small class="text-danger pl-3">', '</small>'); ?>
                </div>
            </div>
            <div class="form-group row">
                <label for="agama" class="col-sm-2 col-form-label">Agama</label>
                <div class="col-sm-10">
                    <select name="kd_agama" id="agama">
                        <option value="">-Pilih Agama-</option>
                        <?php foreach ($agama as $agama) : ?>
                            <?php if ($user['kd_agama'] == $agama['id_agama']) {
                                echo "<option value=$agama[id_agama] selected>$agama[agama]</option>";
                            } else {
                                echo "<option value=$agama[id_agama]>$agama[agama]</option>";
                            } ?>
                        <?php endforeach; ?>
                    </select>
                    <?php echo form_error('kd_agama', '<small class="text-danger pl-3">', '</small>'); ?>
                </div>
            </div>
            <div class="form-group row">
                <label for="jurusan" class="col-sm-2 col-form-label">Jurusan</label>
                <div class="col-sm-10">
                    <select name="kd_jurusan" id="jurusan">
                        <option value="">-Pilih Jurusan-</option>
                        <?php foreach ($jurusan as $jurusan) : ?>
                            <?php if ($user['kd_jurusan'] == $jurusan['id_jurusan']) {
                                echo "<option value=$jurusan[id_jurusan] selected>$jurusan[nama_jurusan]</option>";
                            } else {
                                echo "<option value=$jurusan[id_jurusan]>$jurusan[nama_jurusan]</option>";
                            } ?>
                        <?php endforeach; ?>
                    </select>
                    <?php echo form_error('kd_jurusan', '<small class="text-danger pl-3">', '</small>'); ?>
                </div>
            </div>
            <div class="form-group row">
                <div class="col-sm-2">Picture</div>
                <div class="col-sm-10">
                    <div class="row">
                        <div class="col-sm-3">
                            <img src="<?= base_url('assets/img/profile/') . $user['image'] ?>" class="img-thumbnail">
                        </div>
                        <div class="col-sm-9">
                            <div class="custom-file">
                                <input type="file" class="custom-file-input" id="image" name="image">
                                <label class="custom-file-label" for="image">Choose file</label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="form-group row justify-content-end">
                <div class="col-sm-10">
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
            </div>

        </div>
    </div>


</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->