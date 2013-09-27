<?php

/**
 * (c) 2011 - ∞ Vespolina Project http://www.vespolina-project.org
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Vespolina\DefaultStoreBundle\ProcessScenario\Setup\Step;

use Vespolina\Entity\Partner\Partner;

class CreateEmployees extends AbstractSetupStep
{
    public function execute(&$context)
    {
        $partnerManager = $this->getContainer()->get('vespolina.partner_manager');
        $partnerManipulator = $this->getContainer()->get('vespolina.partner_manipulator');
        $userManager = $this->getContainer()->get('fos_user.user_manager');

        $employees = array();

        $employeeFixtures = array(
            array(
                'name' => 'Big Boss',
                'role' => Partner::ROLE_EMPLOYEE,
                'username' => 'big_boss',
                'email' => 'big_boss@example.org'
            ),
            array(
                'name' => 'Sales Clerk',
                'role' => Partner::ROLE_EMPLOYEE,
                'username' => 'sales_clerk',
                'email' => 'simple_assistant@example.org'
            )
        );

        foreach ($employeeFixtures as $employeeFixture) {
            // Create and initialize a partner
            $employee = $partnerManager->createPartner(Partner::ROLE_EMPLOYEE);
            $employee->setName($employeeFixture['name']);
            $employee->setPrimaryContact($partnerManager->createPartnerContact());
            $employee->getPrimaryContact()->setEmail($employeeFixture['email']);

            $partnerManager->updatePartner($employee);

            // Link partner to the (FOS) user
            $user = $partnerManipulator->createUser($employee, $employeeFixture['username'], $employeeFixture['username']);
            $userManager->updateUser($user);
            $employees[] = $employee;
        }

        $this->getLogger()->addInfo('Setup ' . count($employees) . ' employees.' );
    }

    public function getName()
    {
        return 'create_employees';
    }
}
