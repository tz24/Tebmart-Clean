<?php
$shortcodes = array(

	'basic' => array(
	
		'nicename' => 'Basic Shortcodes',
		'options' => array (
		
			'button' => array(
			  'name' => 'Button',
			  'type' => 'wrap',
			  'oneline' => true,
			  'atts' => array(
				 array(
					'name' => 'id',
					'type' => 'input',
					'desc' => 'ID (optional)'
				 ),
				 array(
					'name' => 'class',
					'type' => 'input',
					'desc' => 'Class (optional)'
				 ),
				 array(
					'name' => 'size',
					'type' => 'select',
					'default' => 'xsmall,small,normal,medium,large,xlarge,xxlarge',
					'desc' => 'Size'
				 ),
				 array(
					'name' => 'link',
					'type' => 'input',
					'desc' => 'Link'
				 ),
				 array(
					'name' => 'target',
					'type' => 'select',
					'default' => '_self,_blank',
					'desc' => 'Link Target'
				 ),
				 array(
					'name' => 'color',
					'type' => 'select',
					'default' => 'blue,green,red,yellow,gray',
					'desc' => 'Color'
				 ),
				 array(
					'name' => 'bgcolor',
					'type' => 'colorpicker',
					'default' => '',
					'desc' => 'BG Color (optional)'
				 ),
				 array(
					'name' => 'bghover',
					'type' => 'colorpicker',
					'default' => '',
					'desc' => 'BG HOVER Color (optional)'
				 ),
				 array(
					'name' => 'textcolor',
					'type' => 'colorpicker',
					'default' => '',
					'desc' => 'TEXT Color (optional)'
				 ),
				 array(
					'name' => 'bghovertext',
					'type' => 'colorpicker',
					'default' => '',
					'desc' => 'BG HOVER TEXT Color (optional)'
				 ),
				 array(
					'name' => 'align',
					'type' => 'select',
					'default' => 'left,center,right,full',
					'desc' => 'Align (optional)'
				 )
			  ),
			  'content' => 'Click me',
			  'desc' => 'Button'
			),
			
			'slider' => array(
			  'name' => 'Slider',
			  'type' => 'single',
			  'oneline' => true,
			  'atts' => array(
				 array(
					'name' => 'id',
					'type' => 'select',
					'default' => '[sliders],[all],[asc],[id]',
					'desc' => 'Choose a Slider'
				 )
			  ),
			  'desc' => 'Slider'
			),
			
			'portfolio' => array(
			  'name' => 'Portfolio',
			  'type' => 'single',
			  'oneline' => true,
			  'atts' => array(
				 array(
					'name' => 'cat',
					'type' => 'select',
					'default' => '[categories],[all],[desc],[id]',
					'attr' => 'multiple="multiple"',
					'desc' => 'Choose Blog Categories'
				 ),
				 array(
					'name' => 'columns',
					'type' => 'select',
					'default' => '1,2,3,4,5,6',
					'desc' => 'Columns (optional)'
				 ),
				 array(
					'name' => 'count',
					'type' => 'slider_ui',
					'default' => '10,100,1,item',
					'desc' => 'Number of posts to show per page'
				 ),
				 array(
					'name' => 'pagenavi',
					'type' => 'on_off_ui',
					'default' => 'on',
					'desc' => 'PageNavi'
				 ),
				 array(
					'name' => 'ptitle',
					'type' => 'on_off_ui',
					'default' => 'on',
					'desc' => 'Post Title'
				 ),
				 array(
					'name' => 'linking',
					'type' => 'on_off_ui',
					'default' => 'off',
					'desc' => 'Post Title as Link'
				 ),
				 array(
					'name' => 'desc',
					'type' => 'on_off_ui',
					'default' => 'on',
					'desc' => 'Display Post Description'
				 ),
				 array(
					'name' => 'more',
					'type' => 'on_off_ui',
					'default' => 'on',
					'desc' => 'Display Read More Link'
				 ),
				 array(
					'name' => 'width',
					'type' => 'slider_ui',
					'default' => '0,1000,1,px',
					'desc' => 'Thumbnail Width (optional)'
				 ),
				 array(
					'name' => 'height',
					'type' => 'slider_ui',
					'default' => '0,1000,1,px',
					'desc' => 'Thumbnail Height (optional)'
				 )
			  ),
			  'desc' => 'Portfolio'
			),
			
			'blog' => array(
			  'name' => 'Blog',
			  'type' => 'single',
			  'oneline' => true,
			  'atts' => array(
				 array(
					'name' => 'cat',
					'type' => 'select',
					'default' => '[categories],[all],[desc],[id]',
					'attr' => 'multiple="multiple"',
					'desc' => 'Choose Blog Categories'
				 ),
				 array(
					'name' => 'columns',
					'type' => 'select',
					'default' => '1,2,3,4,5,6',
					'desc' => 'Columns (optional)'
				 ),
				 array(
					'name' => 'layout',
					'type' => 'select',
					'default' => 'left,full,right',
					'desc' => 'Featured Image Layout (optional)'
				 ),
				 array(
					'name' => 'count',
					'type' => 'slider_ui',
					'default' => '10,100,1,item',
					'desc' => 'Number of posts to show per page'
				 ),
				 array(
					'name' => 'pagenavi',
					'type' => 'on_off_ui',
					'default' => 'on',
					'desc' => 'PageNavi'
				 ),
				 array(
					'name' => 'meta',
					'type' => 'on_off_ui',
					'default' => 'on',
					'desc' => 'Display Post Meta'
				 ),
				 array(
					'name' => 'desc',
					'type' => 'on_off_ui',
					'default' => 'on',
					'desc' => 'Display Post Description'
				 ),
				 array(
					'name' => 'more',
					'type' => 'on_off_ui',
					'default' => 'on',
					'desc' => 'Display Read More Link'
				 ),
				 array(
					'name' => 'width',
					'type' => 'slider_ui',
					'default' => '0,1000,1,px',
					'desc' => 'Thumbnail Width (optional)'
				 ),
				 array(
					'name' => 'height',
					'type' => 'slider_ui',
					'default' => '0,1000,1,px',
					'desc' => 'Thumbnail Height (optional)'
				 )
			  ),
			  'desc' => 'Blog'
			),
		   
			'contact' => array(
			  'name' => 'Contact',
			  'type' => 'wrap',
			  'oneline' => true,
			  'atts' => array(
					array(
						'name' => 'to',
						'type' => 'input',
						'default' => get_bloginfo('admin_email'),
						'desc' => 'Contact Email (to)'
					),
					array(
						'name' => 'error',
						'type' => 'input',
						'default' => 'Fail! Please try again.',
						'desc' => 'Error Message'
					),
					array(
						'name' => 'recaptcha',
						'type' => 'on_off_ui',
						'default' => 'off',
						'desc' => 'reCAPTCHA (optional)'
					)
			  ),
			  'content' => 'Your message was successfully sent. <strong>Thank You!</strong>',
			  'desc' => 'Contact'
			),
			
			'alertbox' => array(
				'name' => 'Alertbox',
				'type' => 'wrap',
				'oneline' => true,
				'atts' => array(
					array(
						'name' => 'id',
						'type' => 'input',
						'desc' => 'ID (optional)'
					),
					array(
						'name' => 'class',
						'type' => 'input',
						'desc' => 'Class (optional)'
					),
					array(
					'name' => 'color',
					'type' => 'select',
					'default' => 'blue,green,yellow,red,gray',
					'desc' => 'Box Color'
					),
					array(
					'name' => 'icon',
					'type' => 'colored_icons',
					'default' => '',
					'desc' => 'Box Colored Icon (optional)'
					),
					array(
					'name' => 'icon_size',
					'type' => 'select',
					'default' => '16,32,48,64',
					'desc' => 'Box Colored Icon (optional)'
					),
					array(
						'name' => 'bgcolor',
						'type' => 'colorpicker',
						'default' => '',
						'desc' => 'Custom Box Color (optional)'
					),
					array(
						'name' => 'bordercolor',
						'type' => 'colorpicker',
						'default' => '',
						'desc' => 'Custom Box Border Color (optional)'
					),
					array(
						'name' => 'textcolor',
						'type' => 'colorpicker',
						'default' => '',
						'desc' => 'Custom Box Text Color (optional)'
					),
					array(
					'name' => 'hide',
					'type' => 'on_off_ui',
					'default' => 'off',
					'desc' => 'Show Hide'
					)
				),
				'content' => 'Content text',
				'desc' => 'Alert Box'
			),
		   
			'stylebox' => array(
				'name' => 'Stylebox',
				'type' => 'wrap',
				'oneline' => true,
				'atts' => array(
					array(
						'name' => 'id',
						'type' => 'input',
						'desc' => 'ID (optional)'
					),
					array(
						'name' => 'class',
						'type' => 'input',
						'desc' => 'Class (optional)'
					),
					array(
					'name' => 'color',
					'type' => 'select',
					'default' => 'blue,green,yellow,red,gray,white',
					'desc' => 'Box Color'
					),
					array(
					'name' => 'icon',
					'type' => 'colored_icons',
					'default' => '',
					'desc' => 'Box Colored Icon (optional)'
					),
					array(
					'name' => 'icon_size',
					'type' => 'select',
					'default' => '16,32,48,64',
					'desc' => 'Box Colored Icon (optional)'
					),
					array(
						'name' => 'bgcolor',
						'type' => 'colorpicker',
						'default' => '',
						'desc' => 'Custom Box Color (optional)'
					),
					array(
						'name' => 'bordercolor',
						'type' => 'colorpicker',
						'default' => '',
						'desc' => 'Custom Box Border Color (optional)'
					),
					array(
						'name' => 'textcolor',
						'type' => 'colorpicker',
						'default' => '',
						'desc' => 'Custom Box Text Color (optional)'
					),
					array(
					'name' => 'hide',
					'type' => 'on_off_ui',
					'default' => 'off',
					'desc' => 'Show Hide'
					)
				),
				'content' => 'Content',
				'desc' => 'Style Box'
			),
		   
			'ul_list' => array(
				'name' => 'List',
				'type' => 'wrap',
				'atts' => array(
					array(
						'name' => 'id',
						'type' => 'input',
						'desc' => 'ID (optional)'
					),
					array(
						'name' => 'class',
						'type' => 'input',
						'desc' => 'Class (optional)'
					),
					array(
					'name' => 'icon',
					'type' => 'select',
					'default' => 'tick,info,warning,delete,megaphone,info,arrow,help,pencil,bubble,label,plus,flag,block,present,upper-roman',
					'desc' => 'List Icon (optional)'
					)
				),
				'content' => '<ul>
<li>...</li>
<li>...</li>
<li>...</li>
</ul>',
				'desc' => 'List'
			),
			
			
			'frame' => array(
			
				'name' => 'Frame',
				'type' => 'wrap',
				'atts' => array(
					array(
						'name' => 'id',
						'type' => 'input',
						'desc' => 'ID (optional)'
					),
					array(
						'name' => 'class',
						'type' => 'input',
						'desc' => 'Class (optional)'
					),
					array(
					'name' => 'link',
					'type' => 'input',
					'default' => '',
					'desc' => 'Link'
					),
					array(
					'name' => 'target',
					'type' => 'select',
					'default' => '_lightbox,_self,_blank,_top,_parent',
					'desc' => 'Link Target'
					),
					array(
					'name' => 'icon',
					'type' => 'select',
					'default' => 'image,video,link,document',
					'desc' => 'Link Hover Icon'
					),
					array(
					'name' => 'align',
					'type' => 'select',
					'default' => 'left,center,right',
					'desc' => 'Frame Align'
					),
					array(
					'name' => 'border',
					'type' => 'on_off_ui',
					'default' => 'on',
					'desc' => 'Frame Border'
					),
					array(
					'name' => 'caption',
					'type' => 'input',
					'default' => '',
					'desc' => 'Frame Caption'
					),
					array(
					'name' => 'title',
					'type' => 'input',
					'default' => '',
					'desc' => 'Title For Videos'
					)
					
				),
				'content' => '<img src="...."> or <embed> or any HTML TAG...',
				'desc' => 'Frame'
				
			),
			
			
			'dropcap' => array(
			
				'name' => 'Dropcap',
				'type' => 'single',
				'oneline' => true,
				'atts' => array(
					array(
					'name' => 'character',
					'type' => 'input',
					'default' => 'W',
					'desc' => 'Dropcap Character'
					),
					array(
					'name' => 'color',
					'type' => 'select',
					'default' => 'blue,green,red,gray',
					'desc' => 'Dropcap Color'
					)
					
				),
				'content' => 'W',
				'desc' => 'Dropcap'
				
			),
			
			'blockquote' => array(
			
				'name' => 'Blockquote',
				'type' => 'wrap',
				'oneline' => true,
				'atts' => array(
					array(
					'name' => 'cite',
					'type' => 'input',
					'default' => '',
					'desc' => 'Blockquote Cite'
					),
					array(
					'name' => 'align',
					'type' => 'select',
					'default' => 'left,right',
					'desc' => 'Blockquote Align'
					)
				),
				'content' => '',
				'desc' => 'Blockquote'
				
			),
			
			'pullquote' => array(
			
				'name' => 'Pullquote',
				'type' => 'wrap',
				'oneline' => true,
				'atts' => array(
					array(
					'name' => 'cite',
					'type' => 'input',
					'default' => '',
					'desc' => 'Pullquote Cite'
					),
					array(
					'name' => 'align',
					'type' => 'select',
					'default' => 'left,right',
					'desc' => 'Pullquote Align'
					)
					
				),
				'content' => '',
				'desc' => 'Pullquote'
				
			),
			
			'tabs' => array(
			
				'name' => 'tabs',
				'type' => 'flexible',
				'atts' => array(
					array(
					'name' => 'model',
					'type' => 'select',
					'default' => '1,2,3',
					'desc' => 'Tab Model'
					),
					array(
					'name' => 'count_tab',
					'type' => 'select',
					'default' => '2,3,4,5,6,7,8,9,10',
					'desc' => 'Tab Count'
					)
					
				),
				'content' => '',
				'desc' => 'Tabs'
				
			),
			
			'accordion_group' => array(
			
				'name' => 'Accordion',
				'type' => 'flexible',
				'atts' => array(
					array(
					'name' => 'count_accordion',
					'type' => 'select',
					'default' => '2,3,4,5,6,7,8,9,10',
					'desc' => 'Accordion Count'
					)
					
				),
				'content' => '',
				'desc' => 'Accordion'
				
			),
			
			'toggle' => array(
			
				'name' => 'Toggle',
				'type' => 'wrap',
				'oneline' => true,
				'atts' => array(
					array(
					'name' => 'title',
					'type' => 'input',
					'default' => '',
					'desc' => 'Toggle Title'
					)
				),
				'content' => '',
				'desc' => 'Toggle'
				
			),
			
			'highlight' => array(
			
				'name' => 'Highlighter',
				'type' => 'wrap',
				'oneline' => true,
				'atts' => array(
					array(
					'name' => 'type',
					'type' => 'select',
					'default' => '1,2,3,4,5,6',
					'desc' => 'Highlighter Type'
					),
					array(
					'name' => 'bgcolor',
					'type' => 'colorpicker',
					'default' => '',
					'desc' => 'Highlighter Bg Color (Optional)'
					),
					array(
					'name' => 'textcolor',
					'type' => 'colorpicker',
					'default' => '',
					'desc' => 'Highlighter Text Color (Optional)'
					),
					array(
					'name' => 'bordercolor',
					'type' => 'colorpicker',
					'default' => '',
					'desc' => 'Highlighter Border Color (Optional)'
					)
				),
				'content' => '',
				'desc' => 'Highlighter'
				
			),
			
			'iconcolor' => array(
			
				'name' => 'Icon Colored',
				'type' => 'single',
				'oneline' => true,
				'atts' => array(
					array(
					'name' => 'icon',
					'type' => 'colored_icons',
					'default' => '',
					'desc' => 'Colored Icons'
					),
					array(
					'name' => 'size',
					'type' => 'select',
					'default' => '16,32,48,64',
					'desc' => 'Size (optional)'
					),
					array(
					'name' => 'align',
					'type' => 'select',
					'default' => 'left,center,right',
					'desc' => 'Align'
					),
					array(
					'name' => 'alt',
					'type' => 'input',
					'default' => '',
					'desc' => 'Alt Tag (Title)'
					)
				),
				'desc' => 'Icon Colored'
				
			),
			
			'iconsweet' => array(
			
				'name' => 'IconSweet',
				'type' => 'single',
				'oneline' => true,
				'atts' => array(
					array(
					'name' => 'icon',
					'type' => 'iconsweets',
					'default' => '',
					'desc' => 'Icon Sweets'
					),
					array(
					'name' => 'color',
					'type' => 'select',
					'default' => 'white,black',
					'desc' => 'Color (optional)'
					),
					array(
					'name' => 'size',
					'type' => 'select',
					'default' => '16,32,64',
					'desc' => 'Size (optional)'
					),
					array(
					'name' => 'align',
					'type' => 'select',
					'default' => 'left,center,right',
					'desc' => 'Align'
					),
					array(
					'name' => 'alt',
					'type' => 'input',
					'default' => '',
					'desc' => 'Alt Tag (Title)'
					)
				),
				'desc' => 'Icon Sweet'
			
			),
			
			'iconcircle' => array(
			
				'name' => 'Icon Circle',
				'type' => 'single',
				'oneline' => true,
				'atts' => array(
					array(
					'name' => 'icon',
					'type' => 'iconsweets',
					'default' => '',
					'desc' => 'Icon Sweets'
					),
					array(
					'name' => 'bgcolor',
					'type' => 'select',
					'default' => 'blue,green,red,yellow,gray',
					'desc' => 'Icon Circle Color'
					),
					array(
					'name' => 'align',
					'type' => 'select',
					'default' => 'left,center,right',
					'desc' => 'Align'
					),
					array(
					'name' => 'alt',
					'type' => 'input',
					'default' => '',
					'desc' => 'Alt Tag (Title)'
					)
				),
				'desc' => 'Icon Circle'
			
			),
			
			'iconborder' => array(
			
				'name' => 'Icon Border',
				'type' => 'single',
				'oneline' => true,
				'atts' => array(
					array(
					'name' => 'icon',
					'type' => 'iconsweets',
					'default' => '',
					'desc' => 'Icon Sweets'
					),
					array(
					'name' => 'iconcolor',
					'type' => 'select',
					'default' => 'black,white',
					'desc' => 'Icon Color'
					),
					array(
					'name' => 'bordercolor',
					'type' => 'select',
					'default' => 'blue,green,red,yellow,gray',
					'desc' => 'Icon Border Color'
					),
					array(
					'name' => 'align',
					'type' => 'select',
					'default' => 'left,center,right',
					'desc' => 'Align'
					),
					array(
					'name' => 'alt',
					'type' => 'input',
					'default' => '',
					'desc' => 'Alt Tag (Title)'
					)
				),
				'desc' => 'Icon Border'
			
			),
			
			'tooltip' => array(
			
				'name' => 'ToolTip',
				'type' => 'wrap',
				'oneline' => true,
				'atts' => array(
					array(
					'name' => 'title',
					'type' => 'input',
					'default' => '',
					'desc' => 'Tooltip Title'
					),
					array(
					'name' => 'position',
					'type' => 'select',
					'default' => 'up,down',
					'desc' => 'ToolTip Position'
					),
					array(
					'name' => 'container',
					'type' => 'select',
					'default' => 'span,div',
					'desc' => 'Container'
					)
				),
				'content' => 'Content',
				'desc' => 'ToolTip'
			
			),
			
			'cycle' => array(
			
				'name' => 'Cycle',
				'type' => 'wrap',
				'atts' => array(
					array(
					'name' => 'id',
					'type' => 'input',
					'default' => '',
					'desc' => 'ID (optional)'
					),
					array(
					'name' => 'class',
					'type' => 'input',
					'default' => '',
					'desc' => 'Class (optional)'
					),
					array(
					'name' => 'effect',
					'type' => 'select',
					'default' => 'scrollUp,scrollDown,scrollLeft,scrollRight,scrollHorz,scrollVert,blindX,blindY,blindZ,cover,curtainX,curtainY,fade,fadeZoom,growX,growY,shuffle,slideX,slideY,toss,turnUp,turnDown,turnLeft,turnRight,uncover,wipe,zoom',
					'desc' => 'Effect'
					),
					array(
					'name' => 'delay',
					'type' => 'slider_ui',
					'default' => '5,60,1,sec.',
					'desc' => 'Delay'
					),
					array(
					'name' => 'speed',
					'type' => 'slider_ui',
					'default' => '500,2000,1,ms.',
					'desc' => 'Delay'
					),
					array(
					'name' => 'nav',
					'type' => 'on_off_ui',
					'default' => 'on',
					'desc' => 'Left Right Navigation'
					)
				),
				'content' => '<p>Slide Content 1</p>
<p>Slide Content 2</p>
<p>Slide Content 3</p>',
				'desc' => 'Cycle Ticker'
			
			),
			
			'precode' => array(
				'name' => 'Pre-Code',
				'type' => 'wrap',
				'content' => 'Content',
				'desc' => 'Pre-Code'
			),
			
			'social' => array(
			  'name' => 'Social Icons',
			  'type' => 'single',
			  'oneline' => true,
			  'atts' => array(
				 array(
					'name' => 'icon',
					'type' => 'select',
					'default' => 'facebook,twitter,linkedin,blogspot,myspace,yahoo,google,googleplus,digg,youtube,skype,wordpress,picasa,deviantart,flickr,tumblr,delicious,vimeo,email,envato,dribbble,behance,pinterest,lastfm,xing,bbb,yelp,rss',
					'desc' => 'Social Icon'
				 ),
				 array(
					'name' => 'colored',
					'type' => 'on_off_ui',
					'default' => 'off',
					'desc' => 'Colored Icon (without-hover)'
				 ),
				 array(
					'name' => 'link',
					'type' => 'input',
					'desc' => 'Link'
				 ),
				 array(
					'name' => 'target',
					'type' => 'select',
					'default' => '_self,_blank',
					'desc' => 'Link Target'
				 ),
				 array(
					'name' => 'popup',
					'type' => 'input',
					'default' => 'Follow me',
					'desc' => 'Popup Message'
				 )
			  ),
			  'desc' => 'Social Icons'
			),
			
			'sortby' => array(
			  'name' => 'Category Sortable',
			  'type' => 'single',
			  'oneline' => true,
			  'atts' => array(
					array(
						'name' => 'id',
						'type' => 'select',
						'default' => '[categories],[all],[desc],[id]',
						'desc' => 'Choose a main category for sortby'
					),
					array(
					'name' => 'skin',
					'type' => 'select',
					'default' => 'green,blue,red,yellow,gray,dark',
					'desc' => 'Skin'
					),
					array(
					'name' => 'text',
					'type' => 'input',
					'default' => 'Sort by:',
					'desc' => 'Sort by text'
					)
			  ),
			  'desc' => 'Category Sortable'
			),
			
			'display' => array(
			  'name' => 'Responsive Display',
			  'type' => 'wrap',
			  'oneline' => true,
			  'atts' => array(
					array(
						'name' => 'type',
						'type' => 'select',
						'default' => 'desktop,tablet,mobile_landscape,mobile_portrait',
						'desc' => 'Choose a display type'
					)
			  ),
           'content' => '',
			  'desc' => 'Responsive Display'
			)
			
		)

	),
	
	'columns_layouts' => array(	
	
		'nicename' => 'Columns Layouts',
		'options' => array (
		
			/* HALF COLUMNS 2x ONE HALF */
			'half_colums' => array(
			  'name' => '2x One Half',
			  'type' => 'multiple',
				'atts' => array(
					array(
					'name' => 'one_half',
					'type' => 'textarea',
					'desc' => '1/1 One Half'
					),
					array(
					'name' => 'one_half_last',
					'type' => 'textarea',
					'desc' => '2/2 One Half Last'
					)
				),
			  'desc' => 'One Half Columns Layout'
			),
			
			/* THIRD COLUMNS 3x ONE THIRD */
			'third_colums' => array(
			  'name' => '3x One Third',
			  'type' => 'multiple',
				'atts' => array(
					array(
					'name' => 'one_third',
					'type' => 'textarea',
					'desc' => '1/3 One Third'
					),
					array(
					'name' => 'one_third',
					'type' => 'textarea',
					'desc' => '2/3 One Third'
					),
					array(
					'name' => 'one_third_last',
					'type' => 'textarea',
					'desc' => '3/3 One Third Last'
					)
				),
			  'desc' => 'Three Columns Layout'
			),
			
			/* Fourth COLUMNS 4x ONE FOURTH */
			'fourth_colums' => array(
			  'name' => '4x One Fourth',
			  'type' => 'multiple',
				'atts' => array(
					array(
					'name' => 'one_fourth',
					'type' => 'textarea',
					'desc' => '1/4 One Fourth'
					),
					array(
					'name' => 'one_fourth',
					'type' => 'textarea',
					'desc' => '2/4 One Fourth'
					),
					array(
					'name' => 'one_fourth',
					'type' => 'textarea',
					'desc' => '3/4 One Fourth'
					),
					array(
					'name' => 'one_fourth_last',
					'type' => 'textarea',
					'desc' => '4/4 One Fourth Last'
					)
				),
			  'desc' => 'Fourth Columns Layout'
			),
			
			/* Fifth COLUMNS 5x ONE Fifth */
			'fifth_colums' => array(
			  'name' => '5x One Fifth',
			  'type' => 'multiple',
				'atts' => array(
					array(
					'name' => 'one_fifth',
					'type' => 'textarea',
					'desc' => '1/5 One Fifth'
					),
					array(
					'name' => 'one_fifth',
					'type' => 'textarea',
					'desc' => '2/5 One Fifth'
					),
					array(
					'name' => 'one_fifth',
					'type' => 'textarea',
					'desc' => '3/5 One Fifth'
					),
					array(
					'name' => 'one_fifth',
					'type' => 'textarea',
					'desc' => '4/5 One Fifth'
					),
					array(
					'name' => 'one_fifth_last',
					'type' => 'textarea',
					'desc' => '5/5 One Fifth Last'
					)
				),
			  'desc' => 'Fifth Columns Layout'
			),
			
			/* Sixth COLUMNS 5x ONE Sixth */
			'sixth_colums' => array(
			  'name' => '6x One Sixth',
			  'type' => 'multiple',
				'atts' => array(
					array(
					'name' => 'one_sixth',
					'type' => 'textarea',
					'desc' => '1/6 One Sixth'
					),
					array(
					'name' => 'one_sixth',
					'type' => 'textarea',
					'desc' => '2/6 One Sixth'
					),
					array(
					'name' => 'one_sixth',
					'type' => 'textarea',
					'desc' => '3/6 One Sixth'
					),
					array(
					'name' => 'one_sixth',
					'type' => 'textarea',
					'desc' => '4/6 One Sixth'
					),
					array(
					'name' => 'one_sixth',
					'type' => 'textarea',
					'desc' => '5/6 One Sixth'
					),
					array(
					'name' => 'one_sixth_last',
					'type' => 'textarea',
					'desc' => '6/6 One Sixth Last'
					)
				),
				'desc' => 'Sixth Columns Layout'
			),
			
			/* ONE - TWO Third COLUMNS */
			'one_two_colums' => array(
			  'name' => '1 One Third - 1 Two Third',
			  'type' => 'multiple',
				'atts' => array(
					array(
					'name' => 'one_third',
					'type' => 'textarea',
					'desc' => '1/1 One Third'
					),
					array(
					'name' => 'two_third_last',
					'type' => 'textarea',
					'desc' => '2/2 Two Third'
					)
				),
			  'desc' => 'One Third - Two Third Columns Layout'
			),
			
			/* TWO - ONE Third COLUMNS */
			'two_one_colums' => array(
			  'name' => '1 Two Third - 1 One Third',
			  'type' => 'multiple',
				'atts' => array(
					array(
					'name' => 'two_third',
					'type' => 'textarea',
					'desc' => '1/2 Two Third'
					),
					array(
					'name' => 'one_third_last',
					'type' => 'textarea',
					'desc' => '2/2 One Third'
					)
				),
			  'desc' => 'Two Third - One Third Columns Layout'
			),
			
			/* ONE - THERE FOURTH COLUMNS */
			'one_three_colums' => array(
			  'name' => '1 One Fourth - 1 Three Fourth',
			  'type' => 'multiple',
				'atts' => array(
					array(
					'name' => 'one_fourth',
					'type' => 'textarea',
					'desc' => '1/2 One Fourth'
					),
					array(
					'name' => 'three_fourth_last',
					'type' => 'textarea',
					'desc' => '2/2 Three Fourth'
					)
				),
			  'desc' => 'One Fourth - Three Fourth Columns Layout'
			),
			
			/* THERE - ONE FOURTH COLUMNS */
			'three_one_colums' => array(
			  'name' => '1 One Fourth - 1 Three Fourth',
			  'type' => 'multiple',
				'atts' => array(
					array(
					'name' => 'three_fourth',
					'type' => 'textarea',
					'desc' => '1/2 Three Fourth'
					),
					array(
					'name' => 'one_fourth_last',
					'type' => 'textarea',
					'desc' => '2/2 One Fourth'
					)
				),
			  'desc' => 'Three Fourth - One Fourth Columns Layout'
			),
			
			/* ONE - FOURTH COLUMNS */
			'one_four_colums' => array(
			  'name' => '1 One Fifth - 1 Four Fifth',
			  'type' => 'multiple',
				'atts' => array(
					array(
					'name' => 'one_fifth',
					'type' => 'textarea',
					'desc' => '1/2 One Fifth'
					),
					array(
					'name' => 'four_fifth_last',
					'type' => 'textarea',
					'desc' => '2/2 Four Fifth'
					)
				),
			  'desc' => 'One Fifth - Four Fifth Columns Layout'
			),
			
			/*  FOURTH - ONE COLUMNS */
			'four_one_colums' => array(
			  'name' => '1 Four Fifth - 1 One Fifth',
			  'type' => 'multiple',
				'atts' => array(
					array(
					'name' => 'four_fifth',
					'type' => 'textarea',
					'desc' => '1/2 Four Fifth'
					),
					array(
					'name' => 'one_fifth_last',
					'type' => 'textarea',
					'desc' => '2/2 One Fifth'
					)
				),
			  'desc' => 'Four Fifth - One Fifth Columns Layout'
			),
			
			/* ONE - FIVE COLUMNS */
			'one_five_colums' => array(
			  'name' => '1 One Sixth - 1 Five Sixth',
			  'type' => 'multiple',
				'atts' => array(
					array(
					'name' => 'one_sixth',
					'type' => 'textarea',
					'desc' => '1/2 One Sixth'
					),
					array(
					'name' => 'five_sixth_last',
					'type' => 'textarea',
					'desc' => '2/2 Five Sixth'
					)
				),
			  'desc' => 'One Sixth - Five Sixth Columns Layout'
			),
			
			/*  FIVE - ONE COLUMNS */
			'five_one_colums' => array(
			  'name' => '1 Five Sixth - 1 One Sixth',
			  'type' => 'multiple',
				'atts' => array(
					array(
					'name' => 'five_sixth',
					'type' => 'textarea',
					'desc' => '1/2 Five Sixth'
					),
					array(
					'name' => 'one_sixth_last',
					'type' => 'textarea',
					'desc' => '2/2 One Sixth'
					)
				),
			  'desc' => 'Five Sixth - One Sixth Columns Layout'
			),
			
			/* TWO - THREE Fifth COLUMNS */
			'two_three_colums' => array(
			  'name' => '1 Two Fifth - 1 Three Fifth',
			  'type' => 'multiple',
				'atts' => array(
					array(
					'name' => 'two_fifth',
					'type' => 'textarea',
					'desc' => '1/1 One Fifth'
					),
					array(
					'name' => 'three_fifth_last',
					'type' => 'textarea',
					'desc' => '2/2 Three Fifth'
					)
				),
			  'desc' => 'Two Fifth - Three Fifth Columns Layout'
			),
			
			/* THREE - TWO Third COLUMNS */
			'three_two_colums' => array(
			  'name' => '1 Three Fifth - 1 Two Fifth',
			  'type' => 'multiple',
				'atts' => array(
					array(
					'name' => 'three_fifth',
					'type' => 'textarea',
					'desc' => '1/2 Three Fifth'
					),
					array(
					'name' => 'two_fifth_last',
					'type' => 'textarea',
					'desc' => '2/2 Two Fifth'
					)
				),
			  'desc' => 'Three Fifth - Two Fifth Columns Layout'
			),
			
			/* CUSTOM 1 */
			'custom1_columns' => array(
			  'name' => 'One Half - One Fourth - One Fourth',
			  'type' => 'multiple',
				'atts' => array(
					array(
					'name' => 'one_half',
					'type' => 'textarea',
					'desc' => '1/3 One Half'
					),
					array(
					'name' => 'one_fourth',
					'type' => 'textarea',
					'desc' => '2/3 One Fourth'
					),
					array(
					'name' => 'one_fourth_last',
					'type' => 'textarea',
					'desc' => '3/3 One Fourth'
					)
				),
			  'desc' => 'One Half - One Fourth - One Fourth'
			),
			
			/* CUSTOM 2 */
			'custom2_columns' => array(
			  'name' => 'One Fourth - One Fourth - One Half',
			  'type' => 'multiple',
				'atts' => array(
					array(
					'name' => 'one_fourth',
					'type' => 'textarea',
					'desc' => '1/3 One Fourth'
					),
					array(
					'name' => 'one_fourth',
					'type' => 'textarea',
					'desc' => '2/3 One Fourth'
					),
					array(
					'name' => 'one_half_last',
					'type' => 'textarea',
					'desc' => '3/3 One Half'
					)
				),
			  'desc' => 'One Fourth - One Fourth - One Half'
			),
			
			/* CUSTOM 3 */
			'custom3_columns' => array(
			  'name' => 'One Fourth - One Half - One Fourth',
			  'type' => 'multiple',
				'atts' => array(
					array(
					'name' => 'one_fourth',
					'type' => 'textarea',
					'desc' => '1/3 One Fourth'
					),
					array(
					'name' => 'one_half',
					'type' => 'textarea',
					'desc' => '2/3 One Half'
					),
					array(
					'name' => 'one_fourth_last',
					'type' => 'textarea',
					'desc' => '3/3 One Fourth'
					)
				),
			  'desc' => 'One Fourth - One Half - One Fourth'
			),
			
			/* CUSTOM 4 */
			'custom4_columns' => array(
			  'name' => 'One Third - 4x One Sixth',
			  'type' => 'multiple',
				'atts' => array(
					array(
					'name' => 'one_third',
					'type' => 'textarea',
					'desc' => '1/5 One Fourth'
					),
					array(
					'name' => 'one_sixth',
					'type' => 'textarea',
					'desc' => '2/5 One Sixth'
					),
					array(
					'name' => 'one_sixth',
					'type' => 'textarea',
					'desc' => '3/5 One Sixth'
					),
					array(
					'name' => 'one_sixth',
					'type' => 'textarea',
					'desc' => '4/5 One Sixth'
					),
					array(
					'name' => 'one_sixth_last',
					'type' => 'textarea',
					'desc' => '5/5 One Sixth'
					)
				),
			  'desc' => 'One Third - 4 x One Sixth'
			),
			
			/* CUSTOM 5 */
			'custom5_columns' => array(
			  'name' => '4x One Sixth - One Third',
			  'type' => 'multiple',
				'atts' => array(
					array(
					'name' => 'one_sixth',
					'type' => 'textarea',
					'desc' => '1/5 One Sixth'
					),
					array(
					'name' => 'one_sixth',
					'type' => 'textarea',
					'desc' => '2/5 One Sixth'
					),
					array(
					'name' => 'one_sixth',
					'type' => 'textarea',
					'desc' => '3/5 One Sixth'
					),
					array(
					'name' => 'one_sixth',
					'type' => 'textarea',
					'desc' => '4/5 One Sixth'
					),
					array(
					'name' => 'one_third_last',
					'type' => 'textarea',
					'desc' => '5/5 One Fourth'
					),
				),
			  'desc' => '4x One Sixth - One Third'
			)
			
		)
		
	),
	
	
	
	'single_columns' => array(	
	
		'nicename' => 'Single Columns',
		'options' => array (
		
			'one_half' => array(
				'name' => 'One Half',
				'type' => 'wrap',
				'content' => '',
				'desc' => 'One Half Column'
			),
			'one_half_last' => array(
				'name' => 'One Half Last',
				'type' => 'wrap',
				'content' => '',
				'desc' => 'One Half Last Column'
			),
			'one_third' => array(
				'name' => 'One Third',
				'type' => 'wrap',
				'content' => '',
				'desc' => 'One Third Column'
			),
			'one_third_last' => array(
				'name' => 'One Third Last',
				'type' => 'wrap',
				'content' => '',
				'desc' => 'One Third Last Column'
			),
			'one_fourth' => array(
				'name' => 'One Fourth',
				'type' => 'wrap',
				'content' => '',
				'desc' => 'One Fourth Column'
			),
			'one_fourth_last' => array(
				'name' => 'One Fourth Last',
				'type' => 'wrap',
				'content' => '',
				'desc' => 'One Fourth Last Column'
			),
			'one_fifth' => array(
				'name' => 'One Fifth',
				'type' => 'wrap',
				'content' => '',
				'desc' => 'One Fifth Column'
			),
			'one_fifth_last' => array(
				'name' => 'One Fifth Last',
				'type' => 'wrap',
				'content' => '',
				'desc' => 'One Fifth Last Column'
			),
			'one_sixth' => array(
				'name' => 'One Sixth',
				'type' => 'wrap',
				'content' => '',
				'desc' => 'One Sixth Column'
			),
			'one_sixth_last' => array(
				'name' => 'One Sixth Last',
				'type' => 'wrap',
				'content' => '',
				'desc' => 'One Sixth Last Column'
			),
			'two_third' => array(
				'name' => 'Two Third',
				'type' => 'wrap',
				'content' => '',
				'desc' => 'Two Third Column'
			),
			'two_third_last' => array(
				'name' => 'Two Third Last',
				'type' => 'wrap',
				'content' => '',
				'desc' => 'Two Third Last Column'
			),
			'two_fifth' => array(
				'name' => 'Two Fifth',
				'type' => 'wrap',
				'content' => '',
				'desc' => 'Two Fifth Column'
			),
			'two_fifth_last' => array(
				'name' => 'Two Fifth Last',
				'type' => 'wrap',
				'content' => '',
				'desc' => 'Two Fifth Last Column'
			),
			'three_fifth' => array(
				'name' => 'Three Fifth',
				'type' => 'wrap',
				'content' => '',
				'desc' => 'Three Fifth Column'
			),
			'three_fifth_last' => array(
				'name' => 'Three Fifth Last',
				'type' => 'wrap',
				'content' => '',
				'desc' => 'Three Fifth Last Column'
			),
			'three_fourth' => array(
				'name' => 'Three Fourth',
				'type' => 'wrap',
				'content' => '',
				'desc' => 'Three Fourth Column'
			),
			'three_fourth_last' => array(
				'name' => 'Three Fourth Last',
				'type' => 'wrap',
				'content' => '',
				'desc' => 'Three Fourth Last Column'
			),
			'four_fifth' => array(
				'name' => 'Four Fifth',
				'type' => 'wrap',
				'content' => '',
				'desc' => 'Four Fifth Column'
			),
			'four_fifth_last' => array(
				'name' => 'Four Fifth Last',
				'type' => 'wrap',
				'content' => '',
				'desc' => 'Four Fifth Last Column'
			),
			'five_sixth' => array(
				'name' => 'Five Sixth',
				'type' => 'wrap',
				'content' => '',
				'desc' => 'Five Sixth Column'
			),
			'five_sixth_last' => array(
				'name' => 'Five Sixth Last',
				'type' => 'wrap',
				'content' => '',
				'desc' => 'Five Sixth Last Column'
			)
			
		)
		
	),
	
	
	'single' => array(	
	
		'nicename' => 'Single Shortcodes',
		'options' => array (
			'divider' => array(
			
				'name' => 'Divider',
				'type' => 'single',
				'oneline' => true,
				'atts' => array(
					array(
					'name' => 'top',
					'type' => 'on_off_ui',
					'default' => 'on',
					'desc' => 'Divider with Top'
					)
				),
				'desc' => 'Divider'
			
			),
			'clear' => array(
			
				'name' => 'Clear',
				'type' => 'single',
				'atts' => array(
					array(
					'name' => '[clear]',
					'type' => 'text',
					'default' => '',
					'desc' => 'Just insert for'
					)
				),
				'desc' => 'Clear'
			),
			
			'space5' => array(
			
				'name' => 'Space5',
				'type' => 'single',
				'atts' => array(
					array(
					'name' => '[space5]',
					'type' => 'text',
					'default' => '',
					'desc' => 'Just insert for'
					)
				),
				'desc' => 'Space5'
			),
			
			'space10' => array(
			
				'name' => 'Space10',
				'type' => 'single',
				'atts' => array(
					array(
					'name' => '[space10]',
					'type' => 'text',
					'default' => '',
					'desc' => 'Just insert for'
					)
				),
				'desc' => 'Space10'
			),
			
			'space20' => array(
			
				'name' => 'Space20',
				'type' => 'single',
				'atts' => array(
					array(
					'name' => '[space20]',
					'type' => 'text',
					'default' => '',
					'desc' => 'Just insert for'
					)
				),
				'desc' => 'Space20'
			),
			
			'space30' => array(
			
				'name' => 'Space30',
				'type' => 'single',
				'atts' => array(
					array(
					'name' => '[space30]',
					'type' => 'text',
					'default' => '',
					'desc' => 'Just insert for'
					)
				),
				'desc' => 'Space30'
			),
			
			'space40' => array(
			
				'name' => 'Space40',
				'type' => 'single',
				'atts' => array(
					array(
					'name' => '[space40]',
					'type' => 'text',
					'default' => '',
					'desc' => 'Just insert for'
					)
				),
				'desc' => 'Space40'
			),
			
			'space50' => array(
			
				'name' => 'Space50',
				'type' => 'single',
				'atts' => array(
					array(
					'name' => '[space50]',
					'type' => 'text',
					'default' => '',
					'desc' => 'Just insert for'
					)
				),
				'desc' => 'Space50'
			),
			
			'space100' => array(
			
				'name' => 'Space100',
				'type' => 'single',
				'atts' => array(
					array(
					'name' => '[space100]',
					'type' => 'text',
					'default' => '',
					'desc' => 'Just insert for'
					)
				),
				'desc' => 'Space100'
			),
			
			'alignleft' => array(
			
				'name' => 'Alignleft',
				'type' => 'wrap',
				'oneline' => true,
				'content' => 'Content',
				'desc' => 'Alignleft'
			),
			
			'aligncenter' => array(
			
				'name' => 'Aligncenter',
				'type' => 'wrap',
				'oneline' => true,
				'content' => 'Content',
				'desc' => 'Aligncenter'
			),
			
			'alignright' => array(
			
				'name' => 'Alignright',
				'type' => 'wrap',
				'oneline' => true,
				'content' => 'Content',
				'desc' => 'Alignright'
			),
			
			'center' => array(
			
				'name' => 'Center',
				'type' => 'wrap',
				'oneline' => true,
				'content' => 'Content',
				'desc' => 'Center'
			)
		)
	),
	
	
	'widgets' => array(	
	
		'nicename' => 'Widget Shortcodes',
		'options' => array (
		
			'posts' => array(
			
				'name' => 'Posts',
				'type' => 'single',
				'atts' => array(
					array(
					'name' => 'type',
					'type' => 'select',
					'default' => 'recent,popular,releated',
					'attr' => '',
					'desc' => 'Type is'
					),
					array(
					'name' => 'limit',
					'type' => 'slider_ui',
					'default' => '5,100,1,item',
					'desc' => 'Number of posts to show'
					),
					array(
					'name' => 'length_title',
					'type' => 'slider_ui',
					'default' => '50,250,1,char',
					'desc' => 'Length of Title to show'
					),
					array(
					'name' => 'length_desc',
					'type' => 'slider_ui',
					'default' => '80,250,1,char',
					'desc' => 'Length of Description to show'
					),
					array(
					'name' => 'display',
					'type' => 'select',
					'default' => 'none,time,description,both',
					'desc' => 'Display Extra'
					),
					array(
					'name' => 'thumbnail',
					'type' => 'on_off_ui',
					'default' => 'on',
					'desc' => 'Post Thumbnail'
					),
					array(
					'name' => 'size',
					'type' => 'slider_ui',
					'default' => '65,250,1,px',
					'desc' => 'Thumbnail Size'
					),
					array(
					'name' => 'categories',
					'type' => 'select',
					'default' => '[categories],[all],[desc],[id]',
					'attr' => 'multiple="multiple"',
					'desc' => 'Categories'
					)
				),
				'desc' => 'Posts'
			
			),
			
			'flickr' => array(
			
				'name' => 'Flickr',
				'type' => 'single',
				'oneline' => true,
				'atts' => array(
					array(
					'name' => 'user',
					'type' => 'input',
					'default' => '',
					'desc' => 'User ID (required)'
					),
					array(
					'name' => 'count',
					'type' => 'select',
					'default' => '1,2,3,4,5,6,7,8,9,10',
					'desc' => 'Count (optional)'
					),
					array(
					'name' => 'size',
					'type' => 'select',
					'default' => 's,t,m',
					'desc' => 'Size (optional)'
					),
					array(
					'name' => 'layout',
					'type' => 'select',
					'default' => 'h,v',
					'desc' => 'Layout (optional)'
					),
					array(
					'name' => 'display',
					'type' => 'select',
					'default' => 'latest,random',
					'desc' => 'Display (optional)'
					)
				),
				'desc' => 'Flickr'
			),
			
			'search' => array(
			
				'name' => 'Search',
				'type' => 'single',
				'oneline' => true,
				'atts' => array(
					array(
					'name' => 'text',
					'type' => 'input',
					'default' => 'Search...',
					'desc' => 'Search Text (optional)'
					),
					array(
					'name' => 'width',
					'type' => 'slider_ui',
					'default' => '0,250,1,px',
					'desc' => 'Search Width (optional)'
					)
				),
				'desc' => 'Search'
			)
		)
	)
	
);
if ( $shortcode ){
   return $shortcodes[$shortcode];
}else{
   return $shortcodes;
}
?>