<?php

namespace Festival\EtablissementBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

use Festival\EtablissementBundle\Entity\Etablissement;
use Festival\EtablissementBundle\Form\EtablissementType;

class EtablissementController extends Controller
{
    
    public function listeEtablissementsAction()
    {
        $navbar = "etab";
        
        $repository = $this
        	->getDoctrine()
        	->getManager()
        	->getRepository('FestivalEtablissementBundle:Etablissement')
        ;

        $listeEtablissement = $repository->getAllEtablissement();

        return $this->render('@FestivalEtablissement/Etablissement/listeEtablissement.html.twig', array(
        	"navbar" => $navbar,
                "listeEtablissement" => $listeEtablissement,
        ));
    }
    
    public function unEtablissementAction($id)
    {
        $navbar = "etab";
        
        $repository = $this
        	->getDoctrine()
        	->getManager()
        	->getRepository('FestivalEtablissementBundle:Etablissement')
        ;
        
        $unEtablissement = $repository->find($id);
        
        return $this->render('@FestivalEtablissement/Etablissement/unEtablissement.html.twig', array(
        	"navbar" => $navbar,
                "unEtablissement" => $unEtablissement,
        )); 
    }
    
    public function ajouterEtablissementAction(Request $request){
        
        $navbar = "etab";
        
        $unEtablissement = new Etablissement();
        $form = $this->createForm(EtablissementType::class, $unEtablissement);
        
        if($request->isMethod('POST') && $form->handleRequest($request)->isValid()){

            if($form->isValid()){

                $em = $this->getDoctrine()->getManager();
                $em->persist($unEtablissement);
                $em->flush();

                $request->getSession()->getFlashBag()->add('notice', 'Etablissement ajouté.');

                return $this->redirectToRoute('festival_etablissement_etablissement', array('id' => $unEtablissement->getId()));
            }
        }

        return $this->render('@FestivalEtablissement/Etablissement/ajouterEtablissement.html.twig', array(
            'form' => $form->createView(),
            'navbar' => $navbar
        ));
    }
    
    public function modifierEtablissementAction(Request $request, $id)
    {
        
        $navbar = "etab";

        $unEtablissement = $this->getDoctrine()
            ->getManager()
            ->getRepository('FestivalEtablissementBundle:Etablissement')
            ->find($id)
        ;
    
        $form = $this->createForm(EtablissementType::class, $unEtablissement);

        if (null === $unEtablissement) {
            throw new NotFoundHttpException("L'établisseent d'id ".$id." n'existe pas.");
        }

        if($request->isMethod('POST')){

        $form->handleRequest($request);

            if($form->isValid()){

                $em = $this->getDoctrine()->getManager();
                $em->persist($unEtablissement);
                $em->flush();
                $request->getSession()->getFlashBag()->add('notice', 'Etablissement Modifié.');

                return $this->redirectToRoute('festival_etablissement_etablissement', array(
                    'id' => $unEtablissement->getId()
                ));
            }
        }

        return $this->render('@FestivalEtablissement/Etablissement/modifierEtablissement.html.twig', array(
            'form' => $form->createView(),
            'groupe' => $unEtablissement,
            'navbar' => $navbar
        ));
    }
    
    public function effacerEtablissementAction($id, Request $request)
  {

    #Variable Pour Le Hoover Du Navbar#
      $navbar = "etab";

    $unEtablissement = $this->getDoctrine()
      ->getManager()
      ->getRepository('FestivalEtablissementBundle:Etablissement')
      ->find($id)
    ;

    if ($unEtablissement != null){
        $em = $this->getDoctrine()->getManager();
        $em->remove($unEtablissement);
        $em->flush();
        $request->getSession()->getFlashBag()->add('notice', 'Etablissement Supprimé.');
    }else{
        throw new NotFoundHttpException("L'établissement d'id".$id." n'existe pas.");
    }
    
    return $this->redirectToRoute('festival_etablissement_listeetablissement', array(
      'navbar' => $navbar
    ));
  }
    
}