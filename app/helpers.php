<?php 

function flash($type, $message)
{

	if($type == 'success'){

		session()->forget('error');

		session()->flash('message', $message);
	}else{

		session()->forget('message');
		session()->flash('error', $message);

	}

}

function validateVin( $vin ) 
{

	if ( strlen($vin) !== 17 )

		return false;

	$vin_pattern = str_split( $vin );
		
	unset( $vin_pattern[8] );

	array_splice($vin_pattern, 10);

	if ( sizeof( $vin_pattern ) !== 10 )

		return false;

		return true;
}
