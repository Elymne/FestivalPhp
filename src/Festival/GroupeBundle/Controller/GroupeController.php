<?php

namespace Festival\GroupeBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

use Festival\GroupeBundle\Entity\Groupe;
use Festival\GroupeBundle\Form\GroupeType;

class GroupeController extends Controller
{
    
    public function listGroupAction()
    {
        $navbar = "group";
        
        $repository = $this
        	->getDoctrine()
        	->getManager()
        	->getRepository('FestivalGroupeBundle:Groupe')
        ;

        $listeGroupe = $repository->getAllGroupe();

        return $this->render('@FestivalGroupe/Groupe/listGroup.html.twig', array(
        	"navbar" => $navbar,
                "listeGroupe" => $listeGroupe,
        ));
    }
    
    public function unGroupeAction($id)
    {
        $navbar = "group";
        
        $repository = $this
        	->getDoctrine()
        	->getManager()
        	->getRepository('FestivalGroupeBundle:Groupe')
        ;
        
        $unGroupe = $repository->getOneById($id);
        
        return $this->render('@FestivalGroupe/Groupe/unGroupe.html.twig', array(
        	"navbar" => $navbar,
                "unGroupe" => $unGroupe,
        )); 
    }
    
    public function ajouterGroupeAction(Request $request){
        
        $navbar = "group";
        
        $groupe = new Groupe();
        $form = $this->createForm(GroupeType::class, $groupe);
        
        if($request->isMethod('POST') && $form->handleRequest($request)->isValid()){

            if($form->isValid()){

                $em = $this->getDoctrine()->getManager();
                $em->persist($groupe);
                $em->flush();

                $request->getSession()->getFlashBag()->add('notice', 'Evénement ajouté.');

                return $this->redirectToRoute('festival_groupe_ungroup', array('id' => $groupe->getId()));
            }
        }

        return $this->render('@FestivalGroupe/Groupe/ajouterGroupe.html.twig', array(
            'form' => $form->createView(),
            'navbar' => $navbar
        ));
    }
    
    public function modifierGroupeAction(Request $request, $id)
    {
        

        $navbar = "group";

        $groupe = $this->getDoctrine()
            ->getManager()
            ->getRepository('FestivalGroupeBundle:Groupe')
            ->find($id)
        ;
    
        $form = $this->createForm(GroupeType::class, $groupe);

        if (null === $groupe) {
            throw new NotFoundHttpException("Le groupe d'id ".$id." n'existe pas.");
        }

        if($request->isMethod('POST')){

        $form->handleRequest($request);

            if($form->isValid()){

                $em = $this->getDoctrine()->getManager();
                $em->persist($groupe);
                $em->flush();
                $request->getSession()->getFlashBag()->add('notice', 'Groupe Modifié.');

                return $this->redirectToRoute('festival_groupe_ungroup', array(
                    'id' => $groupe->getId()
                ));
            }
        }

        return $this->render('@FestivalGroupe/Groupe/modifierGroupe.html.twig', array(
            'form' => $form->createView(),
            'groupe' => $groupe,
            'navbar' => $navbar
        ));
    }
    
    public function effacerGroupeAction($id, Request $request)
  {

    #Variable Pour Le Hoover Du Navbar#
      $navbar = "group";

    $groupe = $this->getDoctrine()
      ->getManager()
      ->getRepository('FestivalGroupeBundle:Groupe')
      ->find($id)
    ;

    if ($groupe != null){
        $em = $this->getDoctrine()->getManager();
        $em->remove($groupe);
        $em->flush();
        $request->getSession()->getFlashBag()->add('notice', 'Groupe Supprimé.');
    }else{
        throw new NotFoundHttpException("Le groupe d'id".$id." n'existe pas.");
    }
    
    return $this->redirectToRoute('festival_groupe_listgroup', array(
      'navbar' => $navbar
    ));
  }
    
}