<?php if (isset($film)) { ?>
    <div class="film">
        <div class="back_btn">
            <a class="btn btn-primary" href="/">< Back</a>
        </div>
        <div class="film_title">
            <h1><?= $film['title']; ?></h1>
        </div>
        <div class="film_date card-text">
            <small class="text-muted"><span>Release Year: </span><?= $film['release_year']; ?></small>
            <br>
            <small class="text-muted"><span>Format: </span><?= $film['format']; ?></small>
        </div>
        <div class="film_description">
            <p><span>Stars: </span><small><?= $film['stars']; ?></small></p>
        </div>
        <div class="remove_btn">
            <a onclick="if (!confirm('Do you really want to delete the movie?')) {return false;}"
               href="/film/destroy/<?= $film['id']; ?>" class="btn btn-primary remove">Remove</a>
        </div>
    </div>
<?php } ?>
