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

<?php if ($films) { ?>
    <?php foreach ($films as $film) { ?>
        <div class="card mb-3">
            <div class="row no-gutters">
                <div class="col-md-10">
                    <div class="card-body">
                        <a href="/film/<?= $film['id']; ?>" class="card-title"><?= $film['title']; ?></a>
                        <p class="card-text">
                            <small class="text-muted"><span>Release Year: </span><?= $film['release_year']; ?></small>
                            <br>
                            <small class="text-muted"><span>Format: </span><?= $film['format']; ?></small>
                        </p>
                        <p class="card-text"><span>Stars: </span>
                            <small><?= $film['stars']; ?></small>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    <?php } ?>
<?php } else { ?>
    <div class="card mb-3">
        <div class="row no-gutters">
            <div class="col-md-12">
                <div class="card-body">
                    <p class="card-text">
                        <a class="card-title" href="/film/create">Create your first film</a>
                        or
                        <a class="card-title" href="/import">Import films</a>
                    </p>
                </div>
            </div>
        </div>
    </div>
<?php } ?>