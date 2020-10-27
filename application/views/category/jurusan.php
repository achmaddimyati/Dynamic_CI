<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

    <div class="row">
        <div class="col-lg-6">

            <?= form_error('menu', '<div class="alert alert-success" role="alert">', '</div>'); ?>
            <?= $this->session->flashdata('message'); ?>
            <a href="" class="btn btn-success mb-3" data-toggle="modal" data-target="#newJurusan">Add New Jurusan</a>
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th scope="col">No</th>
                        <th scope="col">Jurusan</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i = 1 ?>
                    <?php foreach ($jurusan as $jurusan) : ?>
                        <tr>
                            <th scope="row"><?= $i; ?></th>
                            <td><?= $jurusan['nama_jurusan']; ?></td>
                            <td>
                                <a href="<?= base_url('jurusan/edit/') . $jurusan['id_jurusan']; ?>" class="btn btn-warning mb-3">Edit</a>
                                <a href="" class="btn btn-danger mb-3" data-toggle="modal" data-target="#deleteJurusan">Delete</a>
                            </td>
                        </tr>
                        <?php $i++; ?>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>

</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->

<!-- Modal Add new Menu-->
<div class="modal fade" id="newJurusan" tabindex="-1" aria-labelledby="newJurusanLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="newJurusanLabel">Add New Jurusan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?= base_url('jurusan/add'); ?>" method="post">
                <div class="modal-body">
                    <div class="form-group">
                        <input type="text" class="form-control" id="jurusan" name="nama_jurusan" placeholder="jurusan name">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Add</button>
                </div>
            </form>
        </div>
    </div>
</div>


<!-- Modal delete Menu-->
<div class="modal fade" id="deleteJurusan" tabindex="-1" aria-labelledby="deleteJurusanLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteJurusanLabel">Delete Jurusan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                Are you sure want to delete this jurusan ?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <form action="<?= base_url('jurusan/delete/') . $jurusan['id_jurusan']; ?>">
                    <button type="submit" class="btn btn-danger">Delete</button>
                </form>
            </div>
        </div>
    </div>
</div>