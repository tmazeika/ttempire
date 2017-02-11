<?php

namespace TTEmpire;

class Product
{
    private $id;

    public function __construct(string $id, string $title, string $desc, string $img, ProductQuantity ...$quantities)
    {
        $this->id = $id;
        $this->title = $title;
        $this->desc = $desc;
        $this->img = $img;
        $this->quantities = $quantities;
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getTitle() : string
    {
        return $this->title;
    }

    public function getDesc() : string
    {
        return $this->desc;
    }

    public function getImg() : string
    {
        return $this->img;
    }

    public function getQuantities(): array
    {
        return $this->quantities;
    }

    /**
     * @param int $ballsPerBox
     *
     * @return ProductQuantity|null
     */
    public function getQuantity(int $ballsPerBox)
    {
        foreach ($this->quantities as $quantity) {
            if ($quantity->getBallsPerBox() === $ballsPerBox) {
                return $quantity;
            }
        }

        return null;
    }
}
