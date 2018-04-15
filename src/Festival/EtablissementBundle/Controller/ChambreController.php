<?php

namespace Festival\EtablissementBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

use Festival\EtablissementBundle\Entity\Chambre;
use Festival\EtablissementBundle\Form\ChambreType;

class ChambreController extends Controller
{
    public function listeChambresAction()
    {
        $navbar = "chambre";
        
        $repository = $this
        	->getDoctrine()
        	->getManager()
        	->getRepository('FestivalEtablissementBundle:Chambre')
        ;

        $listeChambres = $repository->getAllChambre();

        return $this->render('@FestivalEtablissement/Chambre/listeChambres.html.twig', array(
        	"navbar" => $navbar,
                "listeChambres" => $listeChambres,
        ));
    }
    
    public function uneChambreAction($id)
    {
        $navbar = "chambre";
        
        $repository = $this
        	->getDoctrine()
        	->getManager()
        	->getRepository('FestivalEtablissementBundle:Chambre')
        ;
        
        $uneChambre = $repository->find($id);
        
        return $this->render('@FestivalEtablissement/Chambre/uneChambre.html.twig', array(
        	"navbar" => $navbar,
                "uneChambre" => $uneChambre,
        )); 
    }
    
    public function ajouterChambreAction(Request $request){
        
        $navbar = "chambre";
        
        $uneChambre = new Chambre();
        $form = $this->createForm(ChambreType::class, $uneChambre);
        
        if($request->isMethod('POST') && $form->handleRequest($request)->isValid()){

            if($form->isValid()){

                $em = $this->getDoctrine()->getManager();
                $em->persist($uneChambre);
                $em->flush();

                $request->getSession()->getFlashBag()->add('notice', 'Chambre ajouté.');

                return $this->redirectToRoute('festival_etablissement_chambre', array('id' => $uneChambre->getId()));
            }
        }

        return $this->render('@FestivalEtablissement/Chambre/ajouterChambre.html.twig', array(
            'form' => $form->createView(),
            'navbar' => $navbar
        ));
    }
    
    public function modifierChambreAction(Request $request, $id)
    {
        
        $navbar = "chambre";

        $uneChambre = $this->getDoctrine()
            ->getManager()
            ->getRepository('FestivalEtablissementBundle:Chambre')
            ->find($id)
        ;
    
        $form = $this->createForm(ChambreType::class, $uneChambre);

        if (null === $uneChambre) {
            throw new NotFoundHttpException("La chambre d'id ".$id." n'existe pas.");
        }

        if($request->isMethod('POST')){

        $form->handleRequest($request);

            if($form->isValid()){

                $em = $this->getDoctrine()->getManager();
                $em->persist($uneChambre);
                $em->flush();
                $request->getSession()->getFlashBag()->add('notice', 'Chambre Modifiée.');

                return $this->redirectToRoute('festival_etablissement_chambre', array(
                    'id' => $uneChambre->getId()
                ));
            }
        }

        return $this->render('@FestivalEtablissement/Chambre/modifierChambre.html.twig', array(
            'form' => $form->createView(),
            'groupe' => $uneChambre,
            'navbar' => $navbar
        ));
    }
    
    public function effacerChambreAction($id, Request $request)
  {

    #Variable Pour Le Hoover Du Navbar#
      $navbar = "chambre";

    $uneChambre = $this->getDoctrine()
      ->getManager()
      ->getRepository('FestivalEtablissementBundle:Chambre')
      ->find($id)
    ;

    if ($uneChambre != null){
        $em = $this->getDoctrine()->getManager();
        $em->remove($uneChambre);
        $em->flush();
        $request->getSession()->getFlashBag()->add('notice', 'Chambre Supprimée.');
    }else{
        throw new NotFoundHttpException("La chambre d'id".$id." n'existe pas.");
    }
    
    return $this->redirectToRoute('festival_etablissement_listechambres', array(
      'navbar' => $navbar
    ));
  }
}