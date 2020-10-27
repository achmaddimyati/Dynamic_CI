<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

    <div class="row">
        <div class="col-lg-8">
            <form action="<?php echo base_url('agama/edit/' . $agama['id_agama']) ?>" method="POST">
                <div class="form-group row">
                    <label for="email" class="col-sm-2 col-form-label">Nama Agama</label>
                    <div class="col-sm-10">

                        <input type="hidden" class="form-control" id="id" name="id_agama" value="<?= $agama['id_agama'] ?>">
                        <input type="text" class="form-control" id="agama" name="agama" value="<?= $agama['agama'] ?>">

                    </div>
                </div>

                <div class="form-group row justify-content-end">
                    <div class="col-sm-10">
                        <button type="submit" class="btn btn-primary">Save</button>
                    </div>
                </div>
            </form>
        </div>
    </div>


</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->