import { defineConfig } from "vite";
import laravel from "laravel-vite-plugin";
import viteSvgSpriteWrapper from "vite-svg-sprite-wrapper";
import viteCompression from "vite-plugin-compression";
import tailwindcss from "@tailwindcss/vite";

export default defineConfig({
	base: "",
	build: {
		manifest: true,
		outDir: "dist",
		assetsDir: "src",
	},
	plugins: [
		tailwindcss(),
		laravel({
			publicDirectory: "dist",
			input: [
				"src/stylesheets/styles.css",
				"src/scripts/app.js",
				"src/img/svg/logo-small.svg",
				"src/img/svg/logo.svg",
				"src/img/svg/pin.svg",
				"src/img/png/logo-agora-makers.png",
			],
			refresh: ["**/*.php", "**/*.twig"],
		}),
		viteSvgSpriteWrapper({
			icons: "src/icons/*.svg",
			outputDir: "public",
		}),
		viteCompression(),
	],
});
