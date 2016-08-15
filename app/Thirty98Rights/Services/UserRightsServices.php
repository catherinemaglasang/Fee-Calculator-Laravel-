<?php

namespace Thirty98\Thirty98Rights\Services;

use Thirty98\Thirty98Rights\Models\PermissionsRole;
use Thirty98\Thirty98Rights\Interfaces\UserRightsInterface;
use Thirty98\Thirty98Rights\Models\Permission;
use Thirty98\Thirty98Rights\Models\Role;
use Thirty98\User;
use Auth;

class UserRightsServices implements UserRightsInterface{

	protected $role;

	protected $applications = ['user_management','calculator','tr_dealer','tag_agency','website'];

	public function Role($query = null){

		$this->getRole();

		$role = Role::where('id', $this->role)->first();

		if($query){
			if($role->name == $query){
				return true;
			}else{
				return false;
			}
		}else{
			return $role->name;
		}
		

	}

	public function Permissions($query = null){

		$this->getRole(); $perms = [];

		$items = Role::where('id', $this->role)->with('permissions')->first();

		foreach ($items->permissions as $j => $permission) {
			$perm = Permission::where('id', $permission->permission_id)->first();
			array_push($perms, $perm->name);
		}

		if($query)
			return in_array($query, $perms);
		return $perms;
	}

	public function Calculators($query = null){

		$user = User::where('id', Auth::id())->with('calculator')->first(); $items = [];

		foreach ($user->calculator as $i => $calculator) {
			array_push($items, $calculator->state_code);
		}

		if($query)
			return in_array($query, $items);
		return $items;
	}

	private function getRole(){
		$user = User::where('id', Auth::id())->with('roles')->first();

		foreach ($user->roles as $i => $role) {
			if($role->applications == env('APP_NAME', null)){
				$this->role = $role->role_id;
				break;
			}
		}
	}

}

// EOF