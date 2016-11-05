import { Meteor } from 'meteor/meteor';
import Tools from 'meteor/kuip:subject-dbtools';


let base = process.env.PWD;
let dataFolder = base.substring(0, base.lastIndexOf('/')) + '/snomed-data/';

Tools.init('snoini');

//Tools.removeCollections('snoini');

/*Tools.importData({
	folder: dataFolder,
	chunk: 1000,
	db: 'snoini',
	sep: "\"\\t\"",
	way: 'bash'
});*/

Tools.selectActive();


