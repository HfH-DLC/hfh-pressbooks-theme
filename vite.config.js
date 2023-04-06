import { resolve } from "path";
import { defineConfig } from "vite";
import autoprefixer from "autoprefixer";

export default defineConfig(({ mode }) => {
  return {
    plugins: [],
    define: {
      "process.env.NODE_ENV": JSON.stringify(mode),
    },
    css: {
      postcss: {
        plugins: [autoprefixer],
      },
    },
    build: {
      cssCodeSplit: true,
      lib: {
        // Could also be a dictionary or array of multiple entry points
        entry: [
          resolve(__dirname, "src/main.js"),
          resolve(__dirname, "src/editor.js"),
          resolve(__dirname, "src/h5p.js"),
        ],
        name: "HfhPressbooksThemeAssets",
        // the proper extensions will be added
        fileName: "[name]",
      },
      rollupOptions: {},
    },
  };
});
