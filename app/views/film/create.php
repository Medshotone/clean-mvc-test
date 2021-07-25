<form id="film-store" action="/film/store" method="post" enctype="multipart/form-data">
    <div class="form-group">
        <label for="title">Title</label>
        <input type="text" class="form-control" id="title" name="title" required>
    </div>

    <div class="form-group">
        <label for="release_year">Release Year</label>
        <input type="text" class="form-control" id="release_year" name="release_year" required>
    </div>

    <div class="form-group">
        <label for="format">Format</label>
        <select class="form-control" name="format" id="format" required>
            <option value="">Select format</option>
            <option value="VHS">VHS</option>
            <option value="DVD">DVD</option>
            <option value="Blu-Ray">Blu-Ray</option>
        </select>
    </div>

    <div class="form-group">
        <label for="stars">Stars</label>
        <textarea class="form-control" id="stars" name="stars" required></textarea>
    </div>

    <button type="submit" class="btn btn-primary">Submit</button>
</form>

<script type="application/javascript">
    $('#film-store').submit(function (e) {
        e.preventDefault();

        let $form = $(this);

        $.ajax({
            // headers: {
            //     'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            // },
            url: $form.attr('action'),
            data: $form.serialize(),
            type: 'POST',
            dataType: 'json',
            success: function (json) {
                if (json['errors']) {
                    $form.find('.error').remove();

                    let errors = json['errors'];

                    for(let key in errors) {
                        $('[name="'+ key +'"').after('<span class="error">' + errors[key] + '</span>')
                    }
                }

                if (json['redirect']) {
                    location = json['redirect'];
                }
            },
            statusCode: {
                400: function(error) {
                    $form.find('.error').remove();

                    if (error['responseJSON']['wrongRequestMethod']) {
                        $form.prepend('<p class="error">' + error['responseJSON']['wrongRequestMethod'] + '</p>');
                    }
                }
            },
        });

        return false;
    });
</script>