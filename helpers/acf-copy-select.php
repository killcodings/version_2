<?php
function acf_load_field_choices( $field ) {
	$field['choices'] = array();
	if( have_rows('site_partner_links', 'options') ) {
		while( have_rows('site_partner_links', 'options') ) {
			the_row();
			$value = get_sub_field('link');
			$label = get_sub_field('title');
			$field['choices'][ $value ] = $label;
		}
	}
	return $field;
}

add_filter('acf/load_field/name=primary_nav_buttons_choose_link', 'acf_load_field_choices');
add_filter('acf/load_field/name=text_image_choose_link', 'acf_load_field_choices');
add_filter('acf/load_field/name=brand_setup_choose_link', 'acf_load_field_choices');
add_filter('acf/load_field/name=custom_table_setup_choose_link', 'acf_load_field_choices');
add_filter('acf/load_field/name=copy_select_link', 'acf_load_field_choices');

$choices = [
	'parimatch' => 'Parimatch',
	'1win' => '1win',
	'melbet' => 'Melbet',
	'mostbet' => 'Mostbet',
	'4rabet' => '4rabet',
	'1xbet' => '1xbet',
	'leonbet' => 'LeonBet',
	'pinup' => 'PinUp',
	'indibet' => 'Indibet',
	'betway' => 'Betway',
	'rajabets' => 'Rajabets',
	'betcity' => 'Betcity',
	'bettilt' => 'Bettilt',
	'lilibet' => 'Lilibet',
	'rabona' => 'Rabona',
	'papiresa' => 'Papiresa',
	'helabet' => 'Helabet',
	'betwinner' => 'Betwinner',
	'dafabet' => 'Dafabet',
	'bet365' => 'Bet365',
	'22bet' => '22Bet',
	'10cric' => '10Cric',
	'purewin' => 'PureWin',
	'fun88' => 'Fun88',
	'bollybet' => 'Bollybet',
	'casumo' => 'Casumo',
	'leovegas' => 'Leovegas',
	'888sport' => '888sport',
	'campobet' => 'CampoBet'
];
function acf_load_brand_choices($field)
{
	global $choices;
	$field['choices'] = array();
	foreach ($choices as $key => $value) {
		$field['choices'][$key] = $value;
	}
	return $field;
}

add_filter('acf/load_field/name=mailcollector_brand', 'acf_load_brand_choices');
add_filter('acf/load_field/name=mailcollector_brand_select', 'acf_load_brand_choices');
