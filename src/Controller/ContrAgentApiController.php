<?php

namespace Evrinoma\ContrAgentBundle\Controller;


use Evrinoma\ContrAgentBundle\Manager\ContrAgentManager;
use Evrinoma\UtilsBundle\Controller\AbstractApiController;
use FOS\RestBundle\Controller\Annotations as Rest;
use OpenApi\Annotations as OA;

/**
 * Class ContrAgentApiController
 *
 * @package Evrinoma\ContrAgentBundle\Controller
 */
final class ContrAgentApiController extends AbstractApiController
{
//region SECTION: Fields
    /**
     * @var ContrAgentManager
     */
    private $contrAgentManager;
//endregion Fields

//region SECTION: Constructor
    /**
     * ApiController constructor.
     *
     * @param ContrAgentManager $contrAgentManager
     */
    public function __construct(ContrAgentManager $contrAgentManager)
    {
        $serializer = \JMS\Serializer\SerializerBuilder::create()
            ->setPropertyNamingStrategy(
                new \JMS\Serializer\Naming\SerializedNameAnnotationStrategy(
                    new \JMS\Serializer\Naming\IdenticalPropertyNamingStrategy()
                )
            )
            ->build();

        parent::__construct($serializer);
        $this->contrAgentManager = $contrAgentManager;
    }
//endregion Constructor

//region SECTION: Public

    /**
     * @Rest\Get("/api/contr_agent", options={"expose"=true}, name="api_contr_agent")
     * @OA\Get(tags={"contr_agent"})
     * @OA\Response(response=200,description="Returns contr_agent")
     *
     * @return \Symfony\Component\HttpFoundation\JsonResponse
     */
    public function projectAction()
    {
        return $this->json($this->contrAgentManager->setRestSuccessOk()->getAll(), $this->contrAgentManager->getRestStatus());
    }

    /**
     * @Rest\Get("/api/contr_agent/column_defs", options={"expose"=true}, name="api_column_defs_contr_agent")
     * @OA\Get(tags={"contr_agent"})
     * @OA\Response(response=200,description="Returns column_defs contr_agent")
     *
     * @return \Symfony\Component\HttpFoundation\JsonResponse
     */
    public function projectColumnDefsAction()
    {
        return $this->json($this->contrAgentManager->setRestSuccessOk()->getColumnDefs(), $this->contrAgentManager->getRestStatus());
    }
}