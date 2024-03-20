<?php

namespace App\Model;

use App\Entity\Campus;
use App\Entity\User;
use DateTime;
use phpDocumentor\Reflection\Types\Boolean;
use Symfony\Component\Security\Core\User\UserInterface;


class SearchFilterData
{
    public ?string $zoneRecherche = '';

    public ?Campus $Campus ;

    public ?DateTime $min;

    public ?DateTime $max;

    public $organisateur = false;

    public $inscrit = false;

    public $nonInscrit = false;

    public $pastOutings = false;

}