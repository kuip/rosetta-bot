Package.describe({
  name: 'kuip:subject-dbtools',
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
  "jugglingdb": "2.0.0-rc8",
  "jugglingdb-mysql": "0.2.3",
});

Package.onUse(function(api) {
  api.versionsFrom('1.4.1');
  api.use('ecmascript');
  api.mainModule('subject-dbtools.js');
});

Package.onTest(function(api) {
  api.use('ecmascript');
  api.use('tinytest');
  api.use('kuip:subject-dbtools');
  api.mainModule('subject-dbtools-tests.js');
});
