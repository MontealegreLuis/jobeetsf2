<?php
namespace Jobeet\Behat\Contexts;

use \Behat\Behat\Context\ClosuredContextInterface,
    \Behat\Behat\Context\TranslatedContextInterface,
    \Behat\Behat\Context\BehatContext;
use \Behat\Symfony2Extension\Context\KernelAwareInterface;
use \Behat\Symfony2Extension\Context\KernelDictionary;
use \Behat\CommonContexts\SymfonyDoctrineContext;
use \Faker\Factory;
use \Jobeet\JobeetBundle\Entity\Category;
use \Jobeet\JobeetBundle\Entity\Job;
use \Jobeet\JobBoard\ListLatestActiveJobs;
use \DateTime;

/**
 * Features context.
 */
class FeatureContext extends BehatContext implements KernelAwareInterface
{
    use KernelDictionary;

    protected $jobRepository;

    protected $entityManager;

    protected $categories;

    protected $faker;

    /**
     * Initializes context.
     * Every scenario gets its own context object.
     *
     * @param array $parameters context parameters (set them up through behat.yml)
     */
    public function __construct()
    {
        $this->categories = [];
        $this->faker = Factory::create();
        $this->useContext('symfony_doctrine_context',  new SymfonyDoctrineContext());
    }

    /**
     * Clean database before scenario starts
     *
     * @BeforeScenario
     */
    public function beforeScenario($event)
    {
        $this->getMainContext()
             ->getSubcontext('symfony_doctrine_context')
             ->buildSchema($event);
    }

    /**
     * @Given /^there is a category "([^"]*)"$/
     */
    public function thereIsACategory($categoryName)
    {
        $category = new Category();
        $category->setName($categoryName);

        $this->saveEntity($category);

        $this->categories[$categoryName] = $category;
    }

    /**
     * @Given /^there is a job offer posted in "([^"]*)" under the "([^"]*)" category$/
     */
    public function thereIsAJobOfferPostedIn($postedDate, $category)
    {
        $job = new Job();
        $job->setCompany($this->faker->company);
        $job->setPosition($this->faker->text(20));
        $job->setLocation("{$this->faker->country}, {$this->faker->city}");
        $job->setDescription($this->faker->text());
        $job->setHowToApply($this->faker->text(50));
        $job->setToken($this->faker->word);
        $job->setIsPublic(true);
        $job->setIsActivated(true);
        $job->setEmail($this->faker->email);
        $job->setExpiresAt($this->faker->dateTimeThisMonth);
        $job->setCategory($this->categories[$category]);
        $job->setCreated(DateTime::createFromFormat('Y-m-d', $postedDate));

        $this->saveEntity($job);
    }

    /**
     * @Then /^I should see the job posted in "([^"]*)" under the "([^"]*)" category first$/
     */
    public function iShouldSeeTheJobPostedInUnderTheCategoryFirst($postedDate, $category)
    {
        $listLatestActiveJobs = new ListLatestActiveJobs($this->getJobRepository());
        $jobs = $listLatestActiveJobs->getLatestActiveJobs();
        $firstJob = $jobs[0];

        if ($firstJob->getCreated()->format('Y-m-d') !== $postedDate) {
        	throw new \Exception("The job post does not match the expected date '{$postedDate}'");
        }

        if ($firstJob->getCategory()->getName() !== $category) {
            throw new \Exception("The job post does not match the expected category '{$category}'");
        }
    }

    protected function saveEntity($entity)
    {
    	$em = $this->getEntityManager();
    	$em->persist($entity);
    	$em->flush();
    }

    protected function getJobRepository()
    {
        if (!$this->jobRepository) {
            $this->jobRepository = $this->getEntityManager()->getRepository('JobeetJobeetBundle:Job');
        }

        return $this->jobRepository;
    }

    protected function getEntityManager()
    {
        if (!$this->entityManager) {
            $this->entityManager = $this->getContainer()->get('doctrine')->getManager();
        }

        return $this->entityManager;
    }
}
