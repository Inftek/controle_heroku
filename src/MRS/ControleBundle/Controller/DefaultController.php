<?php
namespace MRS\ControleBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;


class DefaultController extends Controller
{


    /**
     * @return Response
     * @Route("/", name="home")
     * @Method({"GET"})
     */
    public function indexAction()
    {
        return $this->redirectToRoute('app_about');
    }

    /**
     * @return Response
     * @Route("/about", name="app_about")
     * @Method({"GET"})
     */
    public function aboutAction()
    {
        return $this->render('@MRSControle/Default/about.html.twig');
    }

    /**
     * @return Response
     * @Route("/dashboard", name="dashboard")
     * @Method({"GET"})
     */
    public function dashboardAction()
    {
        return $this->render('@MRSControle/Default/dashboard.html.twig');
    }

    /**
     * @Route("/horarioregister", name="horario_register")
     * @Method({"POST","GET"})
     */
    public function registerButtonAction(Request $request)
    {

        $text = $this->get('horario.register')
            ->registerHorario();

        $this->addFlash('notice',$text);

        return $this->redirect($this->generateUrl('horario'));

    }

}
