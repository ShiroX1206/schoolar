// SCHOOlar base-path auto-detect: works under XAMPP (/SCHOOlar/...) and
// Docker (app served at web root). Loaded FIRST on every public page so
// other scripts can use window.SCHOOLAR_API / window.SCHOOLAR_PAGES.
(function () {
    var p = window.location.pathname || "";
    var base = "";
    // NOTE: '/SCHOOlar/public' must be tested before '/SCHOOlar'.
    if (p.indexOf("/SCHOOlar/public") === 0) {
        base = "/SCHOOlar/public";
    } else if (p.indexOf("/SCHOOlar") === 0) {
        base = "/SCHOOlar";
    }
    window.SCHOOLAR_BASE = base;
    // api/ is a sibling of public/ in XAMPP, and a sibling of user//admin in Docker.
    window.SCHOOLAR_API = (base === "/SCHOOlar/public") ? "/SCHOOlar/api" : base + "/api";
    // Canonical page tree: XAMPP -> /SCHOOlar/public/... ; Docker -> /...
    window.SCHOOLAR_PAGES = (base === "/SCHOOlar") ? base + "/public" : base;
})();
