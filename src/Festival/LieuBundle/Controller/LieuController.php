<?php

namespace Festival\LieuBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

use Festival\LieuBundle\Entity\Lieu;
use Festival\LieuBundle\Form\LieuType;

class LieuController extends Controller
{
    
    public function listeLieuAction()
    {
        $navbar = "lieu";
        
        $repository = $this
        	->getDoctrine()
        	->getManager()
        	->getRepository('FestivalLieuBundle:Lieu')
        ;

        $listeLieu = $repository->findAll();

        return $this->render('@FestivalLieu/Lieu/listeLieu.html.twig', array(
        	"navbar" => $navbar,
                "listeLieu" => $listeLieu,
        ));
    }
    
    public function unLieuAction($id)
    {
        $navbar = "lieu";
        
        $repository = $this
        	->getDoctrine()
        	->getManager()
        	->getRepository('FestivalLieuBundle:Lieu')
        ;
        
        $unLieu = $repository->find($id);
        
        return $this->render('@FestivalLieu/Lieu/unLieu.html.twig', array(
        	"navbar" => $navbar,
                "unLieu" => $unLieu,
        )); 
    }
    
    public function ajouterLieuAction(Request $request){
        
        $navbar = "lieu";
        
        $unLieu = new Lieu();
        $form = $this->createForm(LieuType::class, $unLieu);
        
        if($request->isMethod('POST') && $form->handleRequest($request)->isValid()){

            if($form->isValid()){

                $em = $this->getDoctrine()->getManager();
                $em->persist($unLieu);
                $em->flush();

                $request->getSession()->getFlashBag()->add('notice', 'Lieu ajouté.');

                return $this->redirectToRoute('festival_lieu_unlieu', array('id' => $unLieu->getId()));
            }
        }

        return $this->render('@FestivalLieu/Lieu/ajouterLieu.html.twig', array(
            'form' => $form->createView(),
            'navbar' => $navbar
        ));
    }
    
    public function modifierLieuAction(Request $request, $id)
    {
        

        $navbar = "lieu";

        $unLieu = $this->getDoctrine()
            ->getManager()
            ->getRepository('FestivalLieuBundle:Lieu')
            ->find($id)
        ;
    
        $form = $this->createForm(GroupeType::class, $unLieu);

        if (null === $unLieu) {
            throw new NotFoundHttpException("Le lieu d'id ".$id." n'existe pas.");
        }

        if($request->isMethod('POST')){

        $form->handleRequest($request);

            if($form->isValid()){

                $em = $this->getDoctrine()->getManager();
                $em->persist($unLieu);
                $em->flush();
                $request->getSession()->getFlashBag()->add('notice', 'Lieu Modifié.');

                return $this->redirectToRoute('festival_lieu_unlieu', array(
                    'id' => $unLieu->getId()
                ));
            }
        }

        return $this->render('@FestivalLieu/Lieu/modifierLieu.html.twig', array(
            'form' => $form->createView(),
            'unLieu' => $unLieu,
            'navbar' => $navbar
        ));
    }
    
    public function effacerLieuAction($id, Request $request)
  {

    #Variable Pour Le Hoover Du Navbar#
      $navbar = "lieu";

    $unLieu = $this->getDoctrine()
      ->getManager()
      ->getRepository('FestivalLieuBundle:Lieu')
      ->find($id)
    ;

    if ($unLieu != null){
        $em = $this->getDoctrine()->getManager();
        $em->remove($unLieu);
        $em->flush();
        $request->getSession()->getFlashBag()->add('notice', 'Lieu Supprimé.');
    }else{
        throw new NotFoundHttpException("Le lieu d'id".$id." n'existe pas.");
    }
    
    return $this->redirectToRoute('festival_lieu_listelieu', array(
      'navbar' => $navbar
    ));
  }
    
}