<?php

namespace ConnectProf\App\Model\Brendfoni\Features\Product;

/**
 * Brendfoni Product Extra Information Add Class
 * @package ConnectProf\App\Model\Brendfoni\Features\Product
 * @author Halit DOĞAN <halit.dogan@tsoft.com.tr>
 */
class ProductExtra
{
    /**
     * Brendfoni Single Product Item
     * @var array $product
     */
    public $product;

    /**
     * @var ProductFactory $productFactory
     */
    public $productFactory;

    /**
     * ProductExtra Constructor
     * @param array $product
     * @param ProductFactory $productFactory
     */
    public function __construct(array $product, ProductFactory $productFactory)
    {
        $this->productFactory = $productFactory;
        $this->product = $product;
    }

    /**
     * Brendfoni Product Add Combination Item
     *
     * @param string|null $name
     * @param int|null $quantity
     * @param string|null $code
     * @param string|null $barcode
     * @param bool $active
     * @param float|null $original_price
     * @param float|null $discount_price
     * @param string|null $short_description
     * @param string|null $long_description
     * @param array|null $variants
     * @return $this
     */
    public function addCombination(
        int    $quantity,
        string $code,
        string $barcode,
        float  $original_price,
        bool   $active = false,
        string $name = null,
        float  $discount_price = null,
        string $short_description = null,
        string $long_description = null,
        array  $variants = []
    ): ProductExtra
    {
        /**
         * Required Paramter
         */
        $params = [
            'quantity' => $quantity,
            'code' => $code,
            'barcode' => $barcode,
            'active' => $active,
            'original_price' => $original_price
        ];

        /**
         * Optional Paramater
         */
        if (!is_null($name)) $params['name'] = $name;
        if (!is_null($discount_price)) $params['discount_price'] = $discount_price;
        if (!is_null($short_description)) $params['short_description'] = $short_description;
        if (!is_null($long_description)) $params['long_description'] = $long_description;
        if (!empty($variants)) $params['variants'] = $variants;

        $this->product['combinations'][] = $params;
        return $this;
    }

    /**
     * Product Add Promotion Only One Promotion per Product
     * @param int $id
     * @param float $price
     * @return $this
     */
    public function addPromotion(
        int   $id,
        float $price
    ): ProductExtra
    {
        $this->product['promotion'] = [
            'id' => $id,
            'price' => $price
        ];
        return $this;
    }

    /**
     * Product Add Common Variant
     * @param int $feature_id
     * @param int $variant_id
     * @return $this
     */
    public function addCommonVariants(
        int $feature_id,
        int $variant_id
    ): ProductExtra
    {
        $this->product['common_variants'][] = [
            'feature_id' => $feature_id,
            'variant_id' => $variant_id
        ];
        return $this;
    }

    /**
     * ProductExtra Destructor
     * Push the single product item
     */
    public function __destruct()
    {
        array_push($this->productFactory->products, $this->product);
    }
}