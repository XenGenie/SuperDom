x4.Topic = Ext.extend(Ext.Panel, {
	layout	: 'fit',
	autoScroll: true, 
	listeners:{
		activate : function(tabpanel){
			tabpanel.getUpdater().refresh();
			tabpanel.doLayout();
		}
	},
	
	initComponent: function() {
		var topic_id = this.id; 
		var title = this.fulltitle;

		function quickReply(field){
			Ext.Msg.prompt('Posting Reply','Enter a title/subject for your post? (Optional)',function(btn,value){
				var html	 = field.getValue();
				var title 	 = value; 
				field.setValue('');
				var quickReply = function(){
					Ext.Msg.wait(
						x4.lang.wait,
						sys.getIcon('user_comment')+'Posting Reply'
					);
					$$.Forums.quickReply(topic_id,html,title,function(r){
						Ext.Msg.hide();
						sys.msg('Post Success!','Your Reply has been Posted');	
						Ext.getCmp('topic-'+r.data.topic_id).getUpdater().refresh(function(){
							Ext.get('post-'+r.data.post_id).dom.scrollIntoView();
						});
					});
				}
				x4.doAction(quickReply);
			});	
		} 
		x4.Topic.superclass.initComponent.call(this);
    }
});