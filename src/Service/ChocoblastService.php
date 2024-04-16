<?php

namespace App\Service;

use App\Entity\Chocoblast;
use App\Repository\ChocoblastRepository;
use Doctrine\ORM\EntityManagerInterface;
class ChocoblastService implements ServiceInterface{

    public function __construct(private readonly ChocoblastRepository $chocoblastRepository,
                                private readonly EntityManagerInterface $em){

                                }
    public function create(Object $object){
        //tester si le chocoblast existe
        if (!$this->chocoblastRepository->findOneBy(["title"=>$object->getTitle(),"createAt"=>$object->getCreateAt])){
            $this->em->persist($object);
            $this->em->flush();
        } else {
            throw new \Exception("Le chocoblast existe déjà.");
        }
    }
    public function update(object $object){
        if ($this->chocoblastRepository->findOneBy(["title"=>$object->getTitle(),"createAt"=>$object->getCreateAt])){
        $this->em->persist($object);
        $this->em->flush();
        } else {
        throw new \Exception("Le chocoblast n'existe pas.");
        }
    }
    public function delete(int $id){
        $chocoblast=$this->chocoblastRepository->find($id);
        if ($chocoblast){
        $this->em->remove($chocoblast);
        $this->em->flush();
        } else {
        throw new \Exception("Le chocoblast n'existe pas.");
        }
    }
    public function findOneBy(int $id):Object{
        return $this->chocoblastRepository->find($id)??throw new \Exception('Le chocoblast n\'existe pas');
    }
    public function findAll(): array{
        return $this->chocoblastRepository->findAll()??throw new \Exception('Aucun chocoblast trouvé en BDD');
    }
}