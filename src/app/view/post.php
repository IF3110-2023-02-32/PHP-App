<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="../css/post.css">
    <link href="https://fonts.googleapis.com/css?family=Rubik" rel="stylesheet">
    <title>Post Page</title>
</head>

<body>
    <section id="overlay">
        <img src="github_post_logo.jpg" alt="Github Logo" id="logo">
        <hr>
        <form action="submission.php" method="POST">
            <h1>Create a post!</h1>
            <section class="text-input">
                <label for="textarea-input">Type in the box below:</label>
                <br>
                <textarea id="textarea-input" name="textarea-input" rows="15" cols="70"></textarea>
            </section>
            <br>

            <section class="image">
                <label for="image-input">Select an image file:</label>
                <input type="file" id="image-input" name="image-input">
            </section>
            <hr>
            <section class="video">
                <label for="video-input">Select a video file:</label>
                <input type="file" id="video-input" name="video-input">
            </section>
            <hr>
            <section class="audio">
                <label for="audio-input">Select an audio file:</label>
                <input type="file" id="audio-input" name="audio-input">
            </section>
            <br>

            <section class="submission">
                <input type="submit" value="Post">
            </section>
        </form>
    </section>
</body>

</html>