<?php

namespace App\Controller;

use App\Entity\Search;
use App\Form\Type\SearchType;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\OptionsResolver\OptionsResolver;
use App\Repository\GameRepository;
class SearchController extends AbstractController
{
  
    
    /**
     * @Route("/search", name="search")
     */
    public function SearchGame(Request $request,GameRepository $jeuxRepository)
    {
        // creates a Search object and initializes some data for this example
        $recherche = new Search();
        $recherche->setSearch('Far cry'); // ou $_[POST]

        $form = $this->createFormBuilder($recherche)
            ->add('search', TextType::class)
            ->add('send', SubmitType::class, ['label' => 'Rechercher'])
            ->getForm();

            // $form = $this->createForm(SearchType::class); // recherche en parametre fait bugger ca marche pas comme ca !!!! c est nul !!

            ///////////////////////// VALIDATION FORMULAIRE ////////////////
            $form->handleRequest($request);
            if ($form->isSubmitted() && $form->isValid()) {
                // $form->getData() holds the submitted values
                // but, the original `$task` variable has also been updated
                dump('CA FONCTIONNE !!');
                $recherche = $form->getData();
                dump($form->getData()->getSearch()); // ca renvoi un objet 
                
                $jeux = $jeuxRepository->trouverJeux($recherche->getSearch());

                if (!$jeux) {
                    return $this->render('liste_des_jeux/index.html.twig',['form' => $form->createView(), 'allgames' => $jeux, 'error' => ' Nous avons trouver aucun jeux correspondant à votre recherche!']);
                }
                return $this->render('liste_des_jeux/index.html.twig', ['allgames' => $jeux, 'form' => $form->createView()]);

            }
            else{

                ///////////////////////// LE AFFICHAGE AVANT ENVOI DE LA RECHERCHE ////////////////

                        // // look for *all* games objects
                $jeux = $jeuxRepository->findAll();
                // dump($jeux);
                // return new Response('le produit'.$nameProduct.' avec l\'id '.$idProduct.'a été supprimé');
                if (!$jeux) {
                    throw $this->createNotFoundException(
                        ' Nous avons trouver aucun jeux !'
                    );
                }
                return $this->render('liste_des_jeux/index.html.twig', ['allgames' => $jeux, 'form' => $form->createView()]);

                    // return $this->render('search/index.html.twig', [
                    //     'form' => $form->createView(), // la createView()méthode pour créer un autre objet avec la représentation visuelle du formulaire:
                    // ]);
            }
     
    }

    //Ainsi, bien que cela ne soit pas toujours nécessaire, il est généralement judicieux de 
    //spécifier explicitement l' data_classoption en ajoutant ce qui suit à votre classe de type de formulaire:
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Search::class,
        ]);
    }

    
    

}
