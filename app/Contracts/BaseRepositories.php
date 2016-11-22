<?php

/*
 * This file is part of SISP.
 *
 * (c) Javier Alarcon <javier.alarcon25@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace SISP\Contracts;

interface BaseRepositories
{

  /**
   * Get the entity that will be managed in the repositories.
   *
   * @return entity
   */
  public function getEntity();

}