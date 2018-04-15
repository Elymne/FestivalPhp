<?php

namespace Festival\HebergementBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

use Festival\HebergementBundle\Entity\Hebergement;
use Festival\HebergementBundle\Form\HebergementType;

class HebergementController extends Controller
{
    public function listeHebergementsAction()
    {
        $navbar = "hebergement";
        
        $repository = $this
        	->getDoctrine()
        	->getManager()
        	->getRepository('FestivalHebergementBundle:Hebergement')
        ;

        $listeHebergements = $repository->findAll();

        return $this->render('@FestivalHebergement/Hebergement/listeHebergements.html.twig', array(
        	"navbar" => $navbar,
                "listeHebergements" => $listeHebergements,
        ));
    }
    
    public function unHebergementAction($id)
    {
        $navbar = "hebergement";
        
        $repository = $this
        	->getDoctrine()
        	->getManager()
        	->getRepository('FestivalHebergementBundle:Hebergement')
        ;
        
        $unHebergement = $repository->find($id);
        
        return $this->render('@FestivalHebergement/Hebergement/unHebergement.html.twig', array(
        	"navbar" => $navbar,
                "unHebergement" => $unHebergement,
        )); 
    }
    
    public function ajouterHebergementAction(Request $request){
        
        $navbar = "hebergement";
        
        $unHebergement = new Hebergement();
        $form = $this->createForm(HebergementType::class, $unHebergement);
        
        if($request->isMethod('POST') && $form->handleRequest($request)->isValid()){

            if($form->isValid()){

                $em = $this->getDoctrine()->getManager();
                $em->persist($unHebergement);
                $em->flush();

                $request->getSession()->getFlashBag()->add('notice', 'Hebergement ajouté.');

                return $this->redirectToRoute('festival_hebergement_hebergement', array('id' => $unHebergement->getId()));
            }
        }

        return $this->render('@FestivalHebergement/Hebergement/ajouterHebergement.html.twig', array(
            'form' => $form->createView(),
            'navbar' => $navbar
        ));
    }
    
    public function effacerHebergementAction($id, Request $request)
  {

    #Variable Pour Le Hoover Du Navbar#
      $navbar = "hebergement";

    $unHebergement = $this->getDoctrine()
      ->getManager()
      ->getRepository('FestivalHebergementBundle:Hebergement')
      ->find($id)
    ;

    if ($unHebergement != null){
        $em = $this->getDoctrine()->getManager();
        $em->remove($unHebergement);
        $em->flush();
        $request->getSession()->getFlashBag()->add('notice', 'Hebergement Supprimée.');
    }else{
        throw new NotFoundHttpException("L'hebergement d'id".$id." n'existe pas.");
    }
    
    return $this->redirectToRoute('festival_hebergement_listehebergements', array(
      'navbar' => $navbar
    ));
  }
}