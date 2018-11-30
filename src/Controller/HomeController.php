<?php 
namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class HomeController extends Controller{

    /**
     * @Route("/", name="homepage")
     */
    public function home(){

        $prenoms=["tata","mama","test"];
        $ages=["tata"=>31,"mama"=>12,"test"=>10];
        return $this->render(
            'home.html.twig',
            ['title'=>"coucou ts le monde",
             'age'=>"31",
             'tableau'=>$prenoms,
             'agetableau'=>$ages  
            ]
        );
    }
}




?>