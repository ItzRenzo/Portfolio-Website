import { icon } from "./icons.js";

export function escapeHtml(value = "") {
    return String(value)
        .replaceAll("&", "&amp;")
        .replaceAll("<", "&lt;")
        .replaceAll(">", "&gt;")
        .replaceAll('"', "&quot;")
        .replaceAll("'", "&#039;");
}

export function byDisplayOrder(items) {
    return [...items].sort((a, b) => (a.displayOrder ?? 0) - (b.displayOrder ?? 0) || (a.id ?? 0) - (b.id ?? 0));
}

export function cleanTags(tags = []) {
    return tags.map((tag) => String(tag).trim()).filter(Boolean);
}

export function projectCard(project, index = 0) {
    const tags = cleanTags(project.tags).slice(0, 6);
    const image = project.imageUrl
        ? `<img src="${escapeHtml(project.imageUrl)}" alt="${escapeHtml(project.title)} project preview" loading="${index === 0 ? "eager" : "lazy"}" />`
        : `<div class="grid h-full place-items-center text-cyan-200">${icon("package")}</div>`;
    const link = project.externalUrl
        ? `<a class="card-link" href="${escapeHtml(project.externalUrl)}" target="_blank" rel="noopener noreferrer">View Project ${icon("external")}</a>`
        : "";

    return `
        <article class="project-card reveal" style="transition-delay: ${Math.min(index * 45, 180)}ms">
            <div class="project-image">${image}</div>
            <div class="project-body">
                ${project.category ? `<span class="project-meta">${escapeHtml(project.category)}</span>` : ""}
                <h3>${escapeHtml(project.title)}</h3>
                <p class="mt-3">${escapeHtml(project.description)}</p>
                ${
                    tags.length
                        ? `<div class="project-tags">${tags.map((tag) => `<span>${escapeHtml(tag)}</span>`).join("")}</div>`
                        : ""
                }
                ${link}
            </div>
        </article>
    `;
}

export function galleryCard(item, index = 0) {
    return `
        <a class="gallery-card reveal" style="transition-delay: ${Math.min(index * 35, 180)}ms" href="${escapeHtml(item.imageUrl)}" target="_blank" rel="noopener noreferrer">
            <div class="gallery-image">
                <img src="${escapeHtml(item.imageUrl)}" alt="${escapeHtml(item.title)} screenshot" loading="${index < 2 ? "eager" : "lazy"}" />
            </div>
            <div class="gallery-body">
                <h3>${escapeHtml(item.title)}</h3>
                ${item.description ? `<p class="mt-2">${escapeHtml(item.description)}</p>` : ""}
                <span class="card-link">Open Image ${icon("external")}</span>
            </div>
        </a>
    `;
}

export function emptyState(title, copy) {
    return `
        <div class="project-card p-8 text-center">
            <div class="mx-auto mb-4 icon-box">${icon("image")}</div>
            <h3 class="font-display text-xl font-black text-white">${escapeHtml(title)}</h3>
            <p class="mt-2 text-sm leading-6 text-slate-400">${escapeHtml(copy)}</p>
        </div>
    `;
}

export function setupChrome() {
    const header = document.querySelector("[data-site-header]");
    const menuToggle = document.querySelector("[data-menu-toggle]");
    const mobileMenu = document.querySelector("[data-mobile-menu]");

    const updateHeader = () => header?.classList.toggle("is-scrolled", window.scrollY > 8);
    updateHeader();
    window.addEventListener("scroll", updateHeader, { passive: true });

    if (menuToggle && mobileMenu) {
        menuToggle.addEventListener("click", () => {
            const expanded = menuToggle.getAttribute("aria-expanded") === "true";
            menuToggle.setAttribute("aria-expanded", String(!expanded));
            mobileMenu.classList.toggle("hidden", expanded);
        });

        mobileMenu.querySelectorAll("a").forEach((link) => {
            link.addEventListener("click", () => {
                menuToggle.setAttribute("aria-expanded", "false");
                mobileMenu.classList.add("hidden");
            });
        });
    }
}

export function revealOnScroll() {
    const elements = [...document.querySelectorAll(".reveal")];
    if (!elements.length) return;

    if (window.matchMedia("(prefers-reduced-motion: reduce)").matches || !("IntersectionObserver" in window)) {
        elements.forEach((element) => element.classList.add("is-visible"));
        return;
    }

    const observer = new IntersectionObserver(
        (entries) => {
            entries.forEach((entry) => {
                if (entry.isIntersecting) {
                    entry.target.classList.add("is-visible");
                    observer.unobserve(entry.target);
                }
            });
        },
        { threshold: 0.15 }
    );

    elements.forEach((element) => observer.observe(element));
}

export function setCurrentYear() {
    document.querySelectorAll("[data-current-year]").forEach((element) => {
        element.textContent = new Date().getFullYear();
    });
}

export { icon };
