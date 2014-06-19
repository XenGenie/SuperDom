x4.magnet = {
	Index	: Ext.extend(Ext.Panel,{
		title		: 'Lead Magnet&#0153; Generator',
		id			: 'lead-magnet',
		iconCls		: 'x-icon-16x16-magnet_blue',
		//bodyStyle	: 'background-image: url(/bin/images/bgs/transparent-3x.png)',
		layout		: 'fit',
		maximized 	: true,
		plain		: true,
		border		: false,	
		tbar		: [{
			text	: 'New Magnet',
			iconCls	: 'x-icon-16x16-magnet_plus',
			iconAlign : 'top',
			handler	: function(){
				xMagnet.newMagnetWin().show(null,function(){
					setTimeout(function(){
						Ext.getCmp('form-url').focus();
					},899);
				});
		    }
		},{
			text	: 'All Headlines',
			iconCls	: 'x-icon-16x16-tag_blue',
			iconAlign : 'top',
			handler	: xMagnet.allHeadlines				
		},'->',{
			text	: 'Show Delete',
			iconCls	: 'x-icon-16x16-magnet_minus',
			iconAlign : 'top',
			enableToggle: true,
			handler	: function(){
				$('.del-button').toggle()
			}
		}],
		bbar	: ['->',
	   		'<img src="{$ICON.16}/world.png" align="absmiddle" title="Total Magnets" /> <span id="magnet-count"></span>',
	   		'<img src="{$ICON.16}/eye.png" align="absmiddle"  title="Total Views" />  <span id="view-count">{$count_page_views}</span> |',
	   		'<img src="{$ICON.16}/user.png" align="absmiddle" title="Total Conversions" />  <span id="user-count">{$count_conversions}</span> |',
	   		'<img src="{$ICON.16}/thumb_up.png" align="absmiddle" title="Total Conversion Rate" />  <span id="conversion-rate"></span>','->'
		],
		initComponent	: function(){
			x4.magnet.Index.superclass.initComponent.call(this);
		}
	})
};