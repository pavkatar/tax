<?php 

$taxes = json_decode(file_get_contents('./taxes.json'), true);

$countries = json_decode(file_get_contents('./countries_to_names.json'), true);

if(!file_exists('./tax_type')){
	mkdir('./tax_type');
}

if(!file_exists('./zone')){
	mkdir('./zone');
}

foreach($taxes as $country => $info){
	
	if(!isset($countries[$country])){
		continue;
	}

	if(isset($info['states']) && $country != 'ES'){

		$stateName = json_decode(file_get_contents(strtolower($country).'_states.json'), true);

		foreach($info['states'] as $state => $stateInfo){


			$taxType = [
				'name' => $countries[$country].' - '.$stateName[$state].' '.strtoupper($stateInfo['type']),
				'generic_label' => $stateInfo['type'],
				'display_inclusive' => false,
				'zone' => strtolower($country).'_'.strtolower($state).'_'.$stateInfo['type'],
				'rates' => [
					[
						'id' => strtolower($country).'_'.strtolower($state).'_'.$stateInfo['type'].'_standard',
						'name' => 'Standard',
						'default' => true,
						'amounts' => [
							[
								'id' =>  strtolower($country).'_'.strtolower($state).'_'.$stateInfo['type'].'_standard_2022',
								'amount' => $stateInfo['rate'],
								'start_date' => '2022-01-01'
							]
						]
					]
				]
			];

			$zone = [
				'name' => $countries[$country].'_'.strtolower($state).' ('.strtoupper($stateInfo['type']).')',
				'scope' => strtolower($info['type']),
				'members' => [
					[
						'type' => 'country',
						'id' => strtolower($country).'_'.strtolower($state).'_'.$stateInfo['type'].'_0',
						'name' => $countries[$country].' - '.$stateName[$state],
						'country_code' => strtoupper($country),
						'administrative_area' => $state
					]
				]
			];
			if(!file_exists('./tax_type/'.strtolower($country).'_'.strtolower($state).'_'.$stateInfo['type'].'.json')){
				file_put_contents('./tax_type/'.strtolower($country).'_'.strtolower($state).'_'.$stateInfo['type'].'.json', json_encode($taxType));
				file_put_contents('./zone/'.strtolower($country).'_'.strtolower($state).'_'.$stateInfo['type'].'.json', json_encode($zone));
			}
		}
	}else{
		$taxType = [
			'name' => $countries[$country].' '.strtoupper($info['type']),
			'generic_label' => $info['type'],
			'display_inclusive' => false,
			'zone' => strtolower($country).'_'.$info['type'],
			'rates' => [
				[
					'id' => strtolower($country).'_'.$info['type'].'_standard',
					'name' => 'Standard',
					'default' => true,
					'amounts' => [
						[
							'id' =>  strtolower($country).'_'.$info['type'].'_standard_2022',
							'amount' => $info['rate'],
							'start_date' => '2022-01-01'
						]
					]
				]
			]
		];

		$zone = [
			'name' => $countries[$country].' ('.strtoupper($info['type']).')',
			'scope' => strtolower($info['type']),
			'members' => [
				[
					'type' => 'country',
					'id' => strtolower($country).'_'.$info['type'].'_0',
					'name' => $countries[$country],
					'country_code' => strtoupper($country)
				]
			]
		];
		if(!file_exists('./tax_type/'.strtolower($country).'_'.$info['type'].'.json')){
			file_put_contents('./tax_type/'.strtolower($country).'_'.$info['type'].'.json', json_encode($taxType));
			file_put_contents('./zone/'.strtolower($country).'_'.$info['type'].'.json', json_encode($zone));
		}
	}
}