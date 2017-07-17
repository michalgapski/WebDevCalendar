<?php


namespace AppBundle\Service;

use AppBundle\Controller\FindDateController;
use AppBundle\Entity\DateAndTime;
use AppBundle\Entity\Users;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Configuration;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Bundle\DoctrineBundle;





class DateClass
{
    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->em = $entityManager;
    }

    public function checkThisDate($data,$username)
    {
        $query = $this->em->createQueryBuilder()
            ->select("h.hour")
            ->from('AppBundle:DateAndTime', 'h')
            ->where('h.date = :data')
            ->andWhere('h.userName = :name')
            ->setParameter('name', $username)
            ->setParameter('data', $data)
            ->getQuery();

       return $hours = $query->getResult();
    }
    public function freeHours($userCount,$hours,$maxhours)
    {
        for ($i = 0; $i < $userCount; $i++)
        {
            $array[$i] = $this->dayFind($hours[$i],$maxhours);
        }
        return $array;
    }
    public function maxHours()
    {
        $query2 = $this->em->createQueryBuilder()
            ->select('MAX(wh.workEnd)')
            ->from('AppBundle:Users','wh')
            ->orderBy('wh.workEnd', 'DESC')
            ->getQuery();

        $maxhours = $query2->getSingleScalarResult();
        // intval zmienia string w int
        $maxhours = intval($maxhours);
        return $maxhours;
    }

    public function dayFind($hours,$maxhours)
    {
        $results = 0;
        $test = 0;
        for ($i = $maxhours; $i < 24; $i++) {
            foreach ($hours as $hour) {

                if ($i != $hour['hour']) {
                    $test = 1;

                } else $test = 0;
            }
            if ($test == 1)
            {
               // echo 'Day: ' . $data . ' hour: ' . $i . '.<br>';
                $results++;
                $hourResult[] = $i;
            }
        }

        if ($results == 0)
        {
            return $hourResult = 0;
        } else
        return $hourResult;
    }

    public function resultFreeHours($array,$userCount)
    {
        // Połączenie tablic zmiennych + przefiltrowanie pod względem ilości zgadzających się wyników
        $arraymerge = array_merge(...$array);
        $counts = array_count_values($arraymerge);
        $result = array_filter($counts, function($element) { return ($element > 1); });

        // Usuwa godziny które zgadzają się ale nie dla wszystkich wybranych userow
        foreach ($result as $key => $value)
        {
            if ($value < $userCount)
            {
                unset($result[$key]);
            }
        }
        return $result;
    }

}