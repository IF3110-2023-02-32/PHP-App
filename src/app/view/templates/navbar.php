<?php

// require_once PROJECT_ROOT_PATH . "/public/templates/UserProfile.php";

function Navbar()
{
//   $userProfile = UserProfile();

  $html = <<<"EOT"
    <div class="layout__left-sidebar">
        <div class="sidebar-menu">
            <img src="/public/assets/Logo.png" class="brand" />
            <a href="/">
                <div class="sidebar-menu__item sidebar-menu__item--active">
                    <img src="/public/assets/home.svg" class="sidebar-menu__item-icon" />
                    Home
                </div>
            </a>
            <a href="#">
                <div class="sidebar-menu__item">
                    <img src="/public/assets/followed.jpg" class="sidebar-menu__item-icon" />
                    Followed
                </div>
            </a>
            <a href="#">
                <div class="sidebar-menu__item">
                    <img src="/public/assets/profile.svg" class="sidebar-menu__item-icon" />
                    Profile
                </div>
            </a>
            <a href="/compose/kicau">
                <div class="sidebar-menu__compose">
                    Post
                </div>
            </a>
        </div>
    </div>
    <div id="list-post">
    </div>
  EOT;

  return $html;
}
