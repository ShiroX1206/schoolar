// This file protects Admin and User pages.
// It also handles the Logout links.
// Role is detected case-insensitively so old /User/ /Admin/ bookmarks keep working.

async function checkPageAccess() {
    const path = window.location.pathname;
    const lower = path.toLowerCase();
    let requiredRole = "";

    if (lower.indexOf("/admin/") !== -1) {
        requiredRole = "admin";
    }

    if (lower.indexOf("/user/") !== -1) {
        requiredRole = "user";
    }

    if (requiredRole === "") {
        return;
    }

    // This script runs one level below public/ (public/user/*, public/admin/*).
    const loginPage = requiredRole === "admin" ? "admin-login.html" : "../login.html";

    try {
        const response = await fetch((window.SCHOOLAR_API || "/api") + "/auth/me.php");
        const data = await response.json();

        if (!response.ok || data.role !== requiredRole) {
            window.location.href = loginPage;
            return;
        }

        document.querySelectorAll(".logout-link").forEach(function (link) {
            link.addEventListener("click", async function (event) {
                event.preventDefault();

                try {
                    await fetch((window.SCHOOLAR_API || "/api") + "/auth/logout.php", {
                        method: "POST"
                    });
                } catch (error) {
                    console.log("Logout request failed.");
                }

                window.location.href = "../index.html";
            });
        });
    } catch (error) {
        window.location.href = loginPage;
    }
}

checkPageAccess();
