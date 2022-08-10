<?php

declare(strict_types=1);

namespace App\Entity\Product;

use Doctrine\ORM\Mapping as ORM;
use Sylius\Component\Core\Model\Product as BaseProduct;
use Sylius\Component\Product\Model\ProductTranslationInterface;

/**
 * @ORM\Entity
 * @ORM\Table(name="sylius_product")
 */
class Product extends BaseProduct
{
    protected function createTranslation(): ProductTranslationInterface
    {
        return new ProductTranslation();
    }

    /**
     * @ORM\Column(type="boolean", options={"default" : 0}))
     */
    private $isPack;

    /**
     * @return mixed
     */
    public function getIsPack()
    {
        return $this->isPack;
    }

    /**
     * @param mixed $isPack
     */
    public function setIsPack($isPack): void
    {
        $this->isPack = $isPack;
    }


}
