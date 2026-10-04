<?php require_once __DIR__ . "/../../api/config/guard.php"; require_page_auth("user"); ?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Saved Scholarship</title>
    <link
      rel="shortcut icon"
      href="../images/logo.ico"
      type="image/x-icon"
    />
    <link rel="stylesheet" href="../css/user-saved.css" />
    <link
      rel="stylesheet"
      href="https://fonts.googleapis.com/css2?family=Poppins:wght@600;700&family=Inter:wght@400;500;600&display=swap"
    />
  </head>
  <body>
    <!-- Desktop Sidebar -->
    <aside class="sidebar">
      <h2>SCHOOlar</h2>
      <nav>
        <a href="user-dashboard.php"
          ><img src="../icons/icons8-home-30.png" alt="" /> Home</a
        >
        <a href="user-search.php"
          ><img src="../icons/icons8-search-30.png" alt="" /> Find
          Scholarships</a
        >
        <a href="user-nearby.php">
          <img src="../icons/icons8-location-30.png" alt="" />Nearby</a
        >
        <a href="user-saved.php" class="active"
          ><img src="../icons/icons8-saved-30.png" alt="" /> Saved</a
        >
        <a href="user-profile.php"
          ><img src="../icons/icons8-profile-30.png" alt="" /> Profile</a
        >
        <a href="../index.html" class="logout-link"
          ><img src="../icons/icons8-logout-30.png" alt="" /> Logout</a
        >
      </nav>
    </aside>

    <div class="main-content">
      <a href="user-dashboard.php" id="back-btn">
        <img src="../icons/icons8-back-30.png" alt="" />
      </a>

      <div class="container">
        <h3>Saved Scholarships</h3>
        <div class="buttons">
          <button class="active" data-tab="saved" type="button">Saved</button>
          <button data-tab="recent" type="button">Recently Viewed</button>
        </div>

        <div id="saved-content" class="tab-content">
          <p class="empty-state">You have no saved scholarships yet.</p>
        </div>

        <div id="recent-content" class="tab-content" style="display: none">
          <p class="empty-state">You have not viewed any scholarships yet.</p>
        </div>
      </div>
    </div>


    <nav class="mobile-nav">
      <a href="user-dashboard.php"
        ><img src="../icons/icons8-home-30.png" alt="" />
      </a>
      <a href="user-search.php"
        ><img src="../icons/icons8-search-30.png" alt="" />
      </a>
      <a href="user-nearby.php"
        ><img src="../icons/icons8-location-30.png" alt="" />
      </a>
      <a href="user-saved.php" class="active"
        ><img src="../icons/icons8-saved-30.png" alt="" />
      </a>
      <a href="user-setting.php"
        ><img src="../icons/icons8-setting-30.png" alt="" />
      </a>
    </nav>
      <script src="../js/app-config.js"></script>
    <script src="../js/auth-check.js"></script>
    <script src="../js/frontend-data.js"></script>
    <script src="../js/user-saved.js"></script>
  </body>
</html>

