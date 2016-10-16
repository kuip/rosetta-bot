import { Schema } from 'jugglingdb';
import 'jugglingdb-arango';
import * as arango from 'arangojs';
import * as Baby from 'babyparse';
import fs from 'fs';
import { exec } from 'child_process';
import { username, password } from './credentials.js';

let removeCollections = (name) => {
    let db = new arango.Database('http://' + username + ':' + password + '@127.0.0.1:8529');
    db.useDatabase(name);

    db.collections()
    .then(collections => {
        collections.forEach(c => {
            c.drop();
        });
    });
}
