<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

    <div class="row">
        <div class="col-lg-6">

            <?= form_error('menu', '<div class="alert alert-success" role="alert">', '</div>'); ?>
            <?= $this->session->flashdata('message'); ?>
            <a href="" class="btn btn-success mb-3" data-toggle="modal" data-target="#newAgama">Add New Agama</a>
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th scope="col">No</th>
                        <th scope="col">Agama</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i = 1 ?>
                    <?php foreach ($agama as $agama) : ?>
                        <tr>
                            <th scope="row"><?= $i; ?></th>
                            <td><?= $agama['agama']; ?></td>
                            <td>
                                <a href="<?= base_url('agama/edit/') . $agama['id_agama']; ?>" class="btn btn-warning mb-3">Edit</a>
                                <a href="" class="btn btn-danger mb-3" data-toggle="modal" data-target="#deleteAgama">Delete</a>
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
<div class="modal fade" id="newAgama" tabindex="-1" aria-labelledby="newAgamaLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="newAgamaLabel">Add New Agama</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?= base_url('agama/add'); ?>" method="post">
                <div class="modal-body">
                    <div class="form-group">
                        <input type="text" class="form-control" id="agama" name="agama" placeholder="agama name">
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
<div class="modal fade" id="deleteAgama" tabindex="-1" aria-labelledby="deleteAgamaLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteAgamaLabel">Delete Agama</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                Are you sure want to delete this agama ?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <form action="<?= base_url('agama/delete/') . $agama['id_agama']; ?>">
                    <button type="submit" class="btn btn-danger">Delete</button>
                </form>
            </div>
        </div>
    </div>
</div>