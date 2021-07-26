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

<?php if ($films || $search) { ?>
    <div class="card mb-3">
        <div class="row no-gutters">
            <div class="col-md-12">
                <div class="card-body">
                    <form id="search" class="input-group" method="get" action="/">
                        <select name="type" class="btn btn-primary">
                            <?php foreach (['title', 'stars'] as $type) { ?>
                                <option <?= $type == $searchType ? 'selected' : ''; ?> value="<?= $type; ?>"><?= ucfirst($type); ?></option>
                            <?php } ?>
                        </select>
                        <input type="text" name="search" value="<?= $search; ?>" placeholder="Select type and enter word" class="form-control input-lg">

                        <span class="input-group-btn"><button class="btn btn-primary">Search</button></span>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <?php if ($search) { ?>
        <div class="mb-3">
            <div class="row no-gutters">
                <div class="col-md-12">
                    <a href="/" class="btn btn-primary">Search reset</a>
                </div>
            </div>
        </div>
    <?php } ?>

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