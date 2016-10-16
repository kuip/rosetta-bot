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
//console.log(Schema);

//var schema = new Schema('arango', {
//	url: `http://${username}:${password}@127.0.0.1:8529`,///_db/snoini',
//});

//let db = new arango.Database(`http://${username}:${password}@127.0.0.1:8529`);
//db.useDatabase('snoini');

/*db.collections()
.then(collections => {
    collections.forEach(c => {
        c.drop();
    });
});*/

// Import ontology data

// Read data from folder. Each ontology translation is put in a separate folder
// that fold










/*schema = new Schema('mysql', {
	host: '192.168.1.117',
	port: '3306',
    database: dbName,
    username: username,
    password: password
});*/

//console.log(schema)

//var Post = schema.define('dsd', {
//    title:     { type: String, length: 255 },
    //content:   { type: Schema.Text },
    //date:      { type: Date,    default: function () { return new Date;} },
    //timestamp: { type: Number,  default: Date.now },
    //published: { type: Boolean, default: false, index: true }
//});

//console.log(Post)

//console.log(Post)

//Post.create({title: "sfdsfffds"}, function(err, user) {
    //console.log(err);
//    console.log(user)
//});

/*importFile = (file) => {

}*/

