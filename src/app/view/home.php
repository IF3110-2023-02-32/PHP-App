<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link rel="stylesheet" href="../../public/css/home.css" />
</head>

<body>
    <div class="layout">
        <div class="layout__left-sidebar">
            <img src="../../public/assets/github_home_logo.png" class="brand" />
            <div class="sidebar-menu">
                <div class="sidebar-menu__item sidebar-menu__item--active">
                    <img src="../../public/assets/home.svg" class="sidebar-menu__item-icon" />
                    Home
                </div>
                <div class="sidebar-menu__item">
                    <img src="../../public/assets/followed.jpg" class="sidebar-menu__item-icon" />
                    Followed
                </div>
                <div class="../../public/assets/sidebar-menu__item">
                    <img src="../../public/assets/profile.svg" class="sidebar-menu__item-icon" />
                    Profile
                </div>
            </div>
        </div>
        <div id="list-post">
        </div>
    </div>
    <script src="/public/js/home.js"></script>
</body>
</html>