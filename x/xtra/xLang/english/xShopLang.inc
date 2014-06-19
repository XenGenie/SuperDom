<?php
/** 
 */
class xShopLang {
	// Used for Complex values.
	var $_LANG = array(
		'JUMBO' => array(
			'HEAD' => '"Thank You! Come Again!"',
			'QUOTE' => 'Welcome to your Online Bazaar! Here is where you connect to the world to exchange your goods and services.',
			'BTN'	=> array(
				'catalog'	=> array(
					'a' => '<i class="fa fa-book"></i> Catalog &nbsp; ',
					'class' => 'btn-danger'
				),
				'upload'	=> array(
					'a' => '<i class="fa fa-cloud-upload"></i> Upload &nbsp; ',
					'class' => 'btn-info'
				),
				'orders'	=> array(
					'a' => '<i class="fa fa-truck"></i> Orders &nbsp; ',
					'class' => 'btn-success'
				)
			)
		),
		'catalog' => array(
			'JUMBO' => array(
				'HEAD' => 'Catalog',
				'QUOTE' => 'An interactive catalog manager. Oragnize your goods for the good of your customers ;)',
				'BTN'	=> array(
					'shelves'	=> array(
						'a' => '<i class="fa fa-book"></i> Catalog &nbsp; ',
						'class' => 'btn-info'
					),
					//'products'	=> '<i class="fa fa-coffee"></i> Products & Serives &nbsp; ',
					'orders'	=> array(
						'a' => '<i class="fa fa-truck"></i> Orders &nbsp; ',
						'class' => 'btn-success'
					)
				),
				'catalog' => array(
					''
				)
			),
		),

		'CONFIG' => array(
			'SITE' => array(
				'NAME'      => 'My SuperDom Site',
				'MOTO'      => 'A Network of Sites!',
				'COPYRIGHT' => 'SuperDomX &#copy; 2010~13'
			)
		) 
	);
}
?>