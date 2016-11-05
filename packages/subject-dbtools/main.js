import { Schema } from 'jugglingdb';
import 'jugglingdb-arango';
import * as arango from 'arangojs';
import * as Baby from 'babyparse';
import fs from 'fs';
import { exec } from 'child_process';
import { username, password } from './credentials.js';


export default Tools = {
    chunkData: (data, no) => {
        let res = [], i,
            max = Math.floor(data.length / no);

        for(i=0; i < max; i++) {
            res[i] = data.splice(0, no);
        }
        res[i] = data;
        return res;
    },

    jsImport: (collectionName, filePath, opts) => {
        let { db, sep, chunk } = opts;
        // Get array of documents as objets
        let parsed = Baby.parseFiles(filePath, {
            header: true,
            delimiter: '\t',
        });

        // Chunk data, so we can better log the process
        let data = chunkData(parsed.data, chunk);
        console.log(`length ${ data.length }`);
        //console.log(collectionName)

        let coll = db.collection(collectionName);
        coll.create()
            .then(() => {
                data.forEach((ch, n) => {
                    let res = coll.import(ch, {details: true, complete: true}, (error, result) => {
                        if(error)
                            console.log(error);
                        else {
                            console.log(JSON.stringify(result));
                            console.log(`------ imported chunk ${ n } of ${ ch.length } from ${ collectionName } - total of ${ data.length } chunks`);
                        }
                    });
                });
            });
    },

    bashImport: (collectionName, filePath, opts) => {
        let { db, sep } = opts;

        let command = `arangoimp --file ${ filePath } --type csv --separator ${ sep } --collection ${ collectionName } --create-collection true --server.database ${ db } --server.username ${ username } --server.password ${ password } --server.request-timeout 100000 --overwrite true --progress true --batch-size 4000554432`;

        exec(command, (error, stdout, stderr) => {
          if (error) {
            console.error(`exec error: ${error}`);
            return;
          }
          console.log(`stdout: ${stdout}---------------`);
          console.log(`stderr: ${stderr}---------------`);
        });
    },

    importData: (opts) => {
        let { folder, way } = opts
        let folders = fs.readdirSync(folder, 'utf8');

        folders.forEach((f) => {
            if(f.substring(0, 1) == '.')
                return;

            let files = fs.readdirSync(`${ folder }/${ f }/`, 'utf8');
            files.forEach((file) => {
                // System files
                if(file.substring(0, 1) == '.')
                    return;

                // Only load the terminology + language refsets
                let languageRef = file.indexOf('anguage') > -1;
                if(file.indexOf('sct') == -1 &&  !languageRef)
                    return;

                let filePath = `${ folder }/${ f }/${ file }`,
                    tempName = languageRef ? file.substring(file.indexOf('-')+1) : file.substring(file.indexOf('_')+1),
                    collectionName = `${ f }_${ 
                        (languageRef ? 'LanguageRefSet-' : '') +
                        tempName.substring(0, tempName.indexOf('_')) 
                    }`;

                //collectionName = collectionName
                    //.substring(0, collectionName.indexOf('.'))
                    //.replace('_', '');


                // Remove wierd characters
                for(let j=0; j < collectionName.length; j++) {
                    if(collectionName.charCodeAt(j) > 127)
                        collectionName = collectionName.substring(0, j) + collectionName.substring(j+1);
                }
                
                // 64 bytes max for arango
                collectionName = collectionName.substring(0, 62);

                Tools[way+'Import'](collectionName, filePath, opts);
            });
        });
    },
    removeCollections: (name) => {
        let db = new arango.Database('http://' + username + ':' + password + '@127.0.0.1:8529');
        db.useDatabase(name);

        db.collections()
        .then(collections => {
            collections.forEach(c => {
                c.drop();
            });
        });
    }
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

