<?php

namespace App\Model;

use App\Entity\Campus;
use DateTime;
use phpDocumentor\Reflection\Types\Boolean;


class SearchFilterData
{
    public ?string $zoneRecherche = '';

    public ?Campus $Campus ;

    public ?DateTime $min;

    public ?DateTime $max;

    /**
    @var boolean*/
    public $organisateur = false;

    /**
    @var boolean*/
    public $inscrit = false;

    /**
    @var boolean*/
    public $nonInscrit = false;

    public $pastOutings = false;

}