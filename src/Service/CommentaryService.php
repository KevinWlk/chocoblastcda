<?php

namespace App\Service;

use App\Entity\Commentary;
use App\Repository\ChocoblastRepository;
use App\Repository\CommentaryRepository;
use Doctrine\ORM\EntityManagerInterface;
class CommentaryService implements ServiceInterface{

    public function __construct(private readonly CommentaryRepository $commentaryRepository,
                                private readonly EntityManagerInterface $em){

                                }
    public function create(Object $object){
        //tester si le commentaire existe
        if (!$this->commentaryRepository->findOneBy(["content"=>$object->getContent(),"createAt"=>$object->getCreateAt])){
            $this->em->persist($object);
            $this->em->flush();
        } else {
            throw new \Exception("Le commentaire existe déjà.");
        }
    }
    public function update(object $object){
        if ($this->commentaryRepository->findOneBy(["content"=>$object->getContent(),"createAt"=>$object->getCreateAt])){
        $this->em->persist($object);
        $this->em->flush();
        } else { 
            throw new \Exception("Le commentaire n'existe pas.");
        }
    }
    public function delete(int $id){
        $commentary=$this->commentaryRepository->find($id);
        if ($commentary){
        $this->em->remove($commentary);
        $this->em->flush();
        } else {
        throw new \Exception("Le commentaire n'existe pas.");
        }
    }
    public function findOneBy(int $id):Object{
        return $this->commentaryRepository->find($id)??throw new \Exception('Le commentaire n\'existe pas');
    }
    public function findAll(): array{
        return $this->commentaryRepository->findAll()??throw new \Exception('Aucun commentaire trouvé en BDD');
    }
}