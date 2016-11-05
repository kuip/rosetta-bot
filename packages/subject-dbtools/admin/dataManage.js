Template.dataManage.onCreated(function() {
	this.collections = new ReactiveVar();
	let coll = Meteor.call('getCollections');
});

Template.dataManage.helpers({
	collection: () => {
		return Template.instance.collections.get();
	}
});