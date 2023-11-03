<?php

// require_once PROJECT_ROOT_PATH . "/public/templates/UserProfile.php";

function Navbar()
{
//   $userProfile = UserProfile();

  $html = <<<"EOT"
  <div class="layout">
    <div class="layout__left-sidebar">
        <div class="sidebar-menu">
            <img src="/public/assets/Logo.png" class="brand" />
            <a style="text-decoration:none" href="/">
                <div class="sidebar-menu__item sidebar-menu__item--active">
                    <img src="/public/assets/home.svg" class="sidebar-menu__item-icon" />
                    Home
                </div>
            </a>
            <a style="text-decoration:none" href="#">
                <div class="sidebar-menu__item">
                    <img src="/public/assets/followed.jpg" class="sidebar-menu__item-icon" />
                    Followed
                </div>
            </a>
            <a style="text-decoration:none" href="#">
                <div class="sidebar-menu__item">
                    <img src="/public/assets/profile.svg" class="sidebar-menu__item-icon" />
                    Profile
                </div>
            </a>
        </div>
    </div>
    <div id="list-post">
    </div>
  </div>
  EOT;

  return $html;
}
