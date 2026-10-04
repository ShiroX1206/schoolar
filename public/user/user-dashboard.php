<?php require_once __DIR__ . "/../../api/config/guard.php"; require_page_auth("user"); ?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Dashboard</title>
    <link rel="stylesheet" href="../css/user-dashboard.css" />
    <link
      rel="shortcut icon"
      href="../images/logo.ico"
      type="image/x-icon"
    />
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
        <a href="user-dashboard.php" class="active"
          ><img src="../icons/icons8-home-30.png" alt="" /> Home</a
        >
        <a href="user-search.php"
          ><img src="../icons/icons8-search-30.png" alt="" /> Find
          Scholarships</a
        >
        <a href="user-nearby.php">
          <img src="../icons/icons8-location-30.png" alt="" />Nearby</a
        >
        <a href="user-saved.php"
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
      <div class="flex-container">
        <div class="header-section">
          <div class="profile">
            <img src="../images/user.jpg" alt="Profile" />
            <h3 id="name">Adrian James Padilla</h3>
          </div>
          <a href="user-notif.php">
            <img
              src="../icons/icons8-notification-30.png"
              alt="notif-icon"
            />
          </a>
        </div>

        <div class="announcement-section">
          <h3>Announcement</h3>
          <p>
            Browse available scholarships and check which opportunities match
            your student profile.
          </p>
        </div>

        <div class="scholarsihp-section">
          <h3>Scholarships near you</h3>
          <div class="scholarship-card" data-id="1">
            <p>Loading available scholarships...</p>
          </div>
        </div>
      </div>
    </div>

    <!-- Mobile Bottom Navigation -->
    <nav class="mobile-nav">
      <a href="user-dashboard.php" class="active"
        ><img src="../icons/icons8-home-30.png" alt="" />
      </a>
      <a href="user-search.php"
        ><img src="../icons/icons8-search-30.png" alt="" />
      </a>
      <a href="user-nearby.php"
        ><img src="../icons/icons8-location-30.png" alt="" />
      </a>
      <a href="user-saved.php"
        ><img src="../icons/icons8-saved-30.png" alt="" />
      </a>
      <a href="user-setting.php"
        ><img src="../icons/icons8-setting-30.png" alt="" />
      </a>
    </nav>

    <script src="../js/app-config.js"></script>
    <script src="../js/auth-check.js"></script>
    <script src="../js/frontend-data.js"></script>
    <script src="../js/user-dashboard.js"></script>
  </body>
</html>
