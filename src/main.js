import "./styles.css";
import projects from "./data/projects.json";
import gallery from "./data/gallery.json";
import site from "./data/site.json";
import {
    byDisplayOrder,
    emptyState,
    escapeHtml,
    galleryCard,
    icon,
    projectCard,
    revealOnScroll,
    setCurrentYear,
    setupChrome,
    setupLazyMedia
} from "./ui.js";

const marketplaceProjects = byDisplayOrder(projects).filter((project) => project.featured !== false);
const orderedGallery = byDisplayOrder(gallery);
const discordStatusMeta = {
    online: {
        label: "Online",
        className: "is-online"
    },
    idle: {
        label: "Idle",
        className: "is-idle"
    },
    dnd: {
        label: "Do not disturb",
        className: "is-dnd"
    },
    offline: {
        label: "Offline",
        className: "is-offline"
    },
    unknown: {
        label: "Status unavailable",
        className: "is-unknown"
    }
};
const discordActivityTypes = {
    0: "Playing",
    1: "Streaming",
    2: "Listening",
    3: "Watching",
    5: "Competing"
};

function applyHeroBackground() {
    if (!site.backgroundImage) return;

    document.querySelectorAll(".hero-media").forEach((element) => {
        element.style.setProperty("--hero-image", `url("${site.backgroundImage}")`);
    });
}

function replaceMetricTokens(value) {
    return String(value)
        .replace("{projectCount}", projects.length)
        .replace("{featuredProjectCount}", marketplaceProjects.length)
        .replace("{galleryCount}", orderedGallery.length);
}

function renderHero() {
    document.querySelector("[data-hero-eyebrow]").textContent = site.hero.eyebrow;
    document.querySelector("[data-hero-copy]").textContent = site.hero.copy;
    document.querySelector("[data-hero-title]").innerHTML = escapeHtml(site.hero.title).replace("Minecraft", '<span class="accent">Minecraft</span>');

    const summary = site.summary ?? {};
    const serviceTarget = document.querySelector("[data-summary-services]");
    if (serviceTarget) {
        serviceTarget.innerHTML = (summary.services ?? [])
            .map((service) => `<span>${escapeHtml(service)}</span>`)
            .join("");
    }

    const metricTarget = document.querySelector("[data-metrics]");
    if (metricTarget) {
        metricTarget.innerHTML = site.metrics
            .map(
                (metric) => `
                    <div class="metric-card">
                        <div class="metric-value">${escapeHtml(replaceMetricTokens(metric.value))}</div>
                        <div class="metric-label">${escapeHtml(metric.label)}</div>
                    </div>
                `
            )
            .join("");
    }
}

function getDiscordAvatarUrl(user, fallbackAvatar) {
    if (user?.avatar_url) return user.avatar_url;
    if (!user?.id || !user?.avatar) return fallbackAvatar;

    const extension = user.avatar.startsWith("a_") ? "gif" : "webp";
    return `https://cdn.discordapp.com/avatars/${user.id}/${user.avatar}.${extension}?size=256`;
}

function setDiscordPresence(status = "unknown", customText = "") {
    const statusKey = discordStatusMeta[status] ? status : "unknown";
    const meta = discordStatusMeta[statusKey];
    const statusText = document.querySelector("[data-discord-status-text]");
    const dot = document.querySelector("[data-discord-status-dot]");
    const card = document.querySelector("[data-discord-card]");
    const readableStatus = customText ? (statusKey === "unknown" ? customText : `${meta.label} - ${customText}`) : meta.label;

    if (statusText) {
        statusText.textContent = readableStatus;
    }

    [statusText, dot].forEach((element) => {
        if (!element) return;
        element.classList.remove("is-online", "is-idle", "is-dnd", "is-offline", "is-unknown");
        element.classList.add(meta.className);
    });

    if (card) {
        card.setAttribute("aria-label", `Open Discord profile. Current status: ${readableStatus}.`);
    }
}

function setDiscordIdentity(profile, user = null) {
    const avatar = document.querySelector("[data-discord-avatar]");
    const name = document.querySelector("[data-discord-name]");
    const card = document.querySelector("[data-discord-card]");
    const displayName = user?.global_name || user?.display_name || profile.displayName || site.name;

    if (avatar) {
        avatar.src = getDiscordAvatarUrl(user, profile.avatar || site.profileImage);
        avatar.decoding = "async";
        avatar.fetchPriority = "high";
    }

    if (name) name.textContent = displayName;
    if (card) card.href = profile.href ?? "#contact";
}

function getCustomDiscordStatus(activities = []) {
    return activities.find((activity) => activity.type === 4)?.state ?? "";
}

function getPrimaryDiscordActivity(activities = []) {
    return activities.find((activity) => activity.type !== 4 && activity.name) ?? null;
}

function formatActivityElapsed(timestamps = {}) {
    if (!timestamps.start) return "";

    const start = Number(timestamps.start);
    const startedAt = start < 1000000000000 ? start * 1000 : start;
    const elapsedMinutes = Math.max(0, Math.floor((Date.now() - startedAt) / 60000));
    const hours = Math.floor(elapsedMinutes / 60);
    const minutes = elapsedMinutes % 60;

    if (hours > 0) return `${hours}h ${minutes}m elapsed`;
    if (minutes > 0) return `${minutes}m elapsed`;
    return "Just started";
}

function renderDiscordActivity(activities = []) {
    const activity = getPrimaryDiscordActivity(activities);
    const target = document.querySelector("[data-discord-activity]");
    if (!target) return;

    if (!activity) {
        target.classList.add("is-hidden");
        return;
    }

    const type = document.querySelector("[data-discord-activity-type]");
    const name = document.querySelector("[data-discord-activity-name]");
    const detail = document.querySelector("[data-discord-activity-detail]");
    const time = document.querySelector("[data-discord-activity-time]");
    const detailText = activity.details || activity.state || "";
    const elapsed = formatActivityElapsed(activity.timestamps);

    if (type) type.textContent = discordActivityTypes[activity.type] ?? "Active";
    if (name) name.textContent = activity.name;
    if (detail) {
        detail.textContent = detailText;
        detail.hidden = !detailText;
    }
    if (time) {
        time.textContent = elapsed;
        time.hidden = !elapsed;
    }

    target.classList.remove("is-hidden");
}

function normalizeDiscordPresence(payload) {
    if (payload?.success && payload.data) {
        return {
            status: payload.data.discord_status ?? "unknown",
            activities: payload.data.activities ?? [],
            user: payload.data.discord_user ?? null
        };
    }

    const activities = payload?.activities ?? [];
    const clientStatus = payload?.client_status ?? {};
    const isEmptyOffline =
        payload?.status === "offline" &&
        activities.length === 0 &&
        Object.keys(clientStatus).length === 0;

    return {
        status: isEmptyOffline ? "unknown" : payload?.status ?? "unknown",
        activities,
        user: payload?.user ?? null
    };
}

function getDiscordPresenceUrl(profile) {
    const configuredApi =
        import.meta.env.VITE_DISCORD_PRESENCE_API ||
        profile.presenceApi ||
        "https://api.statusbadges.me/presence";
    const presenceApi = configuredApi.replace(/\/+$/, "");

    return `${presenceApi}/${encodeURIComponent(profile.userId)}`;
}

async function fetchDiscordPresence(profile) {
    if (!profile.userId) {
        setDiscordPresence("unknown", profile.fallbackStatus ?? "");
        return;
    }

    try {
        const response = await fetch(getDiscordPresenceUrl(profile), { cache: "no-store" });
        if (!response.ok) throw new Error("Discord presence request failed");

        const payload = await response.json();
        const presence = normalizeDiscordPresence(payload);

        setDiscordIdentity(profile, presence.user);
        setDiscordPresence(presence.status, getCustomDiscordStatus(presence.activities));
        renderDiscordActivity(presence.activities);
    } catch {
        setDiscordPresence("unknown", profile.fallbackStatus ?? "Status unavailable");
        renderDiscordActivity([]);
    }
}

function renderDiscordProfile() {
    const profile = site.discordProfile ?? {};
    const refreshMs = Number(profile.refreshMs) || 60000;

    setDiscordIdentity(profile);
    setDiscordPresence("unknown", profile.userId ? "Checking live status" : profile.fallbackStatus);
    renderDiscordActivity([]);
    fetchDiscordPresence(profile);

    if (profile.userId && refreshMs >= 30000) {
        window.setInterval(() => fetchDiscordPresence(profile), refreshMs);
    }
}

function serverLogoCard(logo, duplicate = false) {
    return `
        <article class="server-logo-card" ${duplicate ? 'aria-hidden="true"' : ""}>
            <img
                src="${escapeHtml(logo.image)}"
                alt="${duplicate ? "" : `${escapeHtml(logo.name)} server logo`}"
                width="220"
                height="110"
                loading="lazy"
                decoding="async"
            />
            <span>${escapeHtml(logo.name)}</span>
        </article>
    `;
}

function renderServerLogos() {
    const target = document.querySelector("[data-server-logos]");
    const logos = site.serverLogos ?? [];
    if (!target) return;

    if (!logos.length) {
        target.innerHTML = emptyState("No server logos available yet", "Add logos to public/server-logos to show them here.");
        return;
    }

    target.innerHTML = `
        <div class="logo-marquee-track">
            ${logos.map((logo) => serverLogoCard(logo)).join("")}
            ${logos.map((logo) => serverLogoCard(logo, true)).join("")}
        </div>
    `;
}

function renderProjects() {
    const target = document.querySelector("[data-featured-projects]");
    if (!target) return;

    target.innerHTML = marketplaceProjects.length
        ? marketplaceProjects.map((project, index) => projectCard(project, index)).join("")
        : emptyState("No BuiltByBit work available yet", "Check back soon for new Minecraft resources.");
}

function renderExpertise() {
    const target = document.querySelector("[data-expertise]");
    if (!target) return;

    target.innerHTML = site.expertise
        .map(
            (card, index) => `
                <article class="expertise-card reveal" style="transition-delay: ${Math.min(index * 50, 180)}ms">
                    <div class="icon-box">${icon(card.icon)}</div>
                    <h3 class="mt-5 text-xl">${escapeHtml(card.title)}</h3>
                    ${card.copy ? `<p class="expertise-copy">${escapeHtml(card.copy)}</p>` : ""}
                    <ul>
                        ${card.items.map((item) => `<li>${icon("check")}<span>${escapeHtml(item)}</span></li>`).join("")}
                    </ul>
                </article>
            `
        )
        .join("");
}

function renderStudio() {
    const studio = site.studio;
    if (!studio) return;

    const logo = document.querySelector("[data-studio-logo]");
    if (logo) {
        logo.src = studio.logo;
    }

    document.querySelector("[data-studio-eyebrow]").textContent = studio.eyebrow ?? "";
    document.querySelector("[data-studio-title]").textContent = studio.title ?? studio.name ?? "";
    document.querySelector("[data-studio-copy]").textContent = studio.copy ?? "";

    const serviceTarget = document.querySelector("[data-studio-services]");
    if (serviceTarget) {
        serviceTarget.innerHTML = (studio.services ?? []).map((service) => `<span>${escapeHtml(service)}</span>`).join("");
    }

    const linkTarget = document.querySelector("[data-studio-links]");
    if (linkTarget) {
        linkTarget.innerHTML = (studio.links ?? [])
            .map(
                (link) => `
                    <a class="${link.primary ? "primary-button" : "secondary-button"}" href="${escapeHtml(link.href)}" target="_blank" rel="noopener noreferrer">
                        ${icon(link.icon)} ${escapeHtml(link.label)}
                    </a>
                `
            )
            .join("");
    }
}

function renderGalleryPreview() {
    const target = document.querySelector("[data-gallery-preview]");
    if (!target) return;

    if (!orderedGallery.length) {
        target.innerHTML = emptyState("No gallery images available yet", "Screenshots will appear here once they are added.");
        return;
    }

    const previewCards = orderedGallery.slice(0, 4).map((item, index) => galleryCard(item, index, { eager: false })).join("");
    target.innerHTML = `
        ${previewCards}
        <a class="gallery-card view-more reveal" href="/gallery/">
            <div class="icon-box mx-auto">${icon("image")}</div>
            <h3 class="mt-5 text-2xl">View Full Gallery</h3>
            <p class="mt-3 text-sm leading-6 text-slate-400">Open all ${orderedGallery.length} exported previews.</p>
            <span class="card-link justify-center">Browse Gallery ${icon("arrow")}</span>
        </a>
    `;
}

function renderContacts() {
    const target = document.querySelector("[data-contact-links]");
    if (!target) return;

    target.innerHTML = site.contacts
        .map(
            (contact) => `
                <a class="contact-card" href="${escapeHtml(contact.href)}" target="_blank" rel="noopener noreferrer">
                    <span class="icon-box">${icon(contact.icon)}</span>
                    <span>
                        <h3>${escapeHtml(contact.label)}</h3>
                        <p>${escapeHtml(contact.detail)}</p>
                    </span>
                </a>
            `
        )
        .join("");
}

applyHeroBackground();
renderHero();
renderDiscordProfile();
renderServerLogos();
renderProjects();
renderStudio();
renderExpertise();
renderGalleryPreview();
renderContacts();
setupChrome();
setCurrentYear();
setupLazyMedia();
revealOnScroll();
