<?php

namespace Evrinoma\ContrAgentBundle\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class ContrAgentController
 *
 * @package Evrinoma\ContrAgentBundle\Controller
 */
final class ContrAgentController extends AbstractController
{
//region SECTION: Public
    /**
     * @Route("/contr_agent", options={"expose"=true}, name="contr_agent")
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function project()
    {
        $event = ['titleHeader' => 'ContrAgent', 'pageName' => 'ContrAgent'];

        return $this->render('@EvrinomaContrAgent/contr_agent.html.twig', $event);
    }

//endregion Public
}