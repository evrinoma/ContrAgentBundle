<?php


namespace Evrinoma\ContrAgentBundle\Manager;

use Doctrine\ORM\EntityManagerInterface;
use Evrinoma\ContrAgentBundle\Model\AbstractBaseContrAgent;
use Evrinoma\GridBundle\AgGrid\ColumnDef;
use Evrinoma\UtilsBundle\Manager\AbstractEntityManager;
use Evrinoma\UtilsBundle\Rest\RestTrait;

/**
 * Class ContrAgentManager
 *
 * @package Evrinoma\ContrAgentBundle\Manager
 */
class ContrAgentManager extends AbstractEntityManager
{
    use RestTrait;

//region SECTION: Fields
    /**
     * @var string
     */
    protected $repositoryClass = AbstractBaseContrAgent::class;
//endregion Fields

//region SECTION: Constructor
    /**
     * ContrAgentManager constructor.
     *
     * @param EntityManagerInterface $entityManager
     * @param string                 $repositoryClass
     */
    public function __construct(EntityManagerInterface $entityManager, string $repositoryClass)
    {
        $this->repositoryClass = $repositoryClass;
        parent::__construct($entityManager);
    }

//endregion Constructor

//region SECTION: Getters/Setters
    /**
     * @param $projectDto
     *
     * @return $this
     */
    public function get($projectDto): self
    {
        if ($projectDto) {
            $this->setData($this->repository->setDto($projectDto)->findProject());
        } else {
            $this->setRestClientErrorBadRequest();
        }

        return $this;
    }

    public function getAll()
    {
        return $this->getRepositoryAll($this->repositoryClass)->getData();
    }

    public function getColumnDefs()
    {

        $id = new ColumnDef();
        $id->setType(ColumnDef::NUMBER_COLUMN)->setHeaderName('ID')->setField('id')->setWidth(1)->setEditable()->setResizable();

        $active = new ColumnDef();
        $active->setHeaderName('Активность')->setField('active')->setWidth(1);

        $shortName = new ColumnDef();
        $shortName->setHeaderName('Название')->setField('shortName')->setWidth(70);

        $fullName = new ColumnDef();
        $fullName->setHeaderName('Полное название')->setField('fullName')->setWidth(150)->setCellEditor(ColumnDef::CELL_EDITOR_AG_LARGE_TEXT_CELL_EDITOR);

        $inn = new ColumnDef();
        $inn->setHeaderName('ИНН')->setField('inn')->setWidth(50);

        $createdAt = new ColumnDef();
        $createdAt->setType(ColumnDef::DATE_COLUMN)->setHeaderName('Дата создания')->setField('createdAt')->setWidth(20)->setResizable()
            ->setCellEditor(ColumnDef::CELL_EDITOR_DATE_PICKER);

        $updatedAt = new ColumnDef();
        $updatedAt->setType(ColumnDef::DATE_COLUMN)->setHeaderName('Дата обновления')->setField('updatedAt')->setWidth(20)->setResizable()
            ->setCellEditor(ColumnDef::CELL_EDITOR_DATE_PICKER);

       // return [$id, $active, $inn, $createdAt, $updatedAt];
        return [$id, $active, $fullName, $shortName, $inn, $createdAt, $updatedAt];
    }

    public function getRestStatus(): int
    {
        return $this->status;
    }
//endregion Getters/Setters
}