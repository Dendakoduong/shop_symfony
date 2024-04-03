<?php

namespace App\Model;

/**
 * Allows to create a search form using a SearchType
 */
class Search
{
    /**
     * @var string
     */
    private $string = '';

    /**
     * @var array
     */
    private $categories = [];

    /**
     * @var array
     */
    private $priceRange = 10;

    /**
     * Get the value of string
     */
    public function getString()
    {
        return $this->string;
    }

    /**
     * Set the value of string
     *
     * @return  self
     */
    public function setString($string)
    {
        $this->string = $string;

        return $this;
    }

    /**
     * Get the value of categories
     */
    public function getCategories()
    {
        return $this->categories;
    }

    /**
     * Set the value of categories
     *
     * @return  self
     */
    public function setCategories($categories)
    {
        $this->categories = $categories;

        return $this;
    }
    /**
     * Get the value of priceRange
     */
    public function getPriceRange(): int
    {
        return $this->priceRange;
    }

    public function setPriceRange(int $priceRange): self
    {
        $this->priceRange = $priceRange;

        return $this;
    }
}
