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
    public function CheckThisDate($repo, $data,$username)
    {
        $query = $repo->createQueryBuilder('h')
            ->select("h.hour")
            ->where('h.date = :data')
            ->andWhere('h.userName = :name')
            ->setParameter('name', $username)
            ->setParameter('data', $data)
            ->getQuery();

       return $hours = $query->getResult();

    }
    public function MaxHours($repo2)
    {
        $query2 = $repo2->createQueryBuilder('wh')
            ->select('MAX(wh.workEnd)')
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
    public function elementsReturn($element,$userCount)
    {
        return ($element == $userCount);
    }
    public function findFreeHours($arraymerge,$userCount)
    {
        $counts = array_count_values($arraymerge);
        $duplicates = array_filter($counts, $this->elementsReturn($this,$userCount));
        return $duplicates;
    }

}