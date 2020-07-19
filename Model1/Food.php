<?php


/**
 *
 */
class Food
{
    /**
     *
     */
    public function __construct()
    {
    }

    /**
     * @var void
     */
    public $foodID [PK];

    /**
     * @var void
     */
    public $foodCategory;

    /**
     * @var void
     */
    public $foodName;

    /**
     * @var void
     */
    public $amount;

    /**
     * @var void
     */
    public $preferable;




    /**
     *
     */
    class RequiredFood
    {
        /**
         *
         */
        public function __construct()
        {
        }

        /**
         * @var void
         */
        public $foodID [PK FK];

        /**
         * @var void
         */
        public $campID [PK FK];

        /**
         * @var void
         */
        public $requiredQty;

        /**
         * @var void
         */
        public $currentQty;


    }

}
