<?php require_once __DIR__ . "/../../api/config/guard.php"; require_page_auth("admin"); ?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Admin Dashboard</title>
    <link
      rel="shortcut icon"
      href="../images/logo.ico"
      type="image/x-icon"
    />
    <link rel="stylesheet" href="../css/admin-dashboard.css" />
  </head>
  <body>
    <!-- Sidebar -->
    <aside class="sidebar">
      <h2>SCHOOlar</h2>
      <nav>
        <a href="admin-dashboard.php" class="active"
          ><img src="../icons/icons8-home-30.png" alt="" /> Dashboard</a
        >
        <a href="admin-scholarships.php"
          ><img src="../icons/icons8-scholarship-30.png" alt="" /> Manage
          Scholarships</a
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
            <img src="../images/user.jpg" alt="Admin" />
            <div>
              <h3 id="name">Admin</h3>
              <p>SCHOOlar Administrator</p>
            </div>
          </div>
        </div>

        <div class="stats-grid">
          <div class="stat-card">
            <p class="stat-label">Total Scholarships</p>
            <p class="stat-value" id="stat-total">0</p>
          </div>
          <div class="stat-card active">
            <p class="stat-label">Available Listings</p>
            <p class="stat-value" id="stat-active">0</p>
          </div>
          <div class="stat-card inactive">
            <p class="stat-label">Not Available Listings</p>
            <p class="stat-value" id="stat-inactive">0</p>
          </div>
          <div class="stat-card expiring">
            <p class="stat-label">Deadline Within 30 Days</p>
            <p class="stat-value" id="stat-expiring">0</p>
          </div>
        </div>

        <div class="recent-section">
          <h3>Recently Updated</h3>
          <div class="recent-list" id="recent-list"></div>
        </div>
      </div>
    </div>

    <nav class="mobile-nav">
      <a href="admin-dashboard.php" class="active"
        ><img src="../icons/icons8-home-30.png" alt="" />
      </a>
      <a href="admin-scholarships.php"
        ><img src="../icons/icons8-scholarship-30.png" alt="" />
      </a>
      <a href="../index.html" class="logout-link"
        ><img src="../icons/icons8-logout-30.png" alt="" />
      </a>
    </nav>
    <script src="../js/app-config.js"></script>
    <script src="../js/auth-check.js"></script>
    <script src="../js/frontend-data.js"></script>
    <script src="../js/admin-dashboard.js"></script>
  </body>
</html>
