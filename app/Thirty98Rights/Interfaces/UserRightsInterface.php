<?php

namespace Thirty98\Thirty98Rights\Interfaces;

interface UserRightsInterface{

	public function Role($query);
	public function Permissions($query);
	public function Calculators($query);
}

// This is how you do it on blade.

// <h1>{{ $permissions->Permissions('manage_permissions') }}</h1>
// <h1>{{ $permissions->Role() }}</h1>
// <h1>{{ $permissions->Calculators()[0] }}</h1>