<?php


/**
 *
 */
class Transaction
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
    public $transID [PK];

    /**
     * @var void
     */
    public $donorID [FK];

    /**
     * @var void
     */
    public $deliveryDate;

    /**
     * @var void
     */
    public $deliveryTime;

    /**
     * @var void
     */
    public $status;





    /**
     *
     */
    class Food_Donation
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
        public $transID [PK FK];

        /**
         * @var void
         */
        public $foodID [PK FK];

        /**
         * @var void
         */
        public $quantity;


    }

}
