<?php

namespace AppBundle\Controller;

use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use AppBundle\Entity\News;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Form\NewsType;

/**
 * Class DefaultController
 * @package AppBundle\Controller
 * @Route("/news")
 */
class NewsController extends BaseController
{
    /**
     * @Route("/list", name="news.list")
     */
    public function indexAction(Request $request):Response
    {
        return $this->render('AppBundle:news:list.html.twig', [
            'news' => $this->getDoctrine()->getRepository(News::class)->findAllWithJoins()
        ]);
    }

    /**
     * @Route("/item/{slug}", name="news.read")
     * @ParamConverter("news", class="AppBundle:News", options={"repository_method" = "findOneBySlugWithJoins", "map_method_signature" = true})
     * @param News $news
     * @return Response
     */
    public function readAction(News $news):Response
    {
        return $this->render('AppBundle:news:read.html.twig', [
            'news' => $news
        ]);
    }

    /**
     * @Route("/create", name="news.create")
     * @param Request $request
     * @return Response
     */
    public function createAction(Request $request):Response
    {
        $form = $this->handleForm(NewsType::class, new News(), $request);

        if ($form->isValid()) {
            return $this->redirectToRoute('news.update', ['id' => $form->getData()->getId()]);
        }

        return $this->render('AppBundle:news:create.html.twig', ['form' => $form->createView()]);
    }

    /**
     * @Route("/update/{id}", name="news.update")
     * @ParamConverter("news", class="AppBundle:News", options={"repository_method" = "findOneByIdWithJoins", "map_method_signature" = true})
     * @param Request $request
     * @param News $news
     * @return Response
     */
    public function updateAction(Request $request, News $news):Response
    {
        return $this->render('AppBundle:news:update.html.twig', ['form' => $this->handleForm(NewsType::class, $news, $request)->createView()]);
    }

}