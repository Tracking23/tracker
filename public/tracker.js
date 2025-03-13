(function () {
    function getCookie(name) {
        const cookies = document.cookie.split('; ');
        for (let cookie of cookies) {
            let [key, value] = cookie.split('=');
            if (key === name) return value;
        }
        return null;
    }

    function setCookie(name, value, days) {
        let expires = new Date();
        expires.setTime(expires.getTime() + days * 24 * 60 * 60 * 1000);
        document.cookie = `${name}=${value}; expires=${expires.toUTCString()}; path=/; SameSite=Lax`;
    }

    function getOrCreateVisitorID() {
        let visitorID = getCookie("visitor_id");
        if (!visitorID) {
            // Generate new visitor ID if cookie doesn't exist
            let today = new Date().toISOString().split("T")[0]; // YYYY-MM-DD
            visitorID = `v-${today}-${Math.random().toString(36).substr(2, 9)}`;
            setCookie("visitor_id", visitorID, 1); // Store for 1 day (24 hours)
        }
        return visitorID;
    }

    async function sendVisitData() {
        // Get the existing visitor ID or create one if not present
        let visitorID = getOrCreateVisitorID(); 

        try {
            let response = await fetch('https://api64.ipify.org?format=json');
            let data = await response.json();
            let ip = data.ip;

            // Send the tracking data to the backend
            await fetch("http://tracker.test/api/track", {
                method: "POST",
                headers: { "Content-Type": "application/json" },
                body: JSON.stringify({
                    page_url: window.location.href,
                    ip_address: ip,
                    visitor_id: visitorID,
                    user_agent: navigator.userAgent,
                    referrer: document.referrer || ""
                })
            });

            console.log("Tracking sent.");

            // Set cookie to prevent further tracking today
            setCookie("visited_today", "true", 1); // 1-day expiry
        } catch (error) {
            console.error("Tracking failed:", error);
        }
    }

    document.addEventListener("DOMContentLoaded", sendVisitData);
})();
