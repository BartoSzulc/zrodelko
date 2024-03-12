import { domReady } from "@roots/sage/client";

import WooGallery from "./components/WooGallery";
import WooQuantity from "./components/WooQuantity";

const main = async (err) => {
  if (err) {
    // handle hmr errors
    console.error(err);
  }

  // WooGallery
  const _gallery = new WooGallery();
  _gallery.init();

  // WooQuantity
  const _quantity = new WooQuantity();
  _quantity.init();
};

/**
 * Initialize
 *
 * @see https://webpack.js.org/api/hot-module-replacement
 */
domReady(main);
import.meta.webpackHot?.accept(main);
