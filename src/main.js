import "./styles.css";
import projects from "./data/projects.json";
import gallery from "./data/gallery.json";
import site from "./data/site.json";
import { byDisplayOrder, emptyState, escapeHtml, galleryCard, icon, projectCard, revealOnScroll, setCurrentYear, setupChrome } from "./ui.js";

const featuredProjects = byDisplayOrder(projects).filter((project) => project.featured);
const orderedGallery = byDisplayOrder(gallery);

function replaceMetricTokens(value) {
    return String(value)
        .replace("{projectCount}", projects.length)
        .replace("{featuredProjectCount}", featuredProjects.length)
        .replace("{galleryCount}", orderedGallery.length);
}

function renderHero() {
    document.querySelector("[data-hero-eyebrow]").textContent = site.hero.eyebrow;
    document.querySelector("[data-hero-copy]").textContent = site.hero.copy;
    document.querySelector("[data-hero-title]").innerHTML = escapeHtml(site.hero.title).replace("Minecraft", '<span class="accent">Minecraft</span>');

    const profileImage = document.querySelector("[data-profile-image]");
    if (profileImage) {
        profileImage.src = site.profileImage;
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

    const consoleTarget = document.querySelector("[data-console-points]");
    if (consoleTarget) {
        consoleTarget.innerHTML = site.consolePoints
            .map(
                (point) => `
                    <div class="console-point">
                        ${icon("check")}
                        <span>${escapeHtml(point)}</span>
                    </div>
                `
            )
            .join("");
    }
}

function renderTrustStrip() {
    const target = document.querySelector("[data-trust-strip]");
    if (!target) return;

    target.innerHTML = site.trust
        .map(
            (item) => `
                <div class="trust-pill">
                    <strong>${escapeHtml(item.label)}</strong>
                    <span>${escapeHtml(item.description)}</span>
                </div>
            `
        )
        .join("");
}

function renderProjects() {
    const target = document.querySelector("[data-featured-projects]");
    if (!target) return;

    target.innerHTML = featuredProjects.length
        ? featuredProjects.map((project, index) => projectCard(project, index)).join("")
        : emptyState("No projects available yet", "Check back soon for featured Minecraft builds.");
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
                    <ul>
                        ${card.items.map((item) => `<li>${icon("check")}<span>${escapeHtml(item)}</span></li>`).join("")}
                    </ul>
                </article>
            `
        )
        .join("");
}

function renderGalleryPreview() {
    const target = document.querySelector("[data-gallery-preview]");
    if (!target) return;

    if (!orderedGallery.length) {
        target.innerHTML = emptyState("No gallery images available yet", "Screenshots will appear here once they are added.");
        return;
    }

    const previewCards = orderedGallery.slice(0, 5).map((item, index) => galleryCard(item, index)).join("");
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

renderHero();
renderTrustStrip();
renderProjects();
renderExpertise();
renderGalleryPreview();
renderContacts();
setupChrome();
setCurrentYear();
revealOnScroll();
