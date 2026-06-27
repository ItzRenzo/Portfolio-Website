import "./styles.css";
import gallery from "./data/gallery.json";
import { byDisplayOrder, emptyState, galleryCard, revealOnScroll, setCurrentYear, setupChrome } from "./ui.js";

const target = document.querySelector("[data-gallery-list]");
const orderedGallery = byDisplayOrder(gallery);

if (target) {
    target.innerHTML = orderedGallery.length
        ? orderedGallery.map((item, index) => galleryCard(item, index)).join("")
        : emptyState("No gallery images available yet", "Screenshots will appear here once they are added.");
}

setupChrome();
setCurrentYear();
revealOnScroll();
