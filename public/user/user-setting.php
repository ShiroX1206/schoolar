<?php require_once __DIR__ . "/../../api/config/guard.php"; require_page_auth("user"); ?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Profile</title>
    <link
      rel="shortcut icon"
      href="../images/logo.ico"
      type="image/x-icon"
    />
    <link rel="stylesheet" href="../css/user-setting.css" />
    <link
      rel="stylesheet"
      href="https://fonts.googleapis.com/css2?family=Poppins:wght@600;700&family=Inter:wght@400;500;600&display=swap"
    />
  </head>
  <body>
    <div class="main-content">
      <a href="user-dashboard.php" id="back-btn">
        <img src="../ui-icons/icons8-back-30.png" alt="" />
      </a>

      <div class="profile-card">
        <div class="profile-top">
          <h3>Profile</h3>
          <div class="avatar">
            <img src="../images/profile.png" alt="" />
          </div>
          <p class="user-name">Adrian James Q. Padilla</p>
        </div>

        <div class="profile-menu">
          <a href="user-profile.php" class="menu-item">
            <span class="icon"
              ><img src="../ui-icons/icons8-profile-30.png" alt=""
            /></span>
            <span class="label">Personal Details</span>
            <span class="chevron">›</span>
          </a>
          <a href="#" class="menu-item" id="help-support-link">
            <span class="icon"
              ><img src="../ui-icons/icons8-help-30.png" alt=""
            /></span>
            <span class="label">Help &amp; Support</span>
            <span class="chevron">›</span>
          </a>
          <a href="../index.html" class="menu-item logout-link">
            <span class="icon"
              ><img src="../ui-icons/icons8-logout-30.png" alt=""
            /></span>
            <span class="label">Logout</span>
            <span class="chevron">›</span>
          </a>
        </div>
      </div>
    </div>

    <nav class="mobile-nav">
      <a href="user-dashboard.php"
        ><img src="../ui-icons/icons8-home-30.png" alt="" />
      </a>
      <a href="user-search.php"
        ><img src="../ui-icons/icons8-search-30.png" alt="" />
      </a>
      <a href="user-nearby.php"
        ><img src="../ui-icons/icons8-location-30.png" alt="" />
      </a>
      <a href="user-saved.php"
        ><img src="../ui-icons/icons8-saved-30.png" alt="" />
      </a>
      <a href="user-setting.php" class="active"
        ><img src="../ui-icons/icons8-setting-30.png" alt="" />
      </a>
    </nav>

    <script src="../js/app-config.js"></script>
    <script src="../js/auth-check.js"></script>
    <script src="../js/frontend-data.js"></script>
    <script src="../js/user-setting.js"></script>
  </body>
</html>
