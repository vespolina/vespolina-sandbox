<?php

/**
 * (c) 2011 - ∞ Vespolina Project http://www.vespolina-project.org
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Vespolina\DefaultStoreBundle\ProcessScenario\Setup\Step;

use Vespolina\Entity\Action\ActionDefinition;
use Vespolina\Entity\Partner\Partner;

class CreateActionDefinitions extends AbstractSetupStep
{
    public function execute(&$context)
    {
        $actionManager = $this->getContainer()->get('vespolina.action_manager');
        $actionDefinitions = array();
        $actionDefinitionFixtures = array(
            array(
                'name' => 'notify_customer',
                'topic'  => 'order',
                'eventName' => 'v.action.order.notification_customer'
            )
        );

        foreach($actionDefinitionFixtures as $fixture) {
            $actionDefinition = new ActionDefinition($fixture['name'], $fixture['topic']);
            $actionDefinition->setEventName($fixture['eventName']);
            $actionManager->addActionDefinition($actionDefinition);
            $actionManager->updateActionDefinition($actionDefinition);

            $actionDefinitions[] = $actionDefinition;
        }
        $this->getLogger()->addInfo('Setup ' . count($actionDefinitions) . ' action(s).' );
    }

    public function getName()
    {
        return 'create_action_definitions';
    }
}
