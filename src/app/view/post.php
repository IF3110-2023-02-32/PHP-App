<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="/public/css/post.css">
    <link href="https://fonts.googleapis.com/css?family=Rubik" rel="stylesheet">
    <title>Post Page</title>
</head>

<body>
    <section id="overlay">
        <img src="/public/assets/Logo.png" alt="Kicau Logo" id="logo">
        <hr>
        <form action="create" method="POST">
            <h1>Create a post!</h1>
            <section class="text-input">
                <label for="textarea-input">Type in the box below:</label>
                <br>
                <textarea id="textarea-input" name="textarea-input" rows="15" cols="70"></textarea>
            </section>
            <br>

            <section class="file">
                <label for="file-input">Select a file:</label>
                <input type="file" id="file-input" name="image-input">
            </section>
            <hr>

            <section class="submission">
                <input type="submit" id="btn-post" value="Post">
            </section>
        </form>
    </section>
</body>

</html>