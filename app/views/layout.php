<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Site storage of information about the film</title>

    <script src="/public/js/jQuery.js"></script>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="/public/css/main.css">
</head>
<body>
<header>
    <div class="container">
        <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
            <span class="navbar-brand">Film storage</span>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
                    aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item<?= $currentPage == 'film/films' ? ' active' : '' ?>">
                        <a class="nav-link" href="/">Films</a>
                    </li>
                    <li class="nav-item<?= $currentPage == 'film/create' ? ' active' : '' ?>">
                        <a class="nav-link" href="/film/create">Create Films</a>
                    </li>
                    <li class="nav-item<?= $currentPage == 'import' ? ' active' : '' ?>">
                        <a class="nav-link" href="/import">Import</a>
                    </li>
                </ul>
            </div>
        </nav>
    </div>
</header>
<section>
    <div class="container">
        <div class="main">
            <?= $content; ?>
        </div>
    </div>
</section>
</body>
</html>