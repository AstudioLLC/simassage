<?php

namespace App\ValueObjects;

use App\Models\Item;
use App\Models\ItemSizes;

class BasketItem extends ValueObject
{
    /**
     * @var Item
     */
    protected $item;

    /**
     * @var ItemSizes
     */
    protected $size;

    /**
     * @var integer
     */
    protected $count;

    /**
     * BasketItem constructor.
     * @param Item $item
     * @param int $count
     * @param ItemSizes $size
     */
    public function __construct(Item $item, int $count, ItemSizes $size = null)
    {
        $this->setItem($item);
        $this->setCount($count);
        $this->setSize($size);
    }

    /**
     * @return mixed
     */
    public function getPrice()
    {
        return $this->size ? $this->size->price : $this->item->price;
    }

    /**
     * @return float|int
     */
    public function getSum()
    {
        return $this->count * $this->getDiscountedPrice();
    }

    /**
     * @return mixed
     */
    public function getSize()
    {
        return $this->size;
    }

    /**
     * @param mixed $size
     */
    public function setSize($size)
    {
        $this->size = $size;
    }

    /**
     * @return mixed
     */
    public function getCount()
    {
        return $this->count;
    }

    /**
     * @return integer
     */
    public function getItemId()
    {
        return $this->item->id;
    }

    /**
     * @return mixed
     */
    public function getItemDiscount()
    {
        return $this->item->delivery_price;
    }

    /**
     * @return int|mixed
     */
    public function getDiscountedPrice()
    {
        return $this->getPrice() - ($this->getPrice() * $this->getItemDiscount() / 100);
    }

    /**
     * @return mixed
     */
    public function getItemTitle()
    {
        return $this->item->title;
    }

    /**
     * @return mixed
     */
    public function getItemCode()
    {
        return $this->item->code;
    }

    /**
     * @param mixed $count
     */
    public function setCount($count)
    {
        $this->count = $count;
    }

    /**
     * @return mixed
     */
    public function getItem()
    {
        return $this->item;
    }

    /**
     * @param mixed $item
     */
    public function setItem($item): void
    {
        $this->item = $item;
    }

    /**
     * @return array
     */
    public function toArray()
    {
        return [
            'itemId' => $this->getItemId(),
            'title' => $this->getItemTitle(),
            'discount' => $this->getItemDiscount(),
            'sizeName' => $this->size ? $this->size->name : null,
            'sizeId' => $this->size ? $this->size->id : null,
            'price' => $this->getDiscountedPrice(),
            'sum' => $this->getSum(),
            'count' => $this->count
        ];
    }
}
