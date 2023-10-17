<?php

namespace App\Repositories;

use App\Models\IpAddress;
use App\Repositories\Contracts\IpAddressRepositoryInterface;

class IpAddressRepository extends BaseRepository implements IpAddressRepositoryInterface
{
    /**
     * IpAddress repository constructor.
     *
     * @param IpAddress $ipAddress
     */
    public function __construct(IpAddress $ipAddress)
    {
        parent::__construct($ipAddress);

        $this->model = $ipAddress;
    }
}
