<?php

/**
 * (c) 2011 - ∞ Vespolina Project http://www.vespolina-project.org
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Vespolina\DefaultStoreBundle\ProcessScenario\Setup\Step;

use Vespolina\Entity\Partner\Partner;

class CreateCustomers extends AbstractSetupStep
{
    public function execute(&$context)
    {
        $customerCount = 10;
        $partnerManager = $this->getContainer()->get('vespolina_commerce.partner_manager');
        $partnerManipulator = $this->getContainer()->get('vespolina_commerce.partner_manipulator');
        $userManager = $this->getContainer()->get('fos_user.user_manager');

        for ($i = 0; $i < $customerCount; $i++) {
            $aCustomer = $partnerManager->createPartner(Partner::ROLE_CUSTOMER, Partner::INDIVIDUAL);
            $aCustomer->setName('customer ' . $i);

            $anAddress = $partnerManager->createPartnerAddress();
            $anAddress->setCountry($context['country']);
            $aCustomer->addAddress($anAddress);
            $aCustomer->setPrimaryContact($partnerManager->createPartnerContact());
            $aCustomer->getPrimaryContact()->setEmail('customer' . $i . '@example.com');

            $partnerManager->updatePartner($aCustomer, true);

            // Link partner to an FOS user so the customer can login (username = 'customer_x', pass = 'customer_x')
            $username = 'customer' . $i;
            $user = $partnerManipulator->createUser($aCustomer, $username, $username);
            $userManager->updateUser($user);
        }
        $this->getLogger()->addInfo('Created ' . $customerCount . ' customers.' );
    }

    public function getName()
    {
        return 'create_customers';
    }
}
