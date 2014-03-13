<?php
/**
 * Created by PhpStorm.
 * User: smomoo
 * Date: 3/13/14
 * Time: 9:07 AM
 */

namespace ce\models;


use Doctrine\DBAL\LockMode;

abstract class Model implements Entity
{
    /**
     * @return \Doctrine\ORM\EntityRepository
     */
    public static function getRepository()
    {
        global $em;
        return $em->getRepository(static::getEntityName());
    }

    /**
     * Finds an entity by its primary key / identifier.
     *
     * @param mixed $id The identifier.
     * @param int $lockMode The lock mode.
     * @param int|null $lockVersion The lock version.
     *
     * @return Model|null The entity instance or NULL if the entity can not be found.
     */
    public static function find($id, $lockMode = LockMode::NONE, $lockVersion = null)
    {
        return self::getRepository()->find($id, $lockMode, $lockVersion);
    }

    /**
     * Finds all entities in the repository.
     *
     * @return array The entities.
     */
    public static function findAll()
    {
        return self::getRepository()->findAll();
    }

    /**
     * Finds entities by a set of criteria.
     *
     * @param array $criteria
     * @param array|null $orderBy
     * @param int|null $limit
     * @param int|null $offset
     *
     * @return array The Models.
     */
    public static function findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
    {


        return self::getRepository()->findBy($criteria, $orderBy, $limit, $offset);
    }

    /**
     * Finds a single entity by a set of criteria.
     *
     * @param array $criteria
     * @param array|null $orderBy
     *
     * @return Model|null The entity instance or NULL if the entity can not be found.
     */
    public static function findOneBy(array $criteria, array $orderBy = null)
    {

        return self::getRepository()->findOneBy($criteria, $orderBy);
    }

    /**
     *
     */
    public function persist()
    {
        global $em;
        $em->persist($this);
        $em->flush();
    }

    public function refresh()
    {
        global $em;
        $em->refresh($this);
    }

    /**
     * @param Model $obj
     * @return bool
     */
    public static function remove($obj)
    {
        global $em;
        try {
            $em->remove($obj);
            $em->flush();
        } catch (\Exception $e) {
            return false;
        }
        return true;
    }
}
