module.exports = {
  proxy: "https://cardtho.local/", // Vervang door ontwikkel url
  files: ["**/*"],
  watchOptions: {
    ignoreInitial: false,
  },
  notify: true,
  open: false,
  reloadDelay: 0,
  port: 3000, // Hier komt de proxy op te staan
};
