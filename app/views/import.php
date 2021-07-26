<?php if ($successMessage) { ?>
    <div class="card mb-3">
        <div class="row no-gutters">
            <div class="col-md-12">
                <div class="card-body">
                    <p class="card-text success-message"><?= $successMessage; ?></p>
                </div>
            </div>
        </div>
    </div>
<?php } ?>

<?php if ($errorMessage) { ?>
    <div class="card mb-3">
        <div class="row no-gutters">
            <div class="col-md-12">
                <div class="card-body">
                    <?php foreach ($errorMessage as $message) { ?>
                        <p class="card-text error-message"><?= $message; ?></p>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
<?php } ?>

<div class="card mb-3">
    <div class="row no-gutters">
        <div class="col-md-12">
            <div class="card-body">
                <form id="import-upload" action="/import/upload" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="image-file">Choose a text file to import movies</label>
                        <br>
                        <input id="image-file" name="file" type="file" accept=".txt">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>