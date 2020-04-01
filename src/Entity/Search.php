<?php

namespace App\Entity;
use Symfony\Component\Validator\Constraints as Assert; // verification de Validator si tout est bien rempli


class Search
{
  

    /**
    * @Assert\NotBlank
     */
    protected  $search;

    public function getSearch()
    {
        return $this->search;
    }

    public function setSearch($search)
    {
        $this->search = $search;

        return $this;
    }

    
}