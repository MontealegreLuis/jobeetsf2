<?php
namespace Jobeet\JobeetBundle\DataFixtures\ORM;

use \Doctrine\Common\DataFixtures\FixtureInterface;
use \Doctrine\Common\Persistence\ObjectManager;
use \DateTime;
use \Jobeet\JobeetBundle\Entity\Category;
use \Jobeet\JobeetBundle\Entity\Job;

class LoadInitialData implements FixtureInterface
{
    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
        $design = new Category();
        $design->setName('Design');
        $manager->persist($design);

        $programming = new Category();
        $programming->setName('Programming');
        $manager->persist($programming);

        $management = new Category();
        $management->setName('Management');
        $manager->persist($management);

        $administration = new Category();
        $administration->setName('Administration');
        $manager->persist($administration);

        $webDev = new Job();
        $webDev->setCategory($programming);
        $webDev->setType('full-time');
        $webDev->setCompany('Sensio Labs');
        $webDev->setLogo('sensio-lasb.gif');
        $webDev->setUrl('http://www.sensiolabs.com');
        $webDev->setPosition('Web Developer');
        $webDev->setLocation('Paris, France');
        $webDev->setDescription("You've already developed websites with symfony and you want to work
with Open-Source technologies. You have a minimum of 3 years
experience in web development with PHP or Java and you wish to
participate to development of Web 2.0 sites using the best
frameworks available.");
        $webDev->setHowToApply('Send your resume to fabien.potencier [at] sensio.com');
        $webDev->setIsPublic(true);
        $webDev->setIsActivated(true);
        $webDev->setToken('job_sensio_labs');
        $webDev->setEmail('job@example.com');
        $webDev->setExpiresAt(DateTime::createFromFormat('Y-m-d', '2014-10-10'));
        $manager->persist($webDev);

        $webDesign = new Job();
        $webDesign->setCategory($design);
        $webDesign->setType('part-time');
        $webDesign->setCompany('Extreme Sensio');
        $webDesign->setLogo('extreme-sensio.gif');
        $webDesign->setUrl('http://www.extreme-sensio.com');
        $webDesign->setPosition('Web Designer');
        $webDesign->setLocation('Paris, France');
        $webDesign->setDescription("Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do
eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut
enim ad minim veniam, quis nostrud exercitation ullamco laboris
nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor
in reprehenderit in.
Voluptate velit esse cillum dolore eu fugiat nulla pariatur.
Excepteur sint occaecat cupidatat non proident, sunt in culpa
qui officia deserunt mollit anim id est laborum.");
        $webDesign->setHowToApply('Send your resume to fabien.potencier [at] sensio.com');
        $webDesign->setIsPublic(true);
        $webDesign->setIsActivated(true);
        $webDesign->setToken('job_extreme_sensio');
        $webDesign->setEmail('job@example.com');
        $webDesign->setExpiresAt(DateTime::createFromFormat('Y-m-d', '2014-10-10'));
        $manager->persist($webDesign);

        $manager->flush();
    }
}
