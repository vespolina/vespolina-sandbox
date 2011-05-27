<?php
/**
 * (c) Vespolina Project http://www.vespolina-project.org
 *
 * (c) Daniel Kucharski <daniel@xerias.be>
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Vespolina\WorkflowBundle\Model;

class WorkflowContainer implements WorkflowContainerInterface
{
    protected $data;

    public function __construct($data = array())
    {
        $this->data = $data;
    }

    /**
     * @inheritdoc
     */
    public function get($key, $default = null)
    {
        if (array_key_exists($key, $this->data)) {
            return $this->data[$key];
        } elseif ($default) {
            return $default;
        } else {
            return null;
        }
    }

    /**
     * @inheritdoc
     */
    public function set($key, $value)
    {
        $this->data[$key] = $value;
    }

    /**
     * @inheritdoc
     */
    public function getContainerData()
    {
        return $this->data;
    }
}
