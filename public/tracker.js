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
            let today = new Date().toISOString().split("T")[0];
            visitorID = `v-${today}-${Math.random().toString(36).substr(2, 9)}`;
            setCookie("visitor_id", visitorID, 1);
        }
        return visitorID;
    }

    async function sendVisitData() {
        let visitorID = getOrCreateVisitorID(); 

        try {
            let response = await fetch('https://api64.ipify.org?format=json');
            let data = await response.json();
            let ip = data.ip;

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
            setCookie("visited_today", "true", 1);
        } catch (error) {
            
        }
    }

    document.addEventListener("DOMContentLoaded", sendVisitData);
})();
