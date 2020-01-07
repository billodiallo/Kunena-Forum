<?php
/**
 * Kunena Component
 *
 * @package        Kunena.Installer
 *
 * @copyright      Copyright (C) 2008 - 2020 Kunena Team. All rights reserved.
 * @license        https://www.gnu.org/copyleft/gpl.html GNU/GPL
 * @link           https://www.kunena.org
 **/

namespace Kunena;

defined('_JEXEC') or die();

use Exception;
use Joomla\CMS\Factory;
use Joomla\CMS\Language\Text;
use function defined;

// Kunena 2.0.0: Update menu items
/**
 * @param   string  $parent parent
 *
 * @return  array
 *
 * @since   Kunena 6.0
 *
 * @throws  Exception
 */
function kunena_200_2012_04_13_menu($parent)
{
	$app    = Factory::getApplication();
	$legacy = KunenaMenuFix::getLegacy();
	$errors = KunenaMenuFix::fixLegacy();

	if ($errors)
	{
		foreach ($errors as $error)
		{
			$app->enqueueMessage($error, 'error');
		}
	}

	if (!empty($legacy))
	{
		return ['action' => '', 'name' => Text::sprintf('COM_KUNENA_INSTALL_200_MENU', count($legacy)), 'success' => !$errors];
	}

	return null;
}
