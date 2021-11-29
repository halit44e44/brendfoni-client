<?php

namespace ConnectProf\App\Model\Brendfoni\Features\Product;

/**
 * Trait ProductFactory
 * @package ConnectProf\App\Model\Brendfoni\Features\Product
 * @author Halit DOĞAN <halit.dogan@tsoft.com.tr>
 */
class ProductFactory
{
    /**
     * Brendfoni All Product List
     * @var array $products
     */
    public $products = [];

    /**
     * Brendfoni Quick Update Product List
     * @var array $products
     */
    public $quickProduct = [];

    /**
     * Brendfoni Create Product Model and Add the product list
     *
     * Product Variables
     * @param string $name required
     * @param float $original_price required
     * @param float $discount_price required
     * @param string $short_description required
     * @param string $long_description required
     * @param string $family_code required
     * @param array<integer> $categories required
     * @param array<string> $images required
     */
    public function createOrUpdateSingleProductModel(
        string $name,
        float  $original_price,
        float  $discount_price,
        string $short_description,
        string $long_description,
        string $family_code,
        array  $categories,
        array  $images
    ): ProductExtra
    {
        $product = [
            'name' => $name,
            'original_price' => $original_price,
            'discount_price' => $discount_price,
            'short_description' => $short_description,
            'long_description' => $long_description,
            'family_code' => $family_code,
            'categories' => $categories,
            'images' => $images,
        ];

        return new ProductExtra($product, $this);
    }


    /**
     * Brendfoni quick update Product Model
     *
     * Product Variables
     * @param string $barcode
     * @param float $original_price
     * @param int|null $quantity
     * @param float|null $discount_price
     * @param array|null $promotions ['id' => 7, 'price' => 33]
     */
    public function quickUpdateProduct
    (
        string $barcode,
        float  $original_price,
        int $quantity = null,
        float $discount_price = null,
        array  $promotions = null
    ): void
    {
        $array = [
            'barcode' => $barcode,
            'original_price' => $original_price
        ];

        if (!is_null($quantity)) $array['quantity'] = $quantity;
        if (!is_null($discount_price)) $array['discount_price'] = $discount_price;
        if (!is_null($promotions)) $array['promotion'] = $promotions;

        $this->quickProduct['items'][] = $array;
    }

    /**
     * Brendfoni get all products
     * @return array
     */
    protected function getProductModel(): array
    {
        return $this->products;
    }

    /**
     * Brendfoni get all quick Update products
     * @return array
     */
    protected function getQuickUpdateModel(): array
    {
        return $this->quickProduct;
    }
}