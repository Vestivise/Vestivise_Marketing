(function(){
	tinymce.PluginManager.add('phase_shortcode_tc_button',function( editor,url){editor.addButton('phase_shortcode_tc_button',{
			title:'Phase Short Codes',
			type:'menubutton',
			icon:'icon dashicons-index-card',
			menu:[{
				text:'Buttons',
				value:'Buttons',
				onclick:function(){
					editor.windowManager.open({
						title:'Inset a button',
						body:[{
							type:'textbox',
							name:'text',
							label:'Button Text'
				        },
				        {
							type:'textbox',
							name:'link',
							label:'Button Link'
				        },
				        {
				            type:'listbox',
				            name:'color',
				            label:'Button Color',
				            'values':[
				                {text:'Black',value:'black'},
				                {text:'Blue',value:'blue'},
				                {text:'Green',value:'green'},
				                {text:'Orange',value:'orange'},
				                {text:'Red',value:'red'},
				                {text:'Turqoise',value:'turqoise'},
				                {text:'Yellow',value:'yellow'}
				            ]
				        },
				        {
				            type:'listbox',
				            name:'size',
				            label:'Button Size',
				            'values':[
				                {text:'Medium',value:'medium'},
				                {text:'Small',value:'small'},
				                {text:'Large',value:'Large'}
				            ]
				        },
						{
				            type:'listbox',
				            name:'type',
				            label:'Button Type',
				            'values':[
				                {text:'Square',value:'square'},
				                {text:'Rounded',value:'round'}
				            ]
				        }
						],
				        onsubmit:function(e){
				            editor.insertContent('[button'+' url="'+e.data.link+'" color="'+e.data.color+'" size="'+e.data.size+'" type="'+e.data.type+'"]'+e.data.text+'[/button]');
				        }
				    });
				}
			},
			{
				text:'Alerts',
				value:'alerts',
				onclick:function(){
					editor.windowManager.open({
						title:'Inset an alert bar',
						body:[{
							type:'textbox',
							name:'text',
							label:'Alert Text'
				        },
				        {
				            type:'listbox',
				            name:'color',
				            label:'Button Color',
				            'values':[
				                {text:'Blue',value:'blue'},
				                {text:'Green',value:'green'},
				                {text:'Red',value:'red'},
				                {text:'Yellow',value:'yellow'},
				            ]
				        }
						],
				        onsubmit:function(e){
				            editor.insertContent('[alert'+' color="'+e.data.color+'"]'+e.data.text+'[/alert]');
				        }
				    });
				}
			},
			{
				text:'Highlights',
				value:'Highlights',
				onclick:function(){
					editor.windowManager.open({
						title:'Inset an Highlighted Text',
						body:[{
							type:'textbox',
							name:'text',
							label:'Highlight Text'
				        },
				        {
				            type:'listbox',
				            name:'color',
				            label:'Highlight Color',
				            'values':[
				                {text:'Blue',value:'blue'},
				                {text:'Green',value:'green'},
				                {text:'Red',value:'red'},
				                {text:'Yellow',value:'yellow'}
				            ]
				        },
				        {
				            type:'listbox',
				            name:'style',
				            label:'Highlight Style',
				            'values':[
				                {text:'Normal',value:'normal'},
				                {text:'Italic',value:'italic'},
				                {text:'Bold',value:'bold'},
				                {text:'Bold Italic',value:'bold italic'}
				            ]
				        }
						],
				        onsubmit:function(e){
				            editor.insertContent('[highlight'+' color="'+e.data.color+'" style="'+e.data.style+'"]'+e.data.text+'[/highlight]');
				        }
				    });
				}
			}
			]
        });
    });
})();