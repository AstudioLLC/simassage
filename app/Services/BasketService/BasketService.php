<?php

namespace App\Services\BasketService;

use App\Models\User;
use App\Services\BasketService\Drivers\BasketDriver;
use App\ValueObjects\BasketItem;

/**
 * Class BasketService
 * @package App\Services\BasketService
 */
class BasketService
{
    /**
     * @var
     */
    protected $driver;

    /**
     * BasketService constructor.
     * @param BasketDriver $driver
     */
    public function __construct(BasketDriver $driver)
    {
        $this->driver = $driver;
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function getItems()
    {
        return $this->driver->getItems();
    }

    /**
     * @param $itemId
     * @param $data
     * @return bool
     */
    public function add($itemId, $data)
    {
        return $this->driver->add($itemId, $data);
    }

    /**
     * @param $itemId
     * @param $data
     * @return bool
     */
    public function update($itemId, $data)
    {
        return $this->driver->update($itemId, $data);
    }

    /**
     * @param $itemId
     * @return bool
     */
    public function delete($itemId)
    {
        return $this->driver->delete($itemId);
    }

    /**
     * @param false $discounted
     * @return mixed
     */
    public function getBasketTotal($discounted = true)
    {
        return $this->getItems()->sum(function (BasketItem $basketItem) use ($discounted){
            if (!$discounted) {
                return $basketItem->getPrice() * $basketItem->getCount();
            }

            return $basketItem->getSum();
        });
    }

    public function getItemIds()
    {
        $items = $this->getItems();
        $ids = [];

        foreach($items as $item) {
            $ids[] = $item->getItem()->id;
        }

        return $ids;
    }

    public function getItemById($id)
    {
        return $this->getItems()->filter(function (BasketItem $basketItem) use ($id){
            return $basketItem->getItem()->id == $id;
        })->values()->first();
    }
}
