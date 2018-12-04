<?php

namespace App\Controller;

use App\Entity\Ad;
use App\Entity\Image;
use App\Form\AnnonceType;
use App\Repository\AdRepository;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AdController extends AbstractController
{
    /**
     * @Route("/ads", name="ads_index")
     */
    public function index(AdRepository $repo)
    {
        //$repo =$this->getDoctrine()->getRepository(Ad::class);
        $ads=$repo->findAll();
        return $this->render('ad/index.html.twig', [
            'ads' => $ads,
        ]);
    }


    /**
 *  Permet de créer une annonce
 * 
 * @Route("/ads/new", name="ads_create" )
 * @return Response
 */
public function create(Request $request,ObjectManager $manager){

        $ad = new Ad();
        $image = new Image();
        
        $form = $this->createForm(AnnonceType::class, $ad);
        $form->handleRequest($request);
        if ($form->isSubmitted() &&  $form->isValid()){
           // $manager = $this->getDoctrine()->getManager();
foreach($ad->getImages() as $image){
    $image->setAd($ad);
    $manager->persist($image);
}

            $manager->persist($ad);
            $manager->flush();
            $this->addFlash(
                'success',
                "l'annone <strong> {$ad->getTitle()}</strong> a bien été enregistré ! "
            );
            return $this->redirectToRoute('ads_show',[
                'slug'=>$ad->getSlug()
            ]);
        }
            return $this->render('ad/new.html.twig',[
                'form'=> $form->createView()
            ]);
        }

        /**
         * Permet d'afficher le formulaire d'edition
         * @Route("/ads/{slug}/edit", name="ads_edit")
         */
        public function edit(Ad $ad, Request $request, ObjectManager $manager){
            $form = $this->createForm(AnnonceType::class, $ad);
            $form->handleRequest($request);
            if ($form->isSubmitted() &&  $form->isValid()){
                // $manager = $this->getDoctrine()->getManager();
     foreach($ad->getImages() as $image){
         $image->setAd($ad);
         $manager->persist($image);
     }
     
                 $manager->persist($ad);
                 $manager->flush();
                 $this->addFlash(
                     'success',
                     "l'annone <strong> {$ad->getTitle()}</strong> a bien été modifiée ! "
                 );
                 return $this->redirectToRoute('ads_show',[
                     'slug'=>$ad->getSlug()
                 ]);
             }
            return $this->render('ad/edit.html.twig',[
                'form'=> $form->createView() ,
                'ad'=>$ad
            ]);
        }


/**
 *  Permet d'afficher une seule annone
 * 
 * @Route("/ads/{slug}", name="ads_show" )
 * @return Response
 */
    // public function show(Ad $ad , $slug)
    public function show(Ad $ad){

       
        return $this->render('ad/show.html.twig', [
            'ad' => $ad,
        ]);

    }


}
