// This file controls the User Dashboard.

const dashboardName = document.getElementById("name");
const dashboardCard = document.querySelector(".scholarship-card");

async function loadUserDashboard() {
    try {
        const profile = await apiRequest("/user/profile.php");
        const scholarships = await getScholarships(false);

        dashboardName.textContent = profile.name;

        if (scholarships.length === 0) {
            dashboardCard.textContent = "No available scholarships right now.";
            return;
        }

        const newCard = createScholarshipCard(scholarships[0]);
        dashboardCard.replaceWith(newCard);
    } catch (error) {
        console.log("Could not load dashboard:", error.message);
    }
}

async function checkUserLogin() {
    const response = await fetch((window.SCHOOLAR_API || "/api") + "/auth/me.php");
    const data = await response.json();

    if (!response.ok || data.role !== "user") {
        window.location.href = "../login.html";
        return false;
    }

    return true;
}

document.querySelectorAll(".logout-link").forEach(function (link) {
    link.addEventListener("click", async function (event) {
        event.preventDefault();
        await fetch((window.SCHOOLAR_API || "/api") + "/auth/logout.php", { method: "POST" });
        window.location.href = "../index.html";
    });
});

async function startUserDashboard() {
    try {
        const loggedIn = await checkUserLogin();

        if (loggedIn) {
            await loadUserDashboard();
        }
    } catch (error) {
        window.location.href = "../login.html";
    }
}

startUserDashboard();
