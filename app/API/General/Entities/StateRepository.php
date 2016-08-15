<?php

namespace Thirty98\API\General\Entities;

use Thirty98\API\General\Models\State;

class StateRepository
{
    /**
     * Get list of states.
     *
     * @param array $where
     * @return mixed
     */
    public function states($where = [])
    {
        $result = new State;

        foreach ($where as $field => $value) {
            $result = $result->where($field, $value);
        }

        $result = $result->orderBy('name', 'asc')->get();

        return $result->toArray();
    }
}
#END OF PHP FILE