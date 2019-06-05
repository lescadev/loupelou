<?php
namespace App\Service;
use Doctrine\ORM\EntityManager;
use Twig\Extension\AbstractExtension;
use Twig\Extension\GlobalsInterface;
use App\Repository\InformationsRepository;


class Slogan extends AbstractExtension {

    private $informationsrepository;

   public function __construct(InformationsRepository $informationsrepository)
   {
      $this->informationsrepository = $informationsrepository;
   }

    public function getInfo(){
        $info = $this->informationsrepository->find(1)->getSlogan();
        return $info;
    }
}
