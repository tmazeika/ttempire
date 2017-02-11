<?php

namespace TTEmpire;

use Illuminate\Http\Request;
use TTEmpire\Contracts\ProductRepository;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;

class ShoppingCart
{
    const SESSION_KEY   = 'cart';
    const SHIPPING_COST = 6;

    /**
     * @var ShoppingCartItem[]
     */
    protected $items;

    public function __construct(Request $request, ProductRepository $products)
    {
        $this->request = $request;
        $this->products = $products;

        // load from session if possible
        if ($request->session()->has(self::SESSION_KEY)) {
            $this->items = $request->session()->get(self::SESSION_KEY);
        }
        else {
            $this->items = [];
        }
    }

    public function addBoxes(string $id, int $ballsPerBox, int $boxes): void
    {
        $item = $this->getOrCreateItem($id, $ballsPerBox);

        $this->validateBoxes($newBoxes = $item->getBoxes() + $boxes);
        $item->setBoxes($newBoxes);
        $this->removeIfEmpty($id, $ballsPerBox);
        $this->updateSession();
    }

    /**
     * @param string $id
     * @param int $ballsPerBox
     *
     * @return ShoppingCartItem|null
     */
    public function getItem(string $id, int $ballsPerBox)
    {
        foreach ($this->items as $item) {
            if ($item->getProduct()->getId() === $id && $item->getBallsPerBox() === $ballsPerBox) {
                return $item;
            }
        }

        return null;
    }

    public function getBoxes(string $id, int $ballsPerBox): int
    {
        if ($item = $this->getItem($id, $ballsPerBox)) {
            return $item->getBoxes();
        }

        return 0;
    }

    public function getTotalBoxes(): int
    {
        $sum = 0;

        foreach ($this->items as $item) {
            $sum += $item->getBoxes();
        }

        return $sum;
    }

    public function getTotalCost(): float
    {
        $sum = 0;

        foreach ($this->items as $item) {
            $sum += $item->getQuantity()->getPricePerBox() * $item->getBoxes();
        }

        return $sum + $this->getShippingCost();
    }

    public function getShippingCost(): float
    {
        return self::SHIPPING_COST;
    }

    /**
     * @return ShoppingCartItem[]
     */
    public function getItems(): array
    {
        return $this->items;
    }

    public function setBoxes(string $id, int $ballsPerBox, int $boxes): void
    {
        $item = $this->getOrCreateItem($id, $ballsPerBox);

        $this->validateBoxes($boxes);
        $item->setBoxes($boxes);
        $this->removeIfEmpty($id, $ballsPerBox);
        $this->updateSession();
    }

    private function updateSession(): void
    {
        $this->request->session()->set(self::SESSION_KEY, $this->items);
    }

    private function validateBoxes(int $boxes): void
    {
        if ($boxes >= 1000) {
            throw new BadRequestHttpException('Boxes count exceeds maximum');
        }
    }

    private function getOrCreateItem(string $id, int $ballsPerBox): ShoppingCartItem
    {
        if (!($item = $this->getItem($id, $ballsPerBox))) {
            if (!($product = $this->products->getProductById($id))) {
                throw new BadRequestHttpException('Invalid product ID');
            }

            if (!($quantity = $product->getQuantity($ballsPerBox))) {
                throw new BadRequestHttpException('Invalid balls per box amount');
            }

            array_push($this->items, $item = new ShoppingCartItem($product, $ballsPerBox, 0));
        }

        return $item;
    }

    private function removeIfEmpty(string $id, int $ballsPerBox): void
    {
        foreach ($this->items as $i => $item) {
            if ($item->getBoxes() === 0 && $item->getProduct()->getId() === $id && $item->getBallsPerBox() === $ballsPerBox) {
                array_splice($this->items, $i, 1);
                return;
            }
        }
    }
}
