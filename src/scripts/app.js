import { load } from "piecesjs";

// Invoker commands (commandfor) open the drawers and modals: Safari before 26.2 needs the polyfill.
if (!("commandForElement" in HTMLButtonElement.prototype)) {
	await import("invokers-polyfill");
}

await import("@agencecinq/drawer");

load("cinq-accordion", () => import("@agencecinq/accordion"));
load("cinq-modal", () => import("@agencecinq/modal"));
load("blossom-carousel", () => import("@blossom-carousel/web"));
load("cinq-mobile-menu", () => import("./components/MobileMenu.ts"));
