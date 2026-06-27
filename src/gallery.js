import "./styles.css";
import gallery from "./data/gallery.json";
import site from "./data/site.json";
import { byDisplayOrder, emptyState, galleryCard, revealOnScroll, setCurrentYear, setupChrome, setupLazyMedia } from "./ui.js";

const target = document.querySelector("[data-gallery-list]");
const orderedGallery = byDisplayOrder(gallery);

if (site.backgroundImage) {
    document.querySelectorAll(".hero-media").forEach((element) => {
        element.style.setProperty("--hero-image", `url("${site.backgroundImage}")`);
    });
}

if (target) {
    target.innerHTML = orderedGallery.length
        ? orderedGallery.map((item, index) => galleryCard(item, index, { eager: false })).join("")
        : emptyState("No gallery images available yet", "Screenshots will appear here once they are added.");
}

setupChrome();
setCurrentYear();
setupLazyMedia();
revealOnScroll();
