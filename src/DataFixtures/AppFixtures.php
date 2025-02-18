<?php

namespace App\DataFixtures;

use App\Entity\Contract;
use App\Entity\Experience;
use App\Entity\Gender;
use App\Entity\JobCategory;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        // $product = new Product();
        // $manager->persist($product);
  // Create genders

  $genderList = ['Male', 'Female', 'Other'];

  foreach ($genderList as $gender) {
      $genderClass = new Gender();
      $genderClass->setName($gender);
      $manager->persist($genderClass);
  }

  // Categories

  $categoryList = [
      "Commercial",
      "Retail sales",
      "Creative",
      "Technology",
      "Marketing & PR",
      "Fashion & luxury",
      "Management & HR",
  ];



  foreach ($categoryList as $jobCategory) {


      $jobCategoryClass = new JobCategory();
      $jobCategoryClass->setCategory($jobCategory);
      $manager->persist($jobCategoryClass);
  }
  // Categories

  $experienceList = [
      "0 - 6 month",
      "6 month - 1 year",
      "1 - 2 years",
      "2+ years",
      "5+ years",
      "10+ years",
      ];

  foreach ($experienceList as $experience) {


      $experienceClass = new Experience();
      $experienceClass->setExperience($experience);
      $manager->persist($experienceClass);
  }
  $contractList = [
      "CDI",
      "CDD",
      ];

  foreach ($contractList as $contract) {


      $contractClass = new Contract();
      $contractClass->setType($contract);
      $manager->persist($contractClass);
  }
        $manager->flush();
    }
}
