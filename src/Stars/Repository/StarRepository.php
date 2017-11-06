<?php

namespace App\Stars\Repository;

use App\Stars\Entity\star;
use Doctrine\DBAL\Connection;

/**
 * star repository.
 */
class starRepository
{
    /**
     * @var \Doctrine\DBAL\Connection
     */
    protected $db;

    public function __construct(Connection $db)
    {
        $this->db = $db;
    }

   /**
    * Returns a collection of stars.
    *
    * @param int $limit
    *   The number of stars to return.
    * @param int $offset
    *   The number of stars to skip.
    * @param array $orderBy
    *   Optionally, the order by info, in the $column => $direction format.
    *
    * @return array A collection of stars, keyed by star id.
    */
   public function getAll()
   {
       $queryBuilder = $this->db->createQueryBuilder();
       $queryBuilder
           ->select('u.*')
           ->from('stars', 'u');

       $statement = $queryBuilder->execute();
       $starsData = $statement->fetchAll();
       $starEntityList = null;
       foreach ($starsData as $starData) {
           $starEntityList[$starData['id']] = new star($starData['id'], $starData['nom'], $starData['localisation'], $starData['userID']);
       }

       return $starEntityList;
   }

   /**
    * Returns an star object.
    *
    * @param $id
    *   The id of the star to return.
    *
    * @return array A collection of stars, keyed by star id.
    */
   public function getById($id)
   {
       $queryBuilder = $this->db->createQueryBuilder();
       $queryBuilder
           ->select('u.*')
           ->from('stars', 'u')
           ->where('id = ?')
           ->setParameter(0, $id);
       $statement = $queryBuilder->execute();
       $starData = $statement->fetchAll();

       return new star($starData[0]['id'], $starData[0]['nom'], $starData[0]['localisation'], $starData[0]['userID']);
   }

    public function delete($id)
    {
        $queryBuilder = $this->db->createQueryBuilder();
        $queryBuilder
          ->delete('stars')
          ->where('id = :id')
          ->setParameter(':id', $id);

        $statement = $queryBuilder->execute();
    }

    public function update($parameters)
    {
        $queryBuilder = $this->db->createQueryBuilder();
        $queryBuilder
          ->update('stars')
          ->where('id = :id')
          ->setParameter(':id', $parameters['id']);

        if ($parameters['nom']) {
            $queryBuilder
              ->set('nom', ':nom')
              ->setParameter(':nom', $parameters['nom']);
        }

        if ($parameters['localisation']) {
            $queryBuilder
            ->set('localisation', ':localisation')
            ->setParameter(':localisation', $parameters['localisation']);
        }
        if ($parameters['userID']) {
            $queryBuilder
            ->set('userID', ':userID')
            ->setParameter(':userID', $parameters['userID']);
        }
        $statement = $queryBuilder->execute();
    }

    public function insert($parameters)
    {
        $queryBuilder = $this->db->createQueryBuilder();
        $queryBuilder
          ->insert('stars')
          ->values(
              array(
                'nom' => ':nom',
                'localisation' => ':localisation',
                'userID' => ':userID',
              )
          )
          ->setParameter(':nom', $parameters['nom'])
          ->setParameter(':localisation', $parameters['localisation'])
          ->setParameter(':userID', $parameters['userID']);
        $statement = $queryBuilder->execute();
    }
}
