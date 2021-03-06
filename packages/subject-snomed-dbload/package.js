Package.describe({
  name: 'kuip:subject-snomed-dbload',
  version: '0.0.1',
  // Brief, one-line summary of the package.
  summary: '',
  // URL to the Git repository containing the source code for this package.
  git: '',
  // By default, Meteor will default to using README.md for documentation.
  // To avoid submitting documentation, set this field to null.
  documentation: 'README.md'
});


Npm.depends({
  "papaparse": "4.1.2"
});

Package.onUse(function(api) {
  api.versionsFrom('1.4.1');
  api.use('ecmascript');
  api.mainModule('main.js', 'server');
});

Package.onTest(function(api) {
  api.use('ecmascript');
  api.use('tinytest');
  api.use('kuip:subject-snomed-dbload');
  api.mainModule('subject-snomed-dbload-tests.js');
});
