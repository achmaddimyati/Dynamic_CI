<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

    <div class="row">
        <div class="col-lg-8">
            <form action="<?= base_url('menu/edit_sub/') . $submenu['id']; ?>" method="post">
                <div class="form-group row">
                    <div class="col-sm-10">
                        <input type="hidden" class="form-control" id="id" name="id" placeholder="Submenu id" value="<?= $submenu['id']; ?>">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="title" class="col-sm-2 col-form-label">Submenu</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="title" name="title" placeholder="Submenu title" value="<?= $submenu['title']; ?>">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="menu" class="col-sm-2 col-form-label">Nama Menu</label>
                    <div class="col-sm-10">
                        <select name="menu_id" id="menu_id" class="form-control">
                            <option value="">Select Menu</option>
                            <?php foreach ($menu as $m) : ?>
                                <?php if ($m['id'] == $submenu['menu_id']) { ?>
                                    <option value="<?= $m['id']; ?>" selected><?= $m['menu']; ?></option>
                                <?php } else { ?>
                                    <option value="<?= $m['id']; ?>"><?= $m['menu']; ?></option>
                                <?php } ?>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="url" class="col-sm-2 col-form-label">Url</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="url" name="url" placeholder="Submenu url" value="<?= $submenu['url']; ?>">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="title" class="col-sm-2 col-form-label">Icon</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" id="icon" name="icon" placeholder="Submenu icon" value="<?= $submenu['icon']; ?>">
                    </div>
                </div>
                <div class="form-group row justify-content-end">
                    <div class="form-check">
                        <input class="form-check-input col-sm-5" type="checkbox" name="is_active" id="is_active" value="1" checked>
                        <div class="col-sm-10">
                            <label for="is_active" class="form-check-label">Active?</label>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
            </form>

        </div>


    </div>
    <!-- /.container-fluid -->

</div>
<!-- End of Main Content -->