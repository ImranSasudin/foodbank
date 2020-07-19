<?php


/**
 *
 */
class Campaign
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
    public $campID [PK];

    /**
     * @var void
     */
    public $empID  [FK];

    /**
     * @var void
     */
    public $campName;

    /**
     * @var void
     */
    public $campPlace;

    /**
     * @var void
     */
    public $campTime;

    /**
     * @var void
     */
    public $campDate;


}
