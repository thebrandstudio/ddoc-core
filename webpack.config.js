module.exports = {
    entry: {
        admin: './module/droit-header-footer-builder/src/admin.js',
      },
      output: {
        filename: '[name].js',
        path: __dirname + '/module/droit-header-footer-builder/assets/scripts',
      },
      externals: {
        jquery: 'jQuery',
      },
    
}